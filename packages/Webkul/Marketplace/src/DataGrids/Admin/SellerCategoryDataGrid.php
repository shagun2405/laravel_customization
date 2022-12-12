<?php

namespace Webkul\Marketplace\DataGrids\Admin;

use DB;
use Webkul\Ui\DataGrid\DataGrid;

/**
 * Seller Data Grid class
 *
 * @author Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class SellerCategoryDataGrid extends DataGrid
{
    /**
     *
     * @var integer
     */
    public $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    protected $enableFilterMap = true;

    protected $extraFilters = [
        'channels',
        'locales',
    ];

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('seller_categories')
                            ->leftJoin('marketplace_sellers', 'seller_categories.seller_id', 'marketplace_sellers.id')
                            ->leftJoin('customers', 'marketplace_sellers.customer_id', 'customers.id')

                ->select(DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as name'),
                         'seller_categories.categories',
                         'seller_categories.id'
                );

                $this->addFilter('name', DB::raw('CONCAT(customers.first_name, " ", customers.last_name)'));

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => trans('marketplace::app.admin.sellers.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => trans('marketplace::app.admin.flag.name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'type' => 'edit',
            'method' => 'GET',
            'route' => 'admin.marketplace.seller.category.edit',
            'icon' => 'icon pencil-lg-icon',
            'title' => ''
        ], true);

        $this->addAction([
            'title'  => trans('admin::app.datagrid.delete'),
            'method' => 'POST',
            'route' => 'admin.marketplace.seller.category.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'Selller Category']),
            'icon' => 'icon trash-icon',
        ]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'label'  => trans('marketplace::app.admin.sellers.delete'),
            'action' => route('admin.marketplace.seller.category.mass-delete'),
            'method' => 'POST',
            'title'  => ''
        ], true) ;
    }
}