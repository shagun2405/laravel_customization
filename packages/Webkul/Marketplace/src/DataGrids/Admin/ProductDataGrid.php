<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use DB;
use Webkul\Ui\DataGrid\DataGrid;

/**
 * Product Data Grid class
 *
 * @author Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ProductDataGrid extends DataGrid
{
    /**
     *
     * @var integer
     */
    public $index = 'marketplace_product_id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('marketplace_products')
            ->leftJoin('product_flat', 'marketplace_products.product_id', '=', 'product_flat.product_id')
            ->leftJoin('products', 'product_flat.product_id', '=', 'products.id')
            ->leftJoin('marketplace_product_flags', 'product_flat.product_id', '=', 'marketplace_product_flags.product_id')
            ->leftJoin('marketplace_sellers', 'marketplace_products.marketplace_seller_id', '=', 'marketplace_sellers.id')
            ->leftJoin('customers', 'marketplace_sellers.customer_id', '=', 'customers.id')
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
                // DB::raw('(CASE WHEN marketplace_products.is_owner = 1 THEN marketplace_products.price ELSE marketplace_products.price END) AS price')
                )

                ->where('channel', core()->getCurrentChannelCode())
                ->where('locale', app()->getLocale());

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

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'product_id',
            'label' => trans('marketplace::app.admin.products.product-id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index'      => 'product_number',
            'label'      => trans('marketplace::app.admin.products.product-number'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
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
            'index' => 'seller_name',
            'label' => trans('marketplace::app.admin.sellers.seller-name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'sku',
            'label' => trans('marketplace::app.admin.products.sku'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'product_flat_name',
            'label' => trans('marketplace::app.admin.products.name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function($row) {
                if ($row->url_key) {
                    return '<a target="_blank" href="' . route('shop.productOrCategory.index', $row->url_key) . '">' . $row->product_flat_name . '</a>';
                } else {
                    return $row->product_flat_name;
                }
            }
        ]);

        if ( (core()->getConfigData('marketplace.settings.product_flag.enable'))) {
            $this->addColumn([
                'index' => 'flags',
                'label' => trans('marketplace::app.admin.flag.title'),
                'type' => 'integer',
                'searchable' => false,
                'sortable' => true,
                'filterable' => false,
                'closure' => function($row) {
                    return '<a href="'.route('admin.catalog.products.edit', $row->product_id).'">' . $row->flags . '</a>';
                }
            ]);
        }

        $this->addColumn([
            'index' => 'price',
            'label' => trans('marketplace::app.admin.products.price'),
            'type' => 'price',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true,
            'closure' => function($row) {
                return number_format($row->price, 2);
            }
        ]);

        $this->addColumn([
            'index' => 'quantity',
            'label' => trans('marketplace::app.admin.products.quantity'),
            'type' => 'number',
            'sortable' => true,
            'searchable' => false,
            'filterable' => false
        ]);

        $this->addColumn([
            'index' => 'is_approved',
            'label' => trans('marketplace::app.admin.products.status'),
            'type' => 'boolean',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true,
            'closure' => function($row) {
                if ($row->is_approved == 1)
                    return '<span class="badge badge-md badge-success">' . trans('marketplace::app.admin.sellers.approved') . '</span>';
                else 
                    return '<span class="badge badge-md badge-danger">' . trans('marketplace::app.admin.sellers.un-approved') . '</span>';
            }
        ]);
    }

    public function prepareActions()
    {
        // $this->addAction([
        //     'title'     => trans('admin::app.datagrid.edit'),
        //     'method'    => 'GET',
        //     'route'     => 'admin.marketplace.products.edit',
        //     'icon'      => 'icon pencil-lg-icon',
        //     'condition' => function () {
        //         return true;
        //     },
        // ]);

        $this->addAction([
            'type' => 'delete',
            'method' => 'POST',
            'route' => 'admin.marketplace.products.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'product']),
            'icon' => 'icon trash-icon',
            'title' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'product'])
        ]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'type' => 'delete',
            'label' => trans('marketplace::app.admin.products.delete'),
            'action' => route('admin.marketplace.products.massdelete'),
            'method' => 'POST'
        ]);

        $this->addMassAction([
            'type' => 'update',
            'label' => trans('marketplace::app.admin.products.update'),
            'action' => route('admin.marketplace.products.massupdate'),
            'method' => 'POST',
            'options' => [
                trans('marketplace::app.admin.sellers.approve') => 1,
                trans('marketplace::app.admin.sellers.unapprove') => 0
            ]
        ]);
    }
}