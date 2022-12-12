<?php

namespace Webkul\GalaxyClinic\DataGrids\Shop;

use DB;
use Webkul\Ui\DataGrid\DataGrid;
use Webkul\Marketplace\Repositories\SellerRepository;

/**
 * Product Data Grid class
 *
 * @author    Anmol Singh Chauhan <anmol.chauhan207@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
*/
class ProductDataGrid extends DataGrid
{
    /**
     * @var integer
     */
    protected $index = 'marketplace_product_id';

    /**
     * @var string
     */
    protected $sortOrder = 'desc'; //asc or desc

    /**
     * Create a new repository instance.
     *
     * @param  Webkul\Marketplace\Repositories\SellerRepository $sellerRepository
     * @return void
     */
    public function __construct(
        protected SellerRepository $sellerRepository
    ) {
        parent::__construct();
    }

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
        ->where('booking_services.is_service', 1)
        ->where('channel', core()->getCurrentChannelCode())
        ->where('locale', app()->getLocale())
        ->distinct();

        $this->addFilter('sku', 'product_flat.sku');
        $this->addFilter('product_id', 'product_flat.product_id');
        $this->addFilter('product_number', 'product_flat.product_number');
        $this->addFilter('product_type', 'products.type');
        $this->addFilter('name', 'product_flat.name');
        $this->addFilter('is_approved', 'marketplace_products.is_approved');
        $this->addFilter('price', DB::raw('(CASE WHEN marketplace_products.is_owner = 1 THEN product_flat.price ELSE marketplace_products.price END)'));
        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {

        $this->addColumn([
            'index' => 'marketplace_product_id',
            'label' => trans('marketplace::app.shop.sellers.account.catalog.products.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index'      => 'product_number',
            'label'      => trans('marketplace::app.shop.sellers.account.catalog.products.product-number'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'sku',
            'label' => trans('marketplace::app.shop.sellers.account.catalog.products.sku'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => trans('marketplace::app.shop.sellers.account.catalog.products.name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index'      => 'product_type',
            'label'      => trans('admin::app.datagrid.type'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'price',
            'label' => trans('marketplace::app.shop.sellers.account.catalog.products.price'),
            'type' => 'price',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true,
            'closure' => function($row) {
                return number_format($row->price, 2);
            }
        ]);

        $this->addColumn([
            'index' => 'is_approved',
            'label' => trans('marketplace::app.shop.sellers.account.catalog.products.is-approved'),
            'type' => 'boolean',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true,
            'closure' => function($row) {
                if ($row->is_approved == 1)
                    return trans('marketplace::app.shop.sellers.account.catalog.products.yes');
                else
                    return trans('marketplace::app.shop.sellers.account.catalog.products.no');
            }
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'type' => 'Edit',
            'method' => 'GET',
            'route' => 'galaxyclinic.account.services.assign.edit',
            'icon' => 'icon pencil-lg-icon',
            'title' => trans('ui::app.datagrid.edit'),
        ], true);

        $this->addAction([
            'method' => 'POST',
            'route' => 'galaxyclinic.account.services.assign.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'product']),
            'icon' => 'icon trash-icon',
            'title' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'product']),
        ], true);
    }

    public function prepareMassActions() {

        $this->addMassAction([
            'type' => 'delete',
            'label' => trans('marketplace::app.shop.sellers.account.catalog.products.delete'),
            'action' => route('galaxyclinic.account.services.assign.massdelete'),
            'method' => 'POST'
        ], true);
    }
}