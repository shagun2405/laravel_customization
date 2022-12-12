<?php

namespace Webkul\GalaxyClinic\Http\Controllers\Shop\Account;

use Exception;
use Illuminate\Support\Facades\Event;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\GalaxyClinic\Http\Controllers\Shop\Controller;
use Webkul\Product\Repositories\ProductRepository as CoreProductRepository;
use Webkul\Marketplace\Repositories\ProductRepository as SellerProductRepository;
use Webkul\GalaxyClinic\Repositories\ProductRepository as GalaxyClinicProductRepository;

/**
 * Assign Product controller
 *
 * @author    Anmol Singh Chauhan <anmol.chauhan207@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class AssignServiceController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    public function __construct(
        protected SellerRepository $sellerRepository,
        protected CoreProductRepository $coreProductRepository,
        protected SellerProductRepository $sellerProductRepository,
        protected GalaxyClinicProductRepository $galaxyClinicProductRepository,
    )
    {
        $this->_config = request('_config');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = $this->sellerRepository->findOneWhere(['customer_id' => auth()->guard('customer')->user()->id])->toArray();

        foreach ($seller as $key => $sellerInput) {
            if ($key == 'logo' && $sellerInput == null) {
                return redirect()->back()->with('warning', __('marketplace::app.shop.sellers.account.profile.validation.logo'));
            }
            if ($key == 'shop_title' && $sellerInput == null) {
                return redirect()->back()->with('warning', __('marketplace::app.shop.sellers.account.profile.validation.shop_title'));
            }
            if ($key == 'address1' && $sellerInput == null) {
                return redirect()->back()->with('warning', __('marketplace::app.shop.sellers.account.profile.validation.shop_title'));
            }
            if ($key == 'phone' && $sellerInput == null) {
                return redirect()->back()->with('warning', __('marketplace::app.shop.sellers.account.profile.validation.phone'));
            }
            if ($key == 'state' && $sellerInput == null) {
                return redirect()->back()->with('warning', __('marketplace::app.shop.sellers.account.profile.validation.state'));
            }
            if ($key == 'city' && $sellerInput == null) {
                return redirect()->back()->with('warning', __('marketplace::app.shop.sellers.account.profile.validation.city'));
            }
            if ($key == 'country' && $sellerInput == null) {
                return redirect()->back()->with('warning', __('marketplace::app.shop.sellers.account.profile.validation.country'));
            }
            if ($key == 'postcode' && $sellerInput == null) {
                return redirect()->back()->with('warning', __('marketplace::app.shop.sellers.account.profile.validation.postcode'));
            }
        }

        if (request()->input('query')) {
            $results = [];

            foreach ($this->galaxyClinicProductRepository->searchProducts(request()->input('query')) as $row) {
                $results[] = [
                        'id' => $row->product_id,
                        'sku' => $row->sku,
                        'name' => $row->name,
                        'price' => core()->convertPrice($row->price),
                        'formated_price' => core()->currency($row->price),
                        'base_image' => $row->product->base_image_url,
                    ];
            }

            return response()->json($results);
        } else {
            return view($this->_config['view']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'product_id' => 'required',
        ]);

        $data = request()->all();

        $seller = $this->sellerRepository->findOneByField('customer_id', auth()->guard('customer')->user()->id);

        $product = $this->galaxyClinicProductRepository->findOneWhere([
            'product_id' => $data['product_id'],
            'marketplace_seller_id' => $seller->id,
        ]);

        if ($product) {
            session()->flash('error', 'You are already selling this product..');
            return redirect()->route('galaxyclinic.account.services.search');
        }

        $coreProduct = $this->coreProductRepository->findOrFail($data['product_id']);

        $data = array_merge(request()->all(), [
                'product_id' => $data['product_id'],
                'is_owner' => 0,
                'price' => $coreProduct->price,
                'description' => $coreProduct->description,
            ]);

        $product = $this->sellerProductRepository->createAssign($data);

        session()->flash('success', 'Product assigned successfully.');

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->sellerProductRepository->findorFail($id);

        return view($this->_config['view'], compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'price' => 'required',
            'description' => 'required'
        ]);

        $this->sellerProductRepository->updateAssign(request()->all(), $id);

        session()->flash('success', 'Assigned product updated successfully.');

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
        $sellerProduct = $this->sellerProductRepository->findOrFail($id);

        try {

            $this->sellerProductRepository->delete($sellerProduct->id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Booking Service']));

            return response()->json(['message' => true], 200);
        } catch (Exception $e) {
            report($e);

            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Booking Service']));
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
            $sellerProduct = $this->sellerProductRepository->findOrFail($productId);

            $this->sellerProductRepository->delete($sellerProduct->id);
        }

        session()->flash('success', trans('admin::app.catalog.products.mass-delete-success'));

        return redirect()->route($this->_config['redirect']);
    }
}