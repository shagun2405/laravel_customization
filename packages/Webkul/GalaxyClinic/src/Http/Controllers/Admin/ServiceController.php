<?php

namespace Webkul\GalaxyClinic\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Contracts\Validations\Slug;
use Webkul\Product\Http\Requests\ProductForm;
use Illuminate\Support\Facades\Mail;
use Webkul\Marketplace\Repositories\ProductRepository;
use Webkul\Product\Repositories\ProductRepository as CoreProductRepository;
use Webkul\Marketplace\Mail\ProductApprovalNotification;
use Webkul\Marketplace\Mail\ProductDisapprovalNotification;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\GalaxyClinic\DataGrids\Admin\ProductDataGrid;
use Webkul\GalaxyClinic\Http\Controllers\Admin\Controller;
use Webkul\Attribute\Repositories\AttributeFamilyRepository;
use Webkul\Inventory\Repositories\InventorySourceRepository;
use Webkul\GalaxyClinic\Repositories\BookingServiceRepository;
use Webkul\GalaxyClinic\Repositories\ProductRepository as GalaxyClinicProductRepository;
use Webkul\GalaxyClinic\Models\TherepistsSlots;
use Webkul\Customer\Repositories\CustomerRepository as CustomerRepository;
use DB;

/**
 * Product controller
 *
 * @author    Anmol Singh Chauhan <anmol.chauhan207@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
*/
class ServiceController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var object
    */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     *
     * @return void
    */
    public function __construct(
        protected ProductRepository $productRepository,
        protected CategoryRepository $categoryRepository,
        protected BookingServiceRepository $bookingServiceRepository,
        protected InventorySourceRepository $inventorySourceRepository,
        protected AttributeFamilyRepository $attributeFamilyRepository,
        protected GalaxyClinicProductRepository $galaxyClinicProductRepository,
        protected CustomerRepository $customerRepository,
        protected CoreProductRepository $CoreProductRepository,
    )
    {
        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(ProductDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $families = $this->attributeFamilyRepository->all();

        $configurableFamily = null;

        if ($familyId = request()->get('family')) {
            $configurableFamily = $this->attributeFamilyRepository->find($familyId);
        }

        return view($this->_config['view'], compact('families', 'configurableFamily'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'type'                => 'required',
            'attribute_family_id' => 'required',
            'sku'                 => ['required', 'unique:products,sku', new Slug],
        ]);

        Event::dispatch('catalog.product.create.before');

        $product = $this->CoreProductRepository->create(request()->all());

        $data['product_id'] = $product->id;
        $data['is_service'] = 1;

        $this->bookingServiceRepository->create($data);

        Event::dispatch('catalog.product.create.after', $product);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Product']));

        return redirect()->route($this->_config['redirect'], ['id' => $product->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
       
        $product = $this->CoreProductRepository->with(['is_service'])->findOrFail($id);
        
        $sellerProduct = $this->galaxyClinicProductRepository->findWhere([
            'product_id' => $product->product_id
        ])->toArray();

        $categories = $this->categoryRepository->getCategoryTree();

        $inventorySources = $this->inventorySourceRepository->findWhere(['status' => 1]);

        if(isset($sellerProduct)) {
            foreach($sellerProduct as $key => $seller_value)
            $clinic_ids[] = $seller_value["marketplace_seller_id"];
        }

        $week_days_array[] = "Monday";
        $week_days_array[] = "Tuesday";
        $week_days_array[] = "Wednesday";
        $week_days_array[] = "Thursday";
        $week_days_array[] = "Friday";
        $week_days_array[] = "Saturday";
        $week_days_array[] = "Sunday";
       
        if(isset($clinic_ids))
        {
            foreach($clinic_ids as $arr_key => $clinic_id) {
                
                $therapist_data =  TherepistsSlots::select('therapists_id','slots')->where('clinic_id',$clinic_id)->get()->toArray();

                foreach($therapist_data as $key => $value) {
                   
                    $therapist_name = $this->customerRepository->findOrFail($value["therapists_id"]);
                    
                    $clinic_name = $this->customerRepository->findOrFail($clinic_id);

                    $clinic_data[$clinic_name->first_name . $clinic_name->last_name][$value["therapists_id"]]["name"] = $therapist_name->first_name . $therapist_name->last_name;

                    $clinic_data[$clinic_name->first_name . $clinic_name->last_name][$value["therapists_id"]]["worked_at_clinic"] = $clinic_name->first_name . $clinic_name->last_name;

                    $clinic_data[$clinic_name->first_name . $clinic_name->last_name][$value["therapists_id"]]["slots"]= json_decode($value["slots"]); 
                   
                }
            }
            
        }

        if(empty($clinic_data))
        {
            $clinic_data = [];
        }
        //print_r($clinic_data);
        
        return view($this->_config['view'], compact('product', 'categories', 'inventorySources', 'sellerProduct' , 'week_days_array' ,'clinic_data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Webkul\Product\Http\Requests\ProductForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductForm $request, $id)
    {
        Event::dispatch('catalog.product.update.before', $id);

        $data = request()->all();

        $product = $this->CoreProductRepository->update($data, $id);

        $sellerIds = isset($data['seller_ids']) ? $data['seller_ids'] : [];

        if(! empty($sellerIds)) {

            $sellerData['product_id'] = $product->product_id;
            $sellerData['is_owner'] = 0;
            $sellerData['price'] = (float)$product->price;
            $sellerData['description'] = $product->description;
            $sellerData['is_approved'] = 0;

            foreach($sellerIds as $sellerId) {

                $sellerProduct = $this->galaxyClinicProductRepository->findOneWhere([
                    'product_id' => $product->product_id,
                    'marketplace_seller_id' => $sellerId,
                ]);

                if ($sellerProduct) {
                    continue;
                }

                $sellerData['marketplace_seller_id'] = $sellerId;

                $this->galaxyClinicProductRepository->createAssign($sellerData);
            }

        }

        Event::dispatch('catalog.product.update.after', $product);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Product']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->CoreProductRepository->findOrFail($id);

        try {
            Event::dispatch('catalog.product.delete.before', $id);

            $this->CoreProductRepository->delete($id);

            Event::dispatch('catalog.product.delete.after', $id);

            return response()->json([
                'message' => trans('admin::app.response.delete-success', ['name' => 'Booking Service']),
            ]);
        } catch (Exception $e) {
            report($e);
        }

        return response()->json([
            'message' => trans('admin::app.response.delete-failed', ['name' => 'Booking Service']),
        ], 500);
    }

    /**
     * Mass delete the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        $productIds = explode(',', request()->input('indexes'));

        foreach ($productIds as $productId) {
            $product = $this->CoreProductRepository->find($productId);

            if (isset($product)) {
                Event::dispatch('catalog.product.delete.before', $productId);

                $this->CoreProductRepository->delete($productId);

                Event::dispatch('catalog.product.delete.after', $productId);
            }
        }

        session()->flash('success', trans('admin::app.catalog.products.mass-delete-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Mass update the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function massUpdate()
    {
        $data = request()->all();

        if (! isset($data['massaction-type'])) {
            return redirect()->back();
        }

        if (! $data['massaction-type'] == 'update') {
            return redirect()->back();
        }

        $productIds = explode(',', $data['indexes']);

        foreach ($productIds as $productId) {
            Event::dispatch('catalog.product.update.before', $productId);

            $sku = DB::table('products')->where('id', $productId)->select('sku')->first();

            DB::table('product_flat')->where('sku', $sku->sku)->update(['status' => $data['update-options']]);

        }

        session()->flash('success', trans('admin::app.catalog.products.mass-update-success'));

        return redirect()->route('admin.galaxyclinic.catalog.services.index');
    }
}
