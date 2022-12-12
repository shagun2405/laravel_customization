<?php

namespace Webkul\GalaxyClinic\DataGrids\Marketplace\AdminDataGrids;

use DB;
use Webkul\Marketplace\DataGrids\Admin\ProductDataGrid as MarketplaceProductDataGrid;

/**
 * Product Data Grid class
 *
 * @author Anmol Singh Chauhan <anmol.chauhan207@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
*/
class ProductDataGrid extends MarketplaceProductDataGrid
{
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('marketplace_products')
            ->leftJoin('product_flat', 'marketplace_products.product_id', '=', 'product_flat.product_id')
            ->leftJoin('products', 'product_flat.product_id', '=', 'products.id')
            ->leftJoin('marketplace_product_flags', 'product_flat.product_id', '=', 'marketplace_product_flags.product_id')
            ->leftJoin('marketplace_sellers', 'marketplace_products.marketplace_seller_id', '=', 'marketplace_sellers.id')
            ->leftJoin('customers', 'marketplace_sellers.customer_id', '=', 'customers.id')
            ->leftJoin('booking_services', 'product_flat.product_id', '=', 'booking_services.product_id')
            ->leftJoin('product_inventories', function($join)
            {
                $join->on('marketplace_sellers.id', '=', 'product_inventories.vendor_id');
                $join->on('product_inventories.product_id','=','marketplace_products.product_id');

            })
            ->addSelect('product_inventories.qty as quantity')->groupBy('marketplace_products.id')
            ->addSelect(
                'marketplace_products.id as marketplace_product_id',
                'product_flat.product_id',
                'product_flat.sku',
                'product_flat.url_key',
                'product_flat.name as product_flat_name',
                'products.type as product_type',
                'product_flat.product_number',
                'marketplace_products.is_owner',
                'marketplace_products.is_approved',
                DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as seller_name'),
                DB::raw('COUNT(marketplace_product_flags.id) as flags'),
                DB::raw('(CASE WHEN marketplace_products.is_owner = 1 THEN product_flat.price ELSE marketplace_products.price END) AS price')
                )

                ->where('channel', core()->getCurrentChannelCode())
                ->where('locale', app()->getLocale())
                ->where('booking_services.is_service', null);

        $this->addFilter('seller_name', DB::raw('CONCAT(customers.first_name, " ", customers.last_name)'));
        $this->addFilter('sku', 'product_flat.sku');
        $this->addFilter('product_id', 'product_flat.product_id');
        $this->addFilter('product_number', 'product_flat.product_number');
        $this->addFilter('product_flat_name', 'product_flat.name');
        $this->addFilter('product_type', 'products.type');
        $this->addFilter('is_approved', 'marketplace_products.is_approved');
        $this->addFilter('price', DB::raw('(CASE WHEN marketplace_products.is_owner = 1 THEN product_flat.price ELSE marketplace_products.price END)'));
        $this->setQueryBuilder($queryBuilder);
    }
}