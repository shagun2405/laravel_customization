<?php

namespace Webkul\GalaxyClinic\Http\Controllers\Admin;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Webkul\GalaxyClinic\DataGrids\Admin\AdminDataGrids\TherapistsDataGrids;
use Webkul\Admin\DataGrids\CustomerOrderDataGrid;
use Webkul\Admin\DataGrids\CustomersInvoicesDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Mail\NewCustomerNotification;
use Webkul\Customer\Repositories\CustomerGroupRepository;
use Webkul\Customer\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Webkul\Product\Models\ProductFlat as ProductFlat;
use Webkul\GalaxyClinic\Models\TherepistsSlots;
use Illuminate\Support\Facades\DB;

/**
 * Therapists controller
 *
 * @author    Aqib Zaman Khan <aqibzaman.khan651@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
*/
class TherapistsController extends Controller
{
     /**
     * Contains route related configuration.
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @param \Webkul\Customer\Repositories\CustomerGroupRepository  $customerGroupRepository
     */
    public function __construct(
        protected CustomerRepository $customerRepository,
        protected CustomerGroupRepository $customerGroupRepository
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
            return app(TherapistsDataGrids::class)->toJson();
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
        $groups = $this->customerGroupRepository->findWhere([['code', '<>', 'guest']]);

        return view($this->_config['view'], compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'first_name'        => 'string|required',
            'last_name'         => 'string|required',
            'gender'            => 'required',
            'email'             => 'required|unique:customers,email',
            'date_of_birth'     => 'date|before:today',
            'default_clinic_id' => 'required',
            'image'             =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($request->file('image')) {
            $image_path = $request->file('image')->store('image', 'public');
        } else {
            $image_path = '';
        }

        $password = rand(100000, 10000000);

        Event::dispatch('customer.registration.before');

        $data_customer = request()->all();
        //dd($data_customer);
        if(isset($data_customer["available_at_clinic"])) {
            $clinics = is_array($data_customer["available_at_clinic"]) ? implode(",",$data_customer["available_at_clinic"]) : $data_customer["available_at_clinic"]; 
        }
       
        $customer = $this->customerRepository->create(array_merge(request()->all() , [
            'password'    => bcrypt($password),
            'is_verified' => 1,
            'clinics'     => !empty($clinics) ? $clinics : '',
            'profile_image'     => !empty($image_path) ? $image_path : '',
        ]));

        //dd($customer);

        Event::dispatch('customer.registration.after', $customer);

        try {
            $configKey = 'emails.general.notifications.emails.general.notifications.customer';

            if (core()->getConfigData($configKey)) {
                Mail::queue(new NewCustomerNotification($customer, $password));
            }
        } catch (\Exception $e) {
            report($e);
        }

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Customer']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $therapist_id = $id;
        
        $customer = $this->customerRepository->findOrFail($id);

        $groups = $this->customerGroupRepository->findWhere([['code', '<>', 'guest']]);

        $available_at = TherepistsSlots::select('available_at')->where('therapists_id' , $therapist_id)->get()->toArray();
        
        if(isset($therapist_available_at)) {
            $therapist_available_at = explode(",",$available_at[0]["available_at"]); 
        } else {
            $therapist_available_at = []; 
        }
       

        
        
        return view($this->_config['view'], compact('customer', 'groups','therapist_id','therapist_available_at'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // dd(request()->all());
        $this->validate(request(), [
            'first_name'        => 'string|required',
            'last_name'         => 'string|required',
            'gender'            => 'required',
            'email'             => 'required|unique:customers,email,' . $id,
            'date_of_birth'     => 'date|before:today',
            'default_clinic_id' => 'required',
            'image'             =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        Event::dispatch('customer.update.before', $id);

        $request_data = request()->all();

        if(isset($request_data['clinics'])) {
            $data['clinics'] = $request_data['clinics'];
        }
        if(isset($request_data['services'])) {
            $data['services'] = $request_data['services'];
        }
        if(isset($request_data['available_at_clinic'])) {

            $default_clinic[] =  $request_data['default_clinic_id'];

            $available_at = array_unique(array_merge($request_data['available_at_clinic'],$default_clinic));

            $data['available_at'] = implode(",",$available_at);
        }
        
        if(isset($data)) {
            
            TherepistsSlots::where('therapists_id',$id)->update($data);

            session()->flash('success', trans('galaxyclinic::app.catalog.therapists.therapists-slot-success'));

            return redirect()->back();
        }
        
        if($request->file('image')) {
            $image_path = $request->file('image')->store('image', 'public');
        } else {
            $image_path = '';
        }
        
        $customer = $this->customerRepository->update(array_merge(request()->all(), [
            'status'       => request()->has('status'),
            'is_suspended' => request()->has('is_suspended'),
            'profile_image'     => !empty($image_path) ? $image_path : '',
        ]), $id);

        Event::dispatch('customer.update.after', $customer);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Customer']));

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
        $customer = $this->customerRepository->findorFail($id);

        try {
            if (! $this->customerRepository->checkIfCustomerHasOrderPendingOrProcessing($customer)) {
                $this->customerRepository->delete($id);

                return response()->json(['message' => trans('admin::app.response.delete-success', ['name' => 'Customer'])]);
            }

            return response()->json(['message' => trans('admin::app.response.order-pending', ['name' => 'Customer'])], 400);
        } catch (\Exception $e) {}

        return response()->json(['message' => trans('admin::app.response.delete-failed', ['name' => 'Customer'])], 400);
    }

    /**
     * To load the note taking screen for the customers.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function createNote($id)
    {
        $customer = $this->customerRepository->find($id);

        return view($this->_config['view'])->with('customer', $customer);
    }

    /**
     * To store the response of the note in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeNote()
    {
        $this->validate(request(), [
            'notes' => 'string|nullable',
        ]);

        Event::dispatch('customer.update.before', request()->input('_customer'));

        $customer = $this->customerRepository->update([
            'notes' => request()->input('notes'),
        ], request()->input('_customer'));

        Event::dispatch('customer.update.after', $customer);

        session()->flash('success', 'Note taken');

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * To mass update the customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function massUpdate()
    {
        $customerIds = explode(',', request()->input('indexes'));

        $updateOption = request()->input('update-options');

        foreach ($customerIds as $customerId) {
            Event::dispatch('customer.update.before', $customerId);

            $customer = $this->customerRepository->update([
                'status' => $updateOption,
            ], $customerId);

            Event::dispatch('customer.update.after', $customer);
        }

        session()->flash('success', trans('admin::app.customers.customers.mass-update-success'));

        return redirect()->back();
    }

    /**
     * To mass delete the customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        $customerIds = explode(',', request()->input('indexes'));

        if (! $this->customerRepository->checkBulkCustomerIfTheyHaveOrderPendingOrProcessing($customerIds)) {
            foreach ($customerIds as $customerId) {
                Event::dispatch('customer.delete.before', $customerId);
                
                $this->customerRepository->delete($customerId);

                Event::dispatch('customer.delete.after', $customerId);
            }

            session()->flash('success', trans('admin::app.customers.customers.mass-destroy-success'));

            return redirect()->back();
        }

        session()->flash('error', trans('admin::app.response.order-pending', ['name' => 'Customers']));

        return redirect()->back();
    }

    /**
     * Retrieve all invoices from customer.
     *
     * @param  int  $id
     * @return \Webkul\Admin\DataGrids\CustomersInvoicesDataGrid
     */
    public function invoices($id)
    {
        if (request()->ajax()) {
            return app(CustomersInvoicesDataGrid::class)->toJson();
        }
    }

    /**
     * Retrieve all orders from customer.
     *
     * @param  int  $id
     * @return \Webkul\Admin\DataGrids\CustomerOrderDataGrid
     */
    public function orders($id)
    {
        if (request()->ajax()) {
            return app(CustomerOrderDataGrid::class)->toJson();
        }

        $customer = $this->customerRepository->find(request('id'));

        return view($this->_config['view'], compact('customer'));
    }

    /**
     * Show the form for adding the clinics.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function clinics($id)
    {
        $therapists_id = $id;
        $checkTherapistsExist = TherepistsSlots::where('therapists_id' , $therapists_id)->count();

        $services = [];

        if($checkTherapistsExist <= 0) {
            return view($this->_config['view'], compact('therapists_id','services'));
        } else {
            $TherapistsSlotsDetails = TherepistsSlots::where('therapists_id' , $therapists_id)->get();

            foreach($TherapistsSlotsDetails as $key => $value)
            {
                if(isset($value->services)){
                    $value_services = @explode(",",$value->services);

                    

                    foreach($value_services as $key => $product_id)
                    {
                        if($product_id != 'click here to load services') {

                            // if($product_id != '')
                            $products_name = ProductFlat::find($product_id,'name');

                            //dd($products_name->name);
                            $product_names[] =  $products_name->name;

                            $services_names = @implode(",",$product_names);

                        }    

                    }
                   

                     $services[$value->clinic_id] = $services_names;
                     if(isset($product_names))
                     {
                        unset($product_names);
                     }
                    

                    }
                
                //dd('ads');
               
            }
           // dd('ads');
            
        

            return view('galaxyclinic::admin.catalog.therapists.edit_therapists_slots', compact('therapists_id', 'TherapistsSlotsDetails' ,'services'));
        }
        
    }

    /**
     * Add Therepists Slots to clinic.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTherapistsSlots(Request $request, $id)
    {
        $datas = array();
        $all_slots = request()->all();
        
        if(isset($all_slots['booking'])) {
            foreach($all_slots['booking'] as $key => $slot) {
                $data['therapists_id'] = $id;
                $data['clinic_id'] = $key;
                $data['duration'] = $slot['duration'];
                $data['break_time'] = $slot['break_time'];
                $data['slots'] = json_encode($this->formatSlots($slot));
                $datas[] = $data;
            }
        }
    
        if($datas) {
            
            TherepistsSlots::insert($datas);

            session()->flash('success', trans('galaxyclinic::app.catalog.therapists.therapists-slot-success'));

            return redirect()->back();
        }  
    }

    /**
     * Update Therepists Slots to clinic.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTherapistsSlots(Request $request, $id)
    {
        $datas = array();
        $all_slots = request()->all();
        // dd($all_slots);
        if(isset($all_slots['booking'])) {
            foreach($all_slots['booking'] as $key => $slot) {
                
                $data['therapists_id'] = $id;
                $data['clinic_id'] = $key;
                $data['duration'] = $slot['duration'];
                $data['break_time'] = $slot['break_time'];
                
                $data['slots'] = json_encode($this->formatSlots($slot));
                
                
                // TherepistsSlots::where(['therapists_id', $id],['clinic_id',$key])->update($data);
                TherepistsSlots::where('therapists_id', $id)->where('clinic_id', $key)->update($data);
            }
            
            foreach($all_slots['services'] as $clinic_id => $services) {
                if(isset($all_slots['services'][$clinic_id]['services'])){
                    $service['services'] =  is_array($all_slots['services'][$clinic_id]['services']) ? @implode(",",$all_slots['services'][$clinic_id]['services']) : $all_slots['services'][$clinic_id]['services']; 
                }
                //dd($service);
                TherepistsSlots::where('therapists_id', $id)->where('clinic_id', $clinic_id)->update($service);
            }
        }
        
        session()->flash('success', trans('galaxyclinic::app.catalog.therapists.therapists-slot-updated-success'));

        return redirect()->back();
    }

    public function formatSlots($data)
    {
        for ($i = 0; $i < 7; $i++) {
            if (! isset($data['slots'][$i])) {
                $data['slots'][$i] = [];
            } else {
                $count = 0;

                $slots = [];

                foreach ($data['slots'][$i] as $slot) {
                    $slots[] = array_merge($slot, ['id' => $i . '_slot_' . $count]);
                    
                    $count++;
                }

                $data['slots'][$i] = $slots;
            }
        }

        ksort($data['slots']);

        return $data['slots'];
    }
    
    public function getServices(Request $request) {
        
        $clinic_id = $request->clinic_id;
       
        $product_ids = DB::select("select product_id from marketplace_products where marketplace_seller_id = $clinic_id");

        if($product_ids) {
            foreach ($product_ids as $products) {

                $name = DB::select("select name from product_flat where id = $products->product_id");

                $products_data[$products->product_id] = $name;
            }
            echo json_encode($products_data);
        }

       
    }
}