<?php

namespace Webkul\Marketplace\Http\Controllers\Shop\Account;

use Exception;
use DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Webkul\Product\Http\Requests\ProductForm;
use Webkul\Product\Models\Product as ProductModel;
use Webkul\Marketplace\Http\Controllers\Shop\Controller;
use Webkul\Marketplace\Repositories\MpProductRepository as Product;
use Webkul\Attribute\Repositories\AttributeFamilyRepository as AttributeFamily;
use Webkul\Category\Repositories\CategoryRepository as Category;
use Webkul\Inventory\Repositories\InventorySourceRepository as InventorySource;
use Webkul\Marketplace\Repositories\ProductRepository as SellerProduct;
use Webkul\Marketplace\Repositories\SellerRepository as Seller;
use Webkul\Product\Repositories\ProductRepository as CoreProduct;
use Webkul\Marketplace\Repositories\SellerCategoryRepository;
use Webkul\Product\Repositories\ProductDownloadableLinkRepository;
use Webkul\Product\Repositories\ProductDownloadableSampleRepository;
use Webkul\Marketplace\Models\SellerProductType;
use Webkul\Marketplace\DataGrids\Shop\ProductDataGrid;

/**
 * Product controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
*/
class ProductController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var object
    */
    protected $_config;

    /**
     * AttributeFamilyRepository object
     *
     * @var object
    */
    protected $attributeFamily;

    /**
     * CategoryRepository object
     *
     * @var object
    */
    protected $category;

    /**
     * InventorySourceRepository object
     *
     * @var object
    */
    protected $inventorySource;

    /**
     * ProductRepository object
     *
     * @var object
    */
    protected $product;

    /**
     * ProductRepository object
     *
     * @var object
    */
    protected $sellerProduct;

    /**
     * SellerRepository object
     *
     * @var object
    */
    protected $seller;

    /**
     * Core Product Repository object
     *
     * @var object
    */
    protected $coreProduct;

    /**
     * Seller Category Repository object
     *
     * @var object
    */
    protected $sellerCategoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Attribute\Repositories\AttributeFamilyRepository $attributeFamily
     * @param  Webkul\Category\Repositories\CategoryRepository         $category
     * @param  Webkul\Inventory\Repositories\InventorySourceRepository $inventorySource
     * @param  Webkul\Marketplace\Repositories\ProductRepository       $sellerProduct
     * @param  Webkul\Marketplace\Repositories\SellerRepository        $seller
     * @return void
    */
    public function __construct(
        Seller $seller,
        Product $product,
        Category $category,
        CoreProduct $coreProduct,
        SellerProduct $sellerProduct,
        AttributeFamily $attributeFamily,
        InventorySource $inventorySource,
        SellerCategoryRepository $sellerCategoryRepository,
        ProductDownloadableLinkRepository $productDownloadableLinkRepository,
        ProductDownloadableSampleRepository $productDownloadableSampleRepository
    )
    {
        $this->seller = $seller;

        $this->product = $product;

        $this->category = $category;

        $this->coreProduct = $coreProduct;

        $this->_config = request('_config');

        $this->sellerProduct = $sellerProduct;

        $this->inventorySource = $inventorySource;

        $this->attributeFamily = $attributeFamily;

        $this->sellerCategoryRepository = $sellerCategoryRepository;

        $this->productDownloadableLinkRepository = $productDownloadableLinkRepository;

        $this->productDownloadableSampleRepository = $productDownloadableSampleRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $isSeller = $this->seller->isSeller(auth()->guard('customer')->user()->id);

        if (! $isSeller) {
            return redirect()->route('marketplace.account.seller.create');
        }

        if (request()->ajax()) {
            return app(ProductDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $sellerAllowedProductTypes = $this->getAllowedProducts();

        $families = $this->attributeFamily->all();
        $configurableFamily = null;
        if ($familyId = request()->get('family')) {
            $configurableFamily = $this->attributeFamily->find($familyId);
        }

        return view($this->_config['view'], compact('families', 'configurableFamily','sellerAllowedProductTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
    */
    public function store()
    {
        if (! request()->get('family') && request()->input('type') == 'configurable' && request()->input('sku') != '') {
            return redirect(url()->current() . '?family=' . request()->input('attribute_family_id') . '&sku=' . request()->input('sku') . '&type=' . request()->input('type'));
        }

        if (request()->input('type') == 'configurable' && (! request()->has('super_attributes') || !count(request()->get('super_attributes')))) {

            session()->flash('error', 'Please select atleast one configurable attribute.');

            return back();
        }

        $this->validate(request(), [
            'type' => 'required',
            'attribute_family_id' => 'required',
            'sku' => ['required', 'unique:products,sku', new \Webkul\Core\Contracts\Validations\Slug]
        ]);

        $sellerAllowedProductTypes = $this->getAllowedProducts();

        if (!$sellerAllowedProductTypes->has(request()->input('type'))) {
            session()->flash('errot', 'Warning: You are not allowed to add ' . request()->input('type') . 'type of product.');

            return redirect()->back();
        }

        $product = $this->product->create(request()->all());

        $this->sellerProduct->create([
            'product_id'    => $product->id,
            'is_owner'      => 1
        ]);

        session()->flash('success', 'Product created successfully.');

        return redirect()->route($this->_config['redirect'], ['id' => $product->id]);
    }

    /**
     * Validate product type allowed for Marketplace.
     *
     * @return mixed
    */
    public function getAllowedProducts()
    {
        $sellerAllowedProductTypes = [];
        $restrictedProducts = ['booking', 'bundle', 'grouped'];

        $seller = $this->seller->findOneByField('customer_id', auth()->guard('customer')->user()->id);

        $globalMpAllowedProducts = core()->getConfigData('marketplace.products_setting.type.allowed_product');
        if ( $globalMpAllowedProducts ) {
            $globalMpAllowedProducts = explode(",", $globalMpAllowedProducts);
            $globalMpAllowedProducts = array_diff($restrictedProducts, $globalMpAllowedProducts);

            $sellerProductTypes = SellerProductType::SellerAssignProductType($seller->id);

            foreach ($sellerProductTypes as $key => $type) {
                if (in_array($type, $globalMpAllowedProducts)) {
                    unset($sellerProductTypes[$key]);
                }
            }

            $sellerAllowedProductTypes = collect(config('product_types'))->only($sellerProductTypes);
        }else {
            $sellerProductTypes = SellerProductType::SellerAssignProductType($seller->id);
            $sellerAllowedProductTypes = collect(config('product_types'))->only($sellerProductTypes);
            foreach ($sellerProductTypes as $key => $type) {
                if (in_array($type, $restrictedProducts)) {
                    unset($sellerProductTypes[$key]);
                }
            }
            $sellerAllowedProductTypes = collect(config('product_types'))->only($sellerProductTypes);
        }
        return $sellerAllowedProductTypes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $seller = $this->seller->findOneByField('customer_id', auth()->guard('customer')->user()->id);

        $sellerProduct = $this->sellerProduct->findOneWhere([
            'product_id' => $id,
            'marketplace_seller_id' => $seller->id,
            'is_owner' => 0
        ]);

        if ($sellerProduct) {
            return redirect()->route('marketplace.account.products.edit-assign', ['id'=> $sellerProduct->id]);
        }

        $product = $this->product->with(['variants', 'variants.inventories'])->findorFail($id);

        $sellerCat = $this->sellerCategoryRepository->findOneWhere(['seller_id' => $seller->id]);

        if ($sellerCat) {
            $sellerCategory = json_decode($sellerCat->categories);
            $categories = $this->category->getModel()::with('ancestors')->whereIn('id', $sellerCategory )->get();
        } else {
            $categories = $this->category->getModel()::with('ancestors')->where('id', 1 )->get();
        }

        $rootCategory = $this->category->findOneWhere(['id' => core()->getCurrentChannel()->root_category_id]);

        $inventorySources = core()->getCurrentChannel()->inventory_sources;

        return view($this->_config['view'], compact('product', 'categories', 'inventorySources', 'rootCategory'));
    }

    /**
     * get visible category tree
     *
     * @param integer $id
     * @return mixed
    */
    public function getVisibleCategoryTree($id)
    {
        return $this->category->getModel()->orderBy('position', 'ASC')->where('status', 1)->descendantsOf($id)->toTree();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Webkul\Product\Http\Requests\ProductForm $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(ProductForm $request, $id)
    {
        $data = request()->all();
        $sellerAllowedProductTypes = $this->getAllowedProducts();

        // if (!$sellerAllowedProductTypes->has(request()->input('key'))) {
        //     $data['status']  = 0;
        // }
        $sellerProducts = $this->sellerProduct->getMarketplaceProductByProduct($id);
        if(!$sellerProducts) {
            session()->flash('error', 'Unautorized, Product is not related to seller.');
            return redirect()->route($this->_config['redirect']);
        }


        $this->product->update($data, $id);

        // dd($id); die;

        $this->sellerProduct->update(request()->all(), $sellerProducts->id);

        session()->flash('success', 'Product updated successfully.');

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Copy a given Product.
    */
    public function copy(int $productId)
    {
        $originalProduct = $this->coreProduct->findOrFail($productId);

        $seller = $this->sellerProduct->getSellerByProductId($originalProduct->id);

        if (! $seller) {
            session()->flash('error',
                trans('You can not copy Assign Product.'));

            return redirect()->to(route('marketplace.account.products.index'));
        }

        if (! $originalProduct->getTypeInstance()->canBeCopied()) {
            session()->flash('error',
                trans('admin::app.response.product-can-not-be-copied', [
                    'type' => $originalProduct->type,
                ]));

            return redirect()->to(route('marketplace.account.products.index'));
        }

        if ($originalProduct->parent_id) {
            session()->flash('error',
                trans('admin::app.catalog.products.variant-already-exist-message'));

            return redirect()->to(route('marketplace.account.products.index'));
        }

        $copiedProduct = $this->coreProduct->copy($originalProduct);

        if ($copiedProduct instanceof ProductModel && $copiedProduct->id) {
            session()->flash('success', trans('admin::app.response.product-copied'));
        } else {
            session()->flash('error', trans('admin::app.response.error-while-copying'));
        }

        $sellerProduct = $this->sellerProduct->create([
            'product_id' => $copiedProduct->id,
            'is_owner' => 1
        ]);

        return redirect()->to(route('marketplace.account.products.edit', ['id' => $copiedProduct->id]));
    }

    /**
     * Uploads downloadable file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function uploadLink($id)
    {
        return response()->json(
            $this->productDownloadableLinkRepository->upload(request()->all(), $id)
        );
    }

    /**
     * Uploads downloadable sample file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function uploadSample($id)
    {
        return response()->json(
            $this->productDownloadableSampleRepository->upload(request()->all(), $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $sellerProduct = $this->sellerProduct->getMarketplaceProductByProduct($id);

        try {

            if ($sellerProduct) {
                if ($sellerProduct->is_owner == 1) {
                    $this->sellerProduct->delete($sellerProduct->id);
                    $this->product->delete($sellerProduct->product_id);
                } else {
                    $this->sellerProduct->delete($sellerProduct->id);
                }
            }

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Product']));

            return response()->json(['message' => true], 200);
        } catch (Exception $e) {
            report($e);

            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Product']));
        }

        return response()->json(['message' => false], 400);
    }

    /**
     * Mass Delete the products
     *
     * @return response
    */
    public function massDestroy()
    {
        $productIds = explode(',', request()->input('indexes'));

        foreach ($productIds as $productId) {
            $sellerProduct = $this->sellerProduct->getMarketplaceProductByProduct($productId);

            if ($sellerProduct) {
                if ($sellerProduct->is_owner == 1) {
                    $this->sellerProduct->delete($sellerProduct->id);
                    $this->product->delete($sellerProduct->product_id);
                } else {
                    $this->sellerProduct->delete($sellerProduct->id);
                }
            }
        }

        session()->flash('success', trans('admin::app.catalog.products.mass-delete-success'));

        return redirect()->route($this->_config['redirect']);
    }

    public function sellerProducts(Request $request , $sellerId , $productSlug)
    {
        $slugOrPath = trim($request->getPathInfo(), '/');

        $slugOrPath = urldecode($slugOrPath);

        // support url for chinese, japanese, arbic and english with numbers.
        if (preg_match('/^([\x{0621}-\x{064A}\x{4e00}-\x{9fa5}\x{3402}-\x{FA6D}\x{3041}-\x{30A0}\x{30A0}-\x{31FF}_a-z0-9-]+\/?)+$/u', $slugOrPath)) {

            $explodeArr = explode('/',$slugOrPath);
            $product = $this->coreProduct->findBySlug($explodeArr[3]);
            if ($product) {

                $customer = auth()->guard('customer')->user();
                $seller = $this->sellerProduct->getSellerByProductId($product->product_id);

                return view($this->_config['view'], compact('product','customer','seller'));
            }
        }
    }

    /***
     * get product bundle options
     *
    */
    public function bundleProductItem(){

        $channel = core()->getRequestedChannelCode();
        $locale = core()->getRequestedLocaleCode();

        if(!empty(request('query'))){
            $productId = request('query');

            /**Find product bundle items*/
            $productItems = DB::table('product_bundle_options')
                ->join('product_bundle_option_translations', 'product_bundle_options.id','=', 'product_bundle_option_translations.product_bundle_option_id')
                ->select('product_bundle_options.*','product_bundle_option_translations.label')
                ->where('product_id',$productId)
                ->get();

            if($productItems->count() > 0){
                $productItems =  $productItems->filter(function ($item, $key) use ($channel , $locale){
                    $productOptions = DB::table('product_bundle_option_products')
                        ->join('product_flat','product_bundle_option_products.product_id','=','product_flat.product_id')
                        ->select('product_bundle_option_products.*', 'product_flat.name','product_flat.product_number','product_flat.sku')
                        ->where([ ['product_bundle_option_id','=',$item->id], ['product_flat.channel', '=', $channel], ['product_flat.locale', '=', $locale] ])
                        ->get();

                    if($productOptions->count() > 0){
                        $item->product_option = $productOptions;
                    }else{
                        $item->product_option = NULL;
                    }
                    return $item;
                });

                return ['status'=>200,'res'=>$productItems];
            }else{
                return ['status'=>100];
            }
        }
    }
}
