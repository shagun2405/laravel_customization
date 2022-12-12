<?php

namespace Webkul\GalaxyClinic\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;

/**
 * Seller Product Reposotory
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ProductRepository extends Repository
{

    /**
     * Create a new repository instance.
     *
     *
     * @param  Illuminate\Container\Container                         $app
     * @return void
     */
    public function __construct(
        App $app,
    )
    {
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Marketplace\Contracts\Product';
    }

    /**
     * Search Product by Attribute
     *
     * @return Collection
     */
    public function searchProducts($term)
    {
        $results = app('Webkul\Product\Repositories\ProductFlatRepository')->scopeQuery(function($query) use($term) {
            $channel = request()->get('channel') ?: (core()->getCurrentChannelCode() ?: core()->getDefaultChannelCode());

            $locale = request()->get('locale') ?: app()->getLocale();

            return $query->distinct()
                    ->addSelect('product_flat.*')
                    ->leftJoin('marketplace_products', 'product_flat.product_id', '=', 'marketplace_products.product_id')
                    ->leftJoin('products', 'product_flat.product_id', '=', 'products.id')
                    ->where('products.type', 'booking')
                    ->where('product_flat.status', 1)
                    ->where('product_flat.channel', $channel)
                    ->where('product_flat.locale', $locale)
                    ->whereNotNull('product_flat.url_key')
                    ->where('product_flat.name', 'like', '%' . $term . '%')
                    ->where(function ($query) {
                        $query->whereNull('marketplace_products.marketplace_seller_id')
                        ->orWhere('marketplace_products.is_owner', '=',  0);
                    })
                    ->orderBy('product_id', 'desc');
        })->paginate(16);

        return $results;
    }

    /**
     * @return mixed
     */
    public function createAssign(array $data)
    {
        $sellerProduct = parent::create($data);

        return $sellerProduct;
    }
}