<?php

namespace Webkul\GalaxyClinic\Http\Controllers\Admin;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Webkul\GalaxyClinic\DataGrids\Admin\AdminDataGrids\CompanyDataGrids;
use Webkul\Admin\DataGrids\CustomerOrderDataGrid;
use Webkul\Admin\DataGrids\CustomersInvoicesDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Mail\NewCustomerNotification;
use Webkul\Customer\Repositories\CustomerGroupRepository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Marketplace\Repositories\SellerRepository;
use Illuminate\Http\Request;
use Webkul\GalaxyClinic\Models\TherepistsSlots;
use DB;

/**
 * Company controller
 *
 * @author    Aqib Zaman Khan <aqibzaman.khan651@webkul.in>
 * @copyright 2022 Webkul Software Pvt Ltd (http://www.webkul.com)
*/
class CompanyController extends Controller
{
     /**
     * Contains route related configuration.
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @param \Webkul\Marketplace\Repositories\SellerRepository  $SellerRepository
     * @param \Webkul\Customer\Repositories\CustomerGroupRepository  $customerGroupRepository
     */
    public function __construct(
        protected CustomerRepository $customerRepository,
        protected SellerRepository $SellerRepository,
        protected CustomerGroupRepository $customerGroupRepository
    )
    {
        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(CompanyDataGrids::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        $groups = $this->customerGroupRepository->findWhere([['code', '<>', 'guest']]);

        $customers = $this->customerRepository->findWhere(['is_verified' => 1, 'default_clinic_id' => 0])->where('customer_group_id' , '!=' , core()->getConfigData('galaxyclinic.settings.general.default_company_group'))->toArray();
       
        $only_customers = array();
        foreach($customers as $customer) {
            if(!$this->SellerRepository->isSeller(($customer['id']))) {
                $only_customers[] =  $customer;
            }
            
        }

        return view($this->_config['view'], compact('groups', 'only_customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
        $password = rand(100000, 10000000);

        Event::dispatch('customer.registration.before');

        $customer = $this->customerRepository->create(array_merge(request()->all() , [
            'password'    => bcrypt($password),
            'is_verified' => 1,
        ]));

        Event::dispatch('customer.registration.after', $customer);

        try {
            $configKey = 'emails.general.notifications.emails.general.notifications.customer';

            if (core()->getConfigData($configKey)) {
                Mail::queue(new NewCustomerNotification($customer, $password));
            }
        } catch (\Exception $e) {
            report($e);
        }

        $data = request()->all();

        $customerIds = isset($data['customer_ids']) ? $data['customer_ids'] : [];

        $discount_percentage = isset($data['discount_percentage']) ? $data['discount_percentage'] : 0;

        if(! empty($customerIds)) {
            foreach($customerIds as $customerId) {
                DB::table('company_relation')->insert(['company_id' => $customer->id, 'customer_id' => $customerId, 'discount_percentage' => $discount_percentage]);
            }
        } 

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Customer']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $customer = $this->customerRepository->findOrFail($id);

        $customers = $this->customerRepository->findWhere(['is_verified' => 1, 'default_clinic_id' => 0])->where('customer_group_id' , '!=' , core()->getConfigData('galaxyclinic.settings.general.default_company_group'))->toArray();
       
        $only_customers = array();
        foreach($customers as $customerr) {
            if(!$this->SellerRepository->isSeller(($customerr['id']))) {
                $only_customers[] =  $customerr;
            }
            
        }

        $assigned_cutomers = DB::table('company_relation')->where('company_id', $id)->get()->toArray();

        $assigned_cutomers = json_decode(json_encode($assigned_cutomers), true);

        $assigned_cutomers_ids = array();

        foreach($assigned_cutomers as $assigned_cutomer) {
            $discount_percentage = $assigned_cutomer['discount_percentage'];
            $assigned_cutomers_ids[] = $assigned_cutomer['customer_id'];
        }

        $groups = $this->customerGroupRepository->findWhere([['code', '<>', 'guest']]);

        return view($this->_config['view'], compact('customer', 'groups', 'only_customers', 'assigned_cutomers', 'assigned_cutomers_ids', 'discount_percentage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        Event::dispatch('customer.update.before', $id);
        
        $customer = $this->customerRepository->update(array_merge(request()->all(), [
            'status'       => 1,
            'is_suspended' => request()->has('is_suspended'),
        ]), $id);

        $data = request()->all();

        $customerIds = isset($data['customer_ids']) ? $data['customer_ids'] : [];

        $discount_percentage = isset($data['discount_percentage']) ? $data['discount_percentage'] : 0;

        if(! empty($customerIds)) {
            DB::table('company_relation')->where('company_id', $id)->delete();
            foreach($customerIds as $customerId) {
                DB::table('company_relation')->insert(['company_id' => $customer->id, 'customer_id' => $customerId, 'discount_percentage' => $discount_percentage]);
            }
        } 

        Event::dispatch('customer.update.after', $customer);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Customer']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = $this->customerRepository->findorFail($id);

        try {
            if (! $this->customerRepository->checkIfCustomerHasOrderPendingOrProcessing($customer)) {
                $this->customerRepository->delete($id);

                return response()->json(['message' => trans('admin::app.response.delete-success', ['name' => 'Customer'])]);
            }

            return response()->json(['message' => trans('admin::app.response.order-pending', ['name' => 'Customer'])], 400);
        } catch (\Exception $e) {}

        return response()->json(['message' => trans('admin::app.response.delete-failed', ['name' => 'Customer'])], 400);
    }

    /**
     * To load the note taking screen for the customers.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function createNote($id)
    {
        $customer = $this->customerRepository->find($id);

        return view($this->_config['view'])->with('customer', $customer);
    }

    /**
     * To store the response of the note in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeNote()
    {
        $this->validate(request(), [
            'notes' => 'string|nullable',
        ]);

        Event::dispatch('customer.update.before', request()->input('_customer'));

        $customer = $this->customerRepository->update([
            'notes' => request()->input('notes'),
        ], request()->input('_customer'));

        Event::dispatch('customer.update.after', $customer);

        session()->flash('success', 'Note taken');

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * To mass update the customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function massUpdate()
    {
        $customerIds = explode(',', request()->input('indexes'));

        $updateOption = request()->input('update-options');

        foreach ($customerIds as $customerId) {
            Event::dispatch('customer.update.before', $customerId);

            $customer = $this->customerRepository->update([
                'status' => $updateOption,
            ], $customerId);

            Event::dispatch('customer.update.after', $customer);
        }

        session()->flash('success', trans('admin::app.customers.customers.mass-update-success'));

        return redirect()->back();
    }

    /**
     * To mass delete the customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        $customerIds = explode(',', request()->input('indexes'));

        if (! $this->customerRepository->checkBulkCustomerIfTheyHaveOrderPendingOrProcessing($customerIds)) {
            foreach ($customerIds as $customerId) {
                Event::dispatch('customer.delete.before', $customerId);
                
                $this->customerRepository->delete($customerId);

                Event::dispatch('customer.delete.after', $customerId);
            }

            session()->flash('success', trans('admin::app.customers.customers.mass-destroy-success'));

            return redirect()->back();
        }

        session()->flash('error', trans('admin::app.response.order-pending', ['name' => 'Customers']));

        return redirect()->back();
    }

    /**
     * Retrieve all invoices from customer.
     *
     * @param  int  $id
     * @return \Webkul\Admin\DataGrids\CustomersInvoicesDataGrid
     */
    public function invoices($id)
    {
        if (request()->ajax()) {
            return app(CustomersInvoicesDataGrid::class)->toJson();
        }
    }

    /**
     * Retrieve all orders from customer.
     *
     * @param  int  $id
     * @return \Webkul\Admin\DataGrids\CustomerOrderDataGrid
     */
    public function orders($id)
    {
        if (request()->ajax()) {
            return app(CustomerOrderDataGrid::class)->toJson();
        }

        $customer = $this->customerRepository->find(request('id'));

        return view($this->_config['view'], compact('customer'));
    }

    /**
     * Show the form for adding the clinics.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function clinics($id)
    {
        $therapists_id = $id;
        $checkTherapistsExist = TherepistsSlots::where('therapists_id' , $therapists_id)->count();
        
        if($checkTherapistsExist <= 0) {
            return view($this->_config['view'], compact('therapists_id'));
        } else {
            $TherapistsSlotsDetails = TherepistsSlots::where('therapists_id' , $therapists_id)->get();
            return view('galaxyclinic::admin.catalog.therapists.edit_therapists_slots', compact('therapists_id', 'TherapistsSlotsDetails'));
        }
        
    }

    /**
     * Add Therepists Slots to clinic.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTherapistsSlots(Request $request, $id)
    {
        $datas = array();
        $all_slots = request()->all();
        
        if(isset($all_slots['booking'])) {
            foreach($all_slots['booking'] as $key => $slot) {
                $data['therapists_id'] = $id;
                $data['clinic_id'] = $key;
                $data['duration'] = $slot['duration'];
                $data['break_time'] = $slot['break_time'];
                $data['slots'] = json_encode($this->formatSlots($slot));
                $datas[] = $data;
            }
        }
        
        if($datas) {
            
            TherepistsSlots::insert($datas);

            session()->flash('success', trans('galaxyclinic::app.catalog.therapists.therapists-slot-success'));

            return redirect()->back();
        }  
    }

    /**
     * Update Therepists Slots to clinic.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTherapistsSlots(Request $request, $id)
    {
        $datas = array();
        $all_slots = request()->all();
        
        if(isset($all_slots['booking'])) {
            foreach($all_slots['booking'] as $key => $slot) {
                $data['therapists_id'] = $id;
                $data['clinic_id'] = $key;
                $data['duration'] = $slot['duration'];
                $data['break_time'] = $slot['break_time'];
                $data['slots'] = json_encode($this->formatSlots($slot));

                TherepistsSlots::where('therapists_id', $id)->where('clinic_id', $key)->update($data);
            }
        }
        
        session()->flash('success', trans('galaxyclinic::app.catalog.therapists.therapists-slot-updated-success'));

        return redirect()->back();
    }

    public function formatSlots($data)
    {
        for ($i = 0; $i < 7; $i++) {
            if (! isset($data['slots'][$i])) {
                $data['slots'][$i] = [];
            } else {
                $count = 0;

                $slots = [];

                foreach ($data['slots'][$i] as $slot) {
                    $slots[] = array_merge($slot, ['id' => $i . '_slot_' . $count]);
                    
                    $count++;
                }

                $data['slots'][$i] = $slots;
            }
        }

        ksort($data['slots']);

        return $data['slots'];
    }

}