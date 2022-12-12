<?php

namespace Webkul\Marketplace\Http\Controllers\Shop;

use Mail;
use Webkul\Marketplace\Mail\ReportProductNotification;
use Webkul\Marketplace\Mail\AdminReportProductNotification;
use Webkul\Marketplace\Mail\ReportSellerNotification;
use Webkul\Marketplace\Repositories\ProductFlagRepository;
use Webkul\Marketplace\Repositories\ProductRepository;
use Webkul\Marketplace\Repositories\SellerFlagRepository;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\User\Repositories\AdminRepository;

/**
 * Marketplace flag controller
 *
 * @author    Mohammad Asif <mohdasif.woocommerce337@webkul.com>
 * @copyright 2020 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class FlagController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * productFlagRepository object
     *
     *  @object
     */
    protected $productFlagRepository;

    protected $ProductRepository;

    protected $adminRepository;

    /**
     * sellerFlagRepository object
     *
     * @var array
     */
    protected $sellerFlagRepository;

    /**
     * sellerRepository object
     *
     * @var array
     */
    protected $sellerRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Marketplace\Repositories\ProductFlagRepository $productFlagRepository
     * @param  Webkul\Marketplace\Repositories\SellerFlagRepository $sellerFlagRepository
     * @param  Webkul\User\Repositories\AdminRepository  $adminRepository
     * @return void
     */
    public function __construct(
        SellerRepository $sellerRepository,
        SellerFlagRepository $sellerFlagRepository,
        ProductFlagRepository $productFlagRepository,
        ProductRepository $productRepository,
        AdminRepository $adminRepository
    )
    {
        $this->_config = request('_config');

        $this->sellerRepository = $sellerRepository;

        $this->productFlagRepository = $productFlagRepository;

        $this->sellerFlagRepository = $sellerFlagRepository;

        $this->productRepository = $productRepository;

        $this->adminRepository = $adminRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function productFlagstore()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'product_id' => 'required'
        ]);
        $flag = $this->productFlagRepository->findOneByField(['email'=>request()->email,'product_id'=>request()->product_id]);
        if(!$flag){
            $data = request()->all();

            $seller = $this->sellerRepository->find(request()->seller_id);

            $data['admin'] = $this->adminRepository->findOneWhere(['role_id' => 1]);

            $data['product'] = $this->productRepository->findOneByField('product_id',request()->product_id)->product;

            $this->productFlagRepository->create($data);

            $data['subject'] = 'Report Seller Product';

            try {

                Mail::send(new ReportProductNotification($seller->customer, $data));
                Mail::send(new AdminReportProductNotification($seller->customer, $data));
                session()->flash('success', 'Product has been reported successfully.');

            } catch (\Exception $e) {
                report($e);
                session()->flash('warning', 'something, went wrong.');
            }
        }
        else{
            session()->flash('warning', 'You have already reported for this product');
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function sellerFlagstore()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|unique:marketplace_seller_flags'
        ]);

        $data = request()->all();
        $data['subject'] = 'Report Seller';
        $data['query'] = $data['reason'];

        $seller = $this->sellerRepository->find($data['seller_id']);
        

        $this->sellerFlagRepository->create($data);

        try {

            $sellerId = $this->sellerRepository->findOneByField('customer_id', auth()->guard('customer')->user()->id)->id;
            if($sellerId == $seller->id){
                session()->flash('warning', 'You can not report to your self');
            }else{
                Mail::send(new ReportSellerNotification($seller, $data));
                // Mail::send(new AdminReportSellerNotification($seller, request()->all()));

                session()->flash('success', 'Seller has been reported successfully.');
            }

        } catch (\Exception $e) {
            report($e);
            session()->flash('warning', 'something went wrong.');
        }

        return redirect()->back();
    }
}