<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;

use Webkul\Marketplace\Repositories\OrderRepository;
use Webkul\Marketplace\Repositories\TransactionRepository;
use Webkul\Marketplace\DataGrids\Admin\TransactionDataGrid;

/**
 * Transaction controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class TransactionController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * OrderRepository object
     *
     * @var mixed
     */
    protected $orderRepository;

    /**
     * TransactionRepository object
     *
     * @var mixed
     */
    protected $transactionRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Marketplace\Repositories\OrderRepository       $orderRepository
     * @param  Webkul\Marketplace\Repositories\TransactionRepository $transactionRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        TransactionRepository $transactionRepository
    )
    {
        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(TransactionDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }
}