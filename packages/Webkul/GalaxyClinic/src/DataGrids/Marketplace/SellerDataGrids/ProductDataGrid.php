<?php

namespace Webkul\GalaxyClinic\DataGrids\Marketplace\SellerDataGrids;

use DB;
use Webkul\Marketplace\DataGrids\Shop\ProductDataGrid as MarketplaceProductDataGrid;

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
        $seller = $this->sellerRepository->findOneByField('customer_id', auth()->guard('customer')->user()->id);

        $queryBuilder =  DB::table('product_flat')
        ->leftJoin('products', 'product_flat.product_id', '=', 'products.id')
        ->join('marketplace_products', 'product_flat.product_id', '=', 'marketplace_products.product_id')
        ->leftJoin('marketplace_sellers', 'marketplace_products.marketplace_seller_id', '=', 'marketplace_sellers.id')
        ->leftJoin('customers', 'marketplace_sellers.customer_id', '=', 'customers.id')
        ->leftJoin('booking_services', 'product_flat.product_id', '=', 'booking_services.product_id')
        ->addSelect('products.type as product_type','marketplace_products.id as marketplace_product_id',
        'product_flat.product_id', 'product_flat.sku', 'product_flat.name as name', 'product_flat.product_number',
        'marketplace_products.is_owner', 'marketplace_products.is_approved',
        DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as seller_name'),
        DB::raw('(CASE WHEN marketplace_products.is_owner = 1 THEN product_flat.price ELSE marketplace_products.price END) AS price'))

        ->where('marketplace_products.marketplace_seller_id', $seller->id)
        ->where('booking_services.is_service', null)
        ->where('channel', core()->getCurrentChannelCode())
        ->where('locale', app()->getLocale())
        ->distinct();

        $queryBuilder = $queryBuilder->leftJoin('product_inventories', function($qb) {

            $seller = $this->sellerRepository->findOneByField('customer_id', auth()->guard('customer')->user()->id);

            $qb->on('product_flat.product_id', 'product_inventories.product_id')
                ->where('product_inventories.vendor_id', '=', $seller->id);
        });

        $queryBuilder
            ->groupBy('product_flat.product_id')
            ->addSelect(DB::raw('SUM(product_inventories.qty) as quantity'));

        $this->addFilter('sku', 'product_flat.sku');
        $this->addFilter('product_id', 'product_flat.product_id');
        $this->addFilter('product_number', 'product_flat.product_number');
        $this->addFilter('product_type', 'products.type');
        $this->addFilter('name', 'product_flat.name');
        $this->addFilter('is_approved', 'marketplace_products.is_approved');
        $this->addFilter('price', DB::raw('(CASE WHEN marketplace_products.is_owner = 1 THEN product_flat.price ELSE marketplace_products.price END)'));

        $this->setQueryBuilder($queryBuilder);
    }
}