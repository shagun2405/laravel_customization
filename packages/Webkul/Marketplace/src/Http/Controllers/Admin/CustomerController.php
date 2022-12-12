<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Marketplace\Repositories\SellerRepository;
use Illuminate\Support\Facades\Event;
use Webkul\Admin\Mail\NewCustomerNotification;
use Mail;

/**
 * Customer controlller
 *
 * @author    Rahul Shukla <rahulshukla.symfony517@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class CustomerController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CustomerRepository object
     *
     * @var array
     */
    protected $customerRepository;

     /**
     * SellerRepository object
     *
     * @var array
     */
    protected $sellerRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @param \Webkul\Marketplace\Repositories\SellerRepository $sellerRepository
     */
    public function __construct(
        CustomerRepository $customerRepository,
        SellerRepository $sellerRepository
    )
    {
        $this->_config = request('_config');

        $this->middleware('admin');

        $this->customerRepository = $customerRepository;

        $this->sellerRepository = $sellerRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'first_name'    => 'string|required',
            'last_name'     => 'string|required',
            'gender'        => 'required',
            'email'         => 'required|unique:customers,email',
            'date_of_birth' => 'date|before:today',
        ]);

        $data = request()->all();

        $password = rand(100000, 10000000);

        $data['password'] = bcrypt($password);

        $data['is_verified'] = 1;

        Event::dispatch('customer.registration.before');

        $customer = $this->customerRepository->create($data);

        Event::dispatch('customer.registration.after', $customer);

        try {
            $configKey = 'emails.general.notifications.emails.general.notifications.customer';
            if (core()->getConfigData($configKey)) {
                Mail::queue(new NewCustomerNotification($customer, $password));
            }
        } catch (\Exception $e) {
            report($e);
        }

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Seller']));

        return redirect()->route($this->_config['redirect']);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->all();

        $this->validate(request(), [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'gender' => 'required',
            'email' => 'required|unique:customers,email,'. $id,
            'date_of_birth' => 'date|before:today'
        ]);

        $this->customerRepository->update(request()->all(), $id);

        $seller = app('Webkul\Marketplace\Repositories\SellerRepository')->findOneWhere([
            'customer_id' => $id
        ]);

        if ($seller) {
            if (isset($data['commission_enable'])) {
                $sellerData['commission_enable']     = $data['commission_enable'];
                $sellerData['commission_percentage'] = $data['commission_percentage'];
            } else {
                $sellerData['commission_enable']     = 0;
                $sellerData['commission_percentage'] = 0;
            }

            $this->sellerRepository->update($sellerData, $seller->id);
        }

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Customer']));

        return redirect()->route($this->_config['redirect']);
    }
}