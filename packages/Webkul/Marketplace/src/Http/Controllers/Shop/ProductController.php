<?php

namespace Webkul\Marketplace\Http\Controllers\Shop;

use Illuminate\Support\Facades\Storage;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Repositories\ProductRepository;
use Webkul\Marketplace\Repositories\ProductDownloadableSampleRepository;
use Webkul\Marketplace\Repositories\ProductDownloadableLinkRepository;

use Webkul\Product\Repositories\ProductRepository as BaseProductRepository;

/**
 * Marketplace product controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ProductController extends Controller
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
     * ProductRepository object
     *
     * @var array
    */
    protected $product;

    /**
     * ProductRepository object
     *
     * @var array
    */
    protected $baseProduct;

    /**
     * ProductDownloadableSampleRepository object
     *
     * @var \Webkul\Marketplace\Repositories\ProductDownloadableSampleRepository
     */
    protected $productDownloadableSampleRepository;

    /**
     * ProductDownloadableLinkRepository object
     *
     * @var \Webkul\Marketplace\Repositories\ProductDownloadableLinkRepository
     */
    protected $productDownloadableLinkRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Marketplace\Repositories\SellerRepository  $seller
     * @param  Webkul\Marketplace\Repositories\ProductRepository $product
     * @param  Webkul\Product\Repositories\ProductRepository     $baseProduct
     * @param  Webkul\Marketplace\Repositories\ProductDownloadableSampleRepository  $productDownloadableSampleRepository
     * @param  Webkul\Marketplace\Repositories\ProductDownloadableLinkRepository  $productDownloadableLinkRepository

     * @return void
     */
    public function __construct(
        SellerRepository $seller,
        ProductRepository $product,
        BaseProductRepository $baseProduct,
        ProductDownloadableSampleRepository  $productDownloadableSampleRepository,
        ProductDownloadableLinkRepository  $productDownloadableLinkRepository
    )
    {
        $this->_config = request('_config');

        $this->seller = $seller;

        $this->product = $product;

        $this->baseProduct = $baseProduct;

        $this->productDownloadableSampleRepository = $productDownloadableSampleRepository;

        $this->productDownloadableLinkRepository = $productDownloadableLinkRepository;

    }

    /**
     * Method to populate the seller product page which will be populated.
     *
     * @param  string  $url
     * @return Mixed
     */
    public function index($url)
    {
        $seller = $this->seller->findByUrlOrFail($url);

        return view($this->_config['view'], compact('seller'));
    }

    /**
     * Product offers by sellers
     *
     * @param  integer $id
     * @return Mixed
     */
    public function offers($id)
    {
        $product = $this->baseProduct->findOrFail($id);

        if ($product->type == 'configurable') {
            session()->flash('error', trans('shop::app.checkout.cart.integrity.missing_options'));

            return redirect()->route('shop.productOrCategory.index', ['slug' => $product->url_key]);
        }

        return view($this->_config['view'], compact('product'));
    }

    /**
     * Download the for the specified resource.
     *
     * @return \Illuminate\Http\Response|\Exception
     */
    public function downloadSample()
    {
        try {
            if (request('type') == 'link') {
                $productDownloadableLink = $this->productDownloadableLinkRepository->findOrFail(request('id'));

                if ($productDownloadableLink->sample_type == 'file') {
                    $privateDisk = Storage::disk('private');

                    return $privateDisk->exists($productDownloadableLink->sample_file)
                        ? $privateDisk->download($productDownloadableLink->sample_file)
                        : abort(404);
                } else {
                    $fileName = $name = substr($productDownloadableLink->sample_url, strrpos($productDownloadableLink->sample_url, '/') + 1);

                    $tempImage = tempnam(sys_get_temp_dir(), $fileName);

                    copy($productDownloadableLink->sample_url, $tempImage);

                    return response()->download($tempImage, $fileName);
                }
            } else {
                $productDownloadableSample = $this->productDownloadableSampleRepository->findOrFail(request('id'));

                if ($productDownloadableSample->type == 'file') {
                    return Storage::download($productDownloadableSample->file);
                } else {
                    $fileName = $name = substr($productDownloadableSample->url, strrpos($productDownloadableSample->url, '/') + 1);

                    $tempImage = tempnam(sys_get_temp_dir(), $fileName);

                    copy($productDownloadableSample->url, $tempImage);

                    return response()->download($tempImage, $fileName);
                }
            }
        } catch(\Exception $e) {
            abort(404);
        }
    }
}