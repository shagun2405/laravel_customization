<?php

namespace Webkul\Marketplace\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Webkul\Core\Repositories\SliderRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Category\Repositories\CategoryRepository;

class ProductsCategoriesProxyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Category\Repositories\CategoryRepository  $categoryRepository
     * @param  \Webkul\Product\Repositories\ProductRepository  $productRepository
     * @return void
     */
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected ProductRepository $productRepository,
        protected SliderRepository $sliderRepository
    )
    {
        $this->_config = request('_config');
        // parent::__construct();
    }

    /**
     * Show product or category view. If neither category nor product matches, abort with code 404.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Exception
     */
    public function index(Request $request)
    {
        $slugOrPath = trim($request->getPathInfo(), '/');

        $slugOrPath = urldecode($slugOrPath);

        // support url for chinese, japanese, arbic and english with numbers.
        if (preg_match('/^([\x{0621}-\x{064A}\x{4e00}-\x{9fa5}\x{3402}-\x{FA6D}\x{3041}-\x{30A0}\x{30A0}-\x{31FF}_a-z0-9-]+\/?)+$/u', $slugOrPath)) {
            if ($category = $this->categoryRepository->findByPath($slugOrPath)) {
                return view($this->_config['category_view'], compact('category'));
            }

            if ($product = $this->productRepository->findBySlug($slugOrPath)) {
                $customer = auth()->guard('customer')->user();
                $seller = app('Webkul\Marketplace\Repositories\ProductRepository')->getSellerByProductId($product->id);
                if(($product->status && $seller) || !$seller || strpos(url()->previous(),"/admin/")){
                    return view($this->_config['product_view'], compact('product', 'customer'));
                }
            }

            abort(404);
        }

        $sliderData = $this->sliderRepository->getActiveSliders();

        return view('shop::home.index', compact('sliderData'));
    }
}
