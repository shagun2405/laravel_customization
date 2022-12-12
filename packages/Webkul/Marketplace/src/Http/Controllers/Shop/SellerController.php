<?php

namespace Webkul\Marketplace\Http\Controllers\Shop;

use Illuminate\Support\Facades\Mail;
use Webkul\Marketplace\Http\Requests\ContactSellerForm;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Mail\ContactSellerNotification;
use Webkul\Marketplace\Mail\SellerQueryNotification;

/**
 * Marketplace seller page controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class SellerController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * SellerRepository object
     *
     * @var array
    */
    protected $seller;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Marketplace\Repositories\SellerRepository $seller
     * @return void
     */
    public function __construct(SellerRepository $seller)
    {
        $this->_config = request('_config');

        $this->seller = $seller;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $seller = $this->seller->findByUrlOrFail($url);

        return view($this->_config['view'], compact('seller'));
    }

    /**
     * Send query email to seller
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function contact(ContactSellerForm $form, $url)
    {
        $seller = $this->seller->findByUrlOrFail($url);
        $sellerId = $this->seller->findOneByField('customer_id', auth()->guard('customer')->user()->id)->id;
        try {
            if($sellerId == $seller->id){
               $msg = 'You can not send Query to your self';
            }else{
               Mail::send(new ContactSellerNotification($seller, request()->all()));
            }
        } catch (\Exception $e) {}

        return response()->json([
                'success' => isset($msg) ? false : true,
                'message' => isset($msg) ? $msg : 'Email has been sent successfully. Seller will contact you as soon as possible.',
            ]);
    }

    /**
     * Send query email to seller
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function sellerQuery()
    {
        request()->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'query' => 'required',
        ]);

        try {
            Mail::send(new SellerQueryNotification(request()->all()));
        } catch (\Exception $e) {}

        return response()->json([
                'success' => true,
                'message' => 'Email has been sent successfully. Adminstrator will contact you as soon as possible.'
            ]);
    }

    /**
     * Check if shop url available or not
     *
     * @return \Illuminate\Http\Response
     */
    public function checkShopUrl()
    {
        $seller = $this->seller->findOneByField([
                'url' => trim(request()->input('url'))
            ]);

        return response()->json([
                'available' => $seller ? false : true
            ]);
    }

    public function getSellerInfo ()
    {
        $cartItems = request()->all();

        $productRepository = app('Webkul\Marketplace\Repositories\ProductRepository');

        $reviewRepository = app('Webkul\Marketplace\Repositories\ReviewRepository');

        $sellerInfo = [];

        foreach ($cartItems as $cartItem) {

            $seller = $productRepository->getSellerByProductId($cartItem['product_id']);

            if(! isset($seller)){
                $seller = $productRepository->getSellerByAssignProductId($cartItem['product_id']);
            }
            
            if(! isset($seller)) {
                $sellerInfo[$cartItem['product_id']] = ['seller' => 0, 'rating'=> 0];
            } else {
                $sellerProduct = $productRepository->getMarketplaceProductByProduct($cartItem['product_id'], $seller->id);
                $images  = $sellerProduct->images;

                if (count($images) < 1) {
                    $baseProductRepository = app('Webkul\Product\Repositories\ProductRepository')->find($cartItem['product_id']);
                    $images =  productimage()->getGalleryImages( $baseProductRepository);
                }

                if (isset($sellerProduct) && $sellerProduct->is_approved) {
                    $sellerInfo[$cartItem['product_id']] = ['seller'=> $seller, 'rating' => $reviewRepository->getAverageRating($seller)];
                    $sellerInfo[$cartItem['product_id']] = ['seller'=> $seller, 'rating' => $reviewRepository->getAverageRating($seller), 'image' => $images];
                }
            }
        }
        
        return response()->json($sellerInfo, 200);;
    }
}