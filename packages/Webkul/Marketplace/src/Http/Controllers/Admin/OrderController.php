<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;
use Mail;
use Webkul\Marketplace\Repositories\OrderRepository;
use Webkul\Marketplace\Repositories\TransactionRepository;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Mail\PaymentRequestCompleteNotification;
use Webkul\Marketplace\DataGrids\Admin\OrderDataGrid;

/**
 * Marketplace seller order controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class OrderController extends Controller
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
     * @var object
    */
    protected $orderRepository;

    /**
     * TransactionRepository object
     *
     * @var object
    */
    protected $transactionRepository;

        /**
     * sellerRepository object
     *
     * @var object
    */
    protected $sellerRepository;

    
    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Marketplace\Repositories\OrderRepository       $orderRepository
     * @param  Webkul\Marketplace\Repositories\TransactionRepository $transactionRepository
     * @param  Webkul\Marketplace\Repositories\SellerRepository      $sellerRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        TransactionRepository $transactionRepository,
        SellerRepository $sellerRepository
    )
    {
        $this->orderRepository = $orderRepository;

        $this->sellerRepository = $sellerRepository;

        $this->transactionRepository = $transactionRepository;

        $this->_config = request('_config');
    }

    /**
     * Method to populate the seller order page which will be populated.
     *
     * @return Mixed
     */
    public function index($url)
    {   
        if (request()->ajax()) {
            return app(OrderDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Pay seller
     *
     * @return Mixed
     */
    public function pay()
    {
        $orderRepository = $this->orderRepository->findOneWhere(['order_id' => request()->order_id]);

        $seller = $this->sellerRepository->findOneWhere(['id' => request()->seller_id]);

        if($orderRepository) {

            $this->transactionRepository->paySeller(request()->all());

            try {
                Mail::send(new PaymentRequestCompleteNotification($orderRepository,$seller));
            } catch (\Exception $e) {
                report($e);
            }
            session()->flash('success', trans('marketplace::app.admin.orders.payment-success-msg'));
        }

        return redirect()->back();
    }
}