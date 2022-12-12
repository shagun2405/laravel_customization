<?php

namespace Webkul\Marketplace\Http\Controllers\Shop\Account\Sales;
use Mail;
use Webkul\Marketplace\Repositories\OrderRepository;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\Marketplace\Mail\PaymentRequestNotification;
use Webkul\Marketplace\Http\Controllers\Shop\Controller;
use Webkul\Marketplace\Repositories\TransactionRepository;
use Webkul\User\Repositories\AdminRepository;
use Webkul\Marketplace\DataGrids\Shop\PaymentRequestDataGrid;

class PaymentRequestController extends Controller
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
     * @var mixed
     */
    protected $sellerRepository;

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
     * AdminRepository object
     *
     * @var mixed
     */
    protected $adminRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Marketplace\Repositories\SellerRepository      $sellerRepository
     * @param  Webkul\Marketplace\Repositories\OrderRepository       $orderRepository
     * @param  Webkul\Marketplace\Repositories\TransactionRepository $transactionRepository
     * @param  Webkul\User\Repositories\AdminRepository  $adminRepository
     * @return void
     */
    public function __construct(
        SellerRepository $sellerRepository,
        OrderRepository $orderRepository,
        TransactionRepository $transactionRepository,
        AdminRepository $adminRepository
    )
    {
        $this->sellerRepository = $sellerRepository;

        $this->orderRepository = $orderRepository;

        $this->adminRepository = $adminRepository;

        $this->transactionRepository = $transactionRepository;

        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isSeller = $this->sellerRepository->isSeller(auth()->guard('customer')->user()->id);

        if (! $isSeller) {
            return redirect()->route('marketplace.account.seller.create');
        }

        $seller = $this->sellerRepository->findOneByField('customer_id', auth()->guard('customer')->user()->id);

        $statistics = [
            'total_sale' =>
                    $totalSale = $this->orderRepository->scopeQuery(function($query) use($seller) {
                        return $query->where('marketplace_orders.marketplace_seller_id', $seller->id);
                })->sum('base_seller_total')
                    + $this->orderRepository->scopeQuery(function($query) use($seller) {
                        return $query->where('marketplace_orders.marketplace_seller_id', $seller->id);
                })->sum('base_commission_invoiced'),

                // $totalSale = $this->orderRepository->scopeQuery(function($query) use($seller) {
                //         return $query->where('marketplace_orders.marketplace_seller_id', $seller->id);
                // })->sum('base_seller_total')
                //  - $this->orderRepository->scopeQuery(function($query) use($seller) {
                //         return $query->where('marketplace_orders.marketplace_seller_id', $seller->id);
                // })->sum('base_grand_total_refunded') + $this->orderRepository->scopeQuery(function($query) use($seller) {
                //         return $query->where('marketplace_orders.marketplace_seller_id', $seller->id);
                // })->sum('base_commission_invoiced'),

            'total_payout' => $totalPaid = $this->transactionRepository->scopeQuery(function($query) use ($seller) {
                        return $query->where('marketplace_transactions.marketplace_seller_id', $seller->id);
                    })->sum('base_total'),

            'base_commission' => $baseCommission = $this->orderRepository->scopeQuery(function($query) use($seller) {
                                    return $query->where('marketplace_orders.marketplace_seller_id', $seller->id);
                                })->sum('base_commission_invoiced'),

            'total_refunded' => $totalRefunded = $this->orderRepository->scopeQuery(function($query) use($seller) {
                                    return $query->where('marketplace_orders.marketplace_seller_id', $seller->id);
                                })->sum('base_grand_total_refunded'),

            'remaining_payout' => $totalSale - ($totalPaid + $baseCommission),
        ];

        if (request()->ajax()) {
            return app(PaymentRequestDataGrid::class)->toJson();
        }
        

        return view($this->_config['view'], compact('statistics'));
    }

    /**
     * Update the order for payment and sends mails to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestPayment($orderId)
    {
        $orderRepository = $this->orderRepository->findOneWhere(['order_id' => $orderId]);

        if($orderRepository) {

            $orderRepository->update(['seller_payout_status' => 'requested']);

            $admin = $this->adminRepository->findOneWhere(['role_id' => 1]);

            try {
                Mail::send(new PaymentRequestNotification($orderRepository,$admin));

                session()->flash('success', 'Payment has been requested');
            } catch (\Exception $e) {
                report($e);

                session()->flash('warning', 'Something went Wrong');
            }
        }

        return redirect()->back();
    }

}
