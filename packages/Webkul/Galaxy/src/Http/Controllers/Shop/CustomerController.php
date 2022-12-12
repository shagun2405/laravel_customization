<?php

namespace Webkul\Galaxy\Http\Controllers\Shop;

use Webkul\Checkout\Facades\Cart;
use Webkul\Checkout\Traits\CartTools;
use Webkul\Product\Models\ProductFlat;
use Webkul\Checkout\Cart as CartFunction;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Core\Repositories\ChannelRepository;
use Webkul\GalaxyClinic\Models\TherepistsSlots;
use Webkul\Checkout\Repositories\CartRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Checkout\Repositories\CartItemRepository;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\BookingProduct\Repositories\BookingRepository;
use Webkul\CatalogRule\Repositories\CatalogRuleRepository;
use Webkul\Marketplace\Repositories\OrderRepository as MarketplaceOrderRepository;
use Webkul\GalaxyClinic\Repositories\ProductRepository as GalaxyClinicProductRepository;
use 
Webkul\GalaxyClinic\Repositories\BookingServiceRepository;
use DB;

class CustomerController extends Controller
{
    use CartTools;
     /**
     * Contains route related configuration.
     *
     * @var array
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        
        protected SellerRepository $seller_repository,
        protected CustomerRepository $customerRepository,
        protected BookingServiceRepository $bookingServiceRepository,
        protected GalaxyClinicProductRepository $galaxyClinicProductRepository,
        protected CatalogRuleRepository $catalogRuleRepository,
        protected CartRepository $cartRepository,
        protected CartItemRepository $cartItemRepository,
        protected OrderRepository $orderRepository,
        protected ProductRepository $productRepository,
        protected ChannelRepository $channelRepository,
        protected BookingRepository $bookingRepository,
        protected MarketplaceOrderRepository $MarketplaceOrderRepository,
        protected CartFunction $cartFunction,
    )
    {
        $this->_config = request('_config');
    }

    /**
     * Display the index Page Customer Login.
     */
    public function index()
    {
        $qrImage = $this->getQrCode();

        return view($this->_config['view'], compact('qrImage'));
    }

     /**
     * Verify Auth and get Qr for Customer Login Page.
     */
    public function getQrCode() {

        $post = [
            'apiUser' => 'testcompany',
            'password' => 'cd12a89b-7643-4e22-ae5b-ed0ca67402ec',
            'companyApiGuid' => '45da2190-62cf-4315-9056-3962ea7cac2d',
            'personalNumber' => '',
            'endUserIp' => '127.46.85.139',
        ];
        
        $ch = curl_init('http://banksign-test.azurewebsites.net/api/auth');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);

        $qrImage = $this->generateQrImage($response);

        return $qrImage;
    }

     /**
     * Get Qr Image for Customer Login Page.
     */
    public function generateQrImage($response) {
        $responseData = json_decode($response, true);
        if(isset($responseData['authResponse']) && isset($responseData['authResponse']['Success'])) {
            if(isset($responseData['apiCallResponse']) && isset($responseData['apiCallResponse']['Success'])) {
                if(isset($responseData['apiCallResponse']['Response']['OrderRef']) && isset($responseData['apiCallResponse']['Response']['AutoStartToken'])) {
                    $orderRef = $responseData['apiCallResponse']['Response']['OrderRef'];
                }
            }
        }

        if(isset($orderRef)) {
            session()->put('orderRef', $orderRef);
        } else {
            session()->put('orderRef', '');
        }
    
        $qrpost = [
            'apiUser' => 'testcompany',
            'password' => 'cd12a89b-7643-4e22-ae5b-ed0ca67402ec',
            'companyApiGuid' => '45da2190-62cf-4315-9056-3962ea7cac2d',
            'orderRef' =>  session()->get('orderRef'),
        ];
        
        $ch = curl_init('http://banksign-test.azurewebsites.net/api/collectqr');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $qrpost);
        $qrresponse = curl_exec($ch);
        curl_close($ch);

        $qrresponseData = json_decode($qrresponse, true);
        $qrImage = $qrresponseData['apiCallResponse']['qrImage'];

        return $qrImage;
    }

    /**
     * Display the listing of the services.
     */
    public function services()
    {
        $services = $this->bookingServiceRepository->select('product_id')->where('is_service','1')->get()->toArray();

        if(isset($services)) {
            foreach($services as $key => $product_id)
            {
                $product_name = ProductFlat::select('name')->where('product_id',$product_id['product_id'])->get()->toArray();
             
                $service_data[$product_id['product_id']] = $product_name[0]['name'];
            }
        }
       
        return view($this->_config['view'], compact('service_data'));
    }

     /**
     * Microsoft Azure Api.
     */
    public function bankid(Request $request) {
        // set post fields
        $qrpost = [
            'apiUser'        => 'testcompany',
            'password'       => 'cd12a89b-7643-4e22-ae5b-ed0ca67402ec',
            'companyApiGuid' => '45da2190-62cf-4315-9056-3962ea7cac2d',
            'orderRef'       => session()->get('orderRef'),
        ];
        
        $ch = curl_init('http://banksign-test.azurewebsites.net/api/collectstatus');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $qrpost);
        
        // execute!
        curl_exec($ch);

        // echo '<pre>';
        // print_r('hereinside');
        // echo '</pre>';
        // die();
        
        // close the connection, release resources used
        curl_close($ch);
    }

    /**
     * Display the listing of the sellers.
     */
    public function clinics() {
        $service_id = request()->all();
        $serviceID = $service_id["servicesId"];

        $sellerProduct = $this->galaxyClinicProductRepository->select('marketplace_seller_id')->where('product_id',$serviceID)->get()->toArray();

        if(isset($sellerProduct)) {
            foreach($sellerProduct as $key => $seller_value) {
                $customerID = $this->seller_repository->select('customer_id')->where('id',$seller_value["marketplace_seller_id"])->get()->toArray();
                $clinic_name = $this->customerRepository->findOrFail($customerID[0]["customer_id"]);
                $seller_data[$seller_value["marketplace_seller_id"]]["name"] = $clinic_name->first_name .$clinic_name->last_name;
            }
        }

       return response()->json($seller_data);     
    }


    /**
     * Display the listing of the therapists.
     */
    public function therapists() {
        $clinic_id = request()->all();
        $clinicId = $clinic_id["sellerId"];
        $therapist =  TherepistsSlots::select('therapists_id')->where('clinic_id',$clinicId)->get()->toArray();

        if(isset($therapist)) {
            foreach($therapist as $key => $therapist_value) {
                $therapist_name = $this->customerRepository->findOrFail($therapist_value["therapists_id"]);

                $therapist_data[$therapist_value["therapists_id"]]["name"] = $therapist_name->first_name .$therapist_name->last_name;

                $therapist_data[$therapist_value["therapists_id"]]["image"] = url('storage'. '/' . $therapist_name->profile_image);
            }
        }
        return response()->json($therapist_data);
    }

    /**
     * Put Selected data in session.
     */
    public function proceedSlot() {
        $request = request()->all();
        $customerData['service_id']   = $request["formData"]["service_id"];
        $customerData['clinic_id']    = $request["formData"]["clinic_id"];
        $customerData['therapist_id'] = $request["formData"]["therapist_id"];
        session()->put('bookingService', $customerData);
    }

    /**
     * Get therapists Available Slots
     */
    public function slots()
    {
        $bookingServiceData = session()->all();

        $bookingService = $bookingServiceData["bookingService"];
        $service_id   = $bookingService["service_id"];
        $clinic_id    = $bookingService["clinic_id"];
        $therapist_id = $bookingService["therapist_id"];

        $week_days_array = $this->week_days_array();
        $get_dates = $this->get_dates();

        $booking_details =  TherepistsSlots::select('services','slots')->where([
            ['clinic_id',$clinic_id],
            ['therapists_id' , $therapist_id]
        ])->get()->toArray();
        
        if(isset($booking_details)) {
            $services = $booking_details[0]["services"];
            $services = explode(",",$services);
            if(in_array($service_id,$services)) {
                $slots = json_decode($booking_details[0]["slots"]);

                if(!empty($slots)) {
                    foreach($slots as $week_days => $slots_values) {
                        $slots_data[$week_days_array[$week_days]]["dates"] =
                        $get_dates[$week_days];

                        if(!empty($slots_values)) {
                            $slots_data[$week_days_array[$week_days]]["slots"]["from"] = $slots_values[0]->from;

                            $slots_data[$week_days_array[$week_days]]["slots"]["to"] = $slots_values[0]->to;
                        } else {
                            $slots_data[$week_days_array[$week_days]]["slots"] = "Not Available";
                        }
                    }
                }else {
                    $slots_data = [];
                }
            }else {
                session()->flash('error', trans('galaxy::app.customer.clinic.therapist.no-slot-available'));
                
                // dd(session()->all());
                return redirect()->back();
            }
        }    
        return view($this->_config['view'],compact('slots_data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function message()
    {
        return view($this->_config['view']);
    }

    /**
     * On the basis of Selection Creating
     * Updating CartRepository For Payment
     */
    public function payment()
    {
        $session = session()->all();
        $cart_id = $session["cart"]->id;
        $payment["method"] = "cashondelivery";
        $bookingServiceSlots = session()->all();
        $bookingService = $bookingServiceSlots["bookingServiceSlots"]["slots"]; 
        $service_id = $bookingServiceSlots["bookingService"]["service_id"];

        $product_price = ProductFlat::select('price')->where('product_id',$service_id)->get()->toArray();
        $product_price = $product_price[0]["price"];
        $discounted_price = $this->checkCompanyPrice($product_price);
     
        if($discounted_price > $product_price) {
            $left_price = $discounted_price - $product_price;
        } else {
            $left_price = $product_price - $discounted_price;
        }
        
        $price["product_price"] = round($product_price,2);
        $price["company_price"] = round($discounted_price,2);
        $price["left_price"]    = round($left_price,2);

        $cartData = array(
            'grand_total'           => $price["product_price"],
            'base_grand_total'      => $price["product_price"],
            'sub_total'             => $price["product_price"],
            'base_sub_total'        => $price["product_price"],
            'discount_amount'       => $price["company_price"],
            'base_discount_amount'  => $price["company_price"],
        );
        
        $cart = $this->cartRepository->find($cart_id);
        $update = $cart->update($cartData);

        return view($this->_config['view'],compact('bookingService' , 'price','payment'));
    }

    /**
     * Display a listing of the resource.
     */
    public function company()
    {
        return view($this->_config['view']);
    }

     /**
     * Arrange week days on the 
     * basis of Current day
     */
    public function get_dates() {
        $today = time();
        $wday = date('w', $today);   
        $date[] = date('d F', $today - ($wday - 1)*86400);
        $date[] = date('d F', $today - ($wday - 2)*86400);
        $date[] = date('d F', $today - ($wday - 3)*86400);
        $date[] = date('d F', $today - ($wday - 4)*86400);
        $date[] = date('d F', $today - ($wday - 5)*86400);
        $date[] = date('d F', $today - ($wday - 6)*86400);
        $date[] = date('d F', $today - ($wday - 7)*86400);
       
        return $date;
    }

    /**
     * Get Week Days Array Starting
     * from Monday
     */
    public function week_days_array() {
        $week_days_array[] = "Monday";
        $week_days_array[] = "Tuesday";
        $week_days_array[] = "Wednesday";
        $week_days_array[] = "Thursday";
        $week_days_array[] = "Friday";
        $week_days_array[] = "Saturday";
        $week_days_array[] = "Sunday";

        return $week_days_array;
    }

     /**
     * Check For the Valid Slot 
     * Selection
     */
    public function checkSlot() {

        $request_data = request()->all();
        $session_data = session()->all();
        $day = $request_data["day"];
        $slot = $request_data["slot"];
        $date = $request_data["date"];
        $validWeek = $this->validDays($day);

        if(!in_array($day,$validWeek)) {
            return response('error', 412);
        }  elseif($slot == "Not Available") {
            return response('error', 403);
        }else{
            $bookingService["slots"]["day"] = $day;
            $bookingService["slots"]["slot"] = $slot;
            $bookingService["slots"]["date"] = $date;
            session()->put('bookingServiceSlots', $bookingService);
        }

        $cart = $this->createCart([]);
        $this->addProduct($session_data["bookingService"]["service_id"],$cart);
    }

     /**
     * Check For the Valid Days
     */
    public function validDays($day) {

        $week_data = $this->week_days_array();
        $today = time();
        $wday = date('w', $today);
       
        foreach($week_data as $week_no => $week_value) {
            if($week_no < ($wday-1)) {
                unset($week_data[$week_no]);
            }
        }

        return $week_data;
    }

     /**
     * Check Price that Company Offered 
     * to Customer
     */
    public function checkCompanyPrice($price) {

        if(auth()->guard('customer')->user()) {
            $customer_id = auth()->guard('customer')->user()->id;
        }else {
            $customer_id = 3;
        }

        $company_data =  DB::table('company_relation')->select('company_id','discount_percentage')->where('customer_id', '3')->get()->toArray();
       
        if(!empty($company_data[0])) {
           
            $discounted_per = $company_data[0]->discount_percentage;
            $discounted_value = ($price * $discounted_per)/100;
            $discounted_price = $discounted_value;
        }else {
            $discounted_price = 0;
        }

        return $discounted_price;
    }

     /**
     * Apply Promotion On Payment
     */
    public function applyCoupon()
    {  
        $couponCode = request()->get('code');
        $left_price = request()->get('LeftPrice');

        try {
            if (strlen($couponCode)) {
                $coupon = $this->catalogRuleRepository->findOneByField('name', $couponCode);
                if ($coupon->status) {
                    $product["price"] = $left_price;
                    $discpounted_price = $this->calculate($coupon, $product);    
                  
                    if ($discpounted_price) {
                        return response()->json([
                            'success' => true,
                            'message' => trans('shop::app.checkout.total.success-coupon'),
                            'price' => round($discpounted_price,2),
                        ]);
                    }
                }
            }
           
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false,
                'message' => trans('shop::app.checkout.total.coupon-apply-issue'),
            ]);
        }
    }

     /**
     * Calculate Price after Using
     * Promotion
     */
    public function calculate($rule, $productData = null)
    {
        $price = $productData && isset($productData['price']) ? $productData['price'] : $rule->price;        

        switch ($rule->action_type) {
            case 'to_fixed':
                $price = min($rule->discount_amount, $price);
                break;

            case 'to_percent':
                $price = $price * $rule->discount_amount / 100;
                break;

            case 'by_fixed':
                $price = max(0, $price - $rule->discount_amount);
                break;

            case 'by_percent':
                $price = $price * (1 - $rule->discount_amount / 100);
                break;
        }
        return $price;
    }

    /**
     * Creating Cart
     */
    public function createCart($data) {
        $cartData = [
            'channel_id'            => core()->getCurrentChannel()->id,
            'global_currency_code'  => core()->getBaseCurrencyCode(),
            'base_currency_code'    => core()->getBaseCurrencyCode(),
            'channel_currency_code' => core()->getChannelBaseCurrencyCode(),
            'cart_currency_code'    => core()->getCurrentCurrencyCode(),
            'items_count'           => 1,
        ];
        
        /**
         * Fill in the customer data, as far as possible.
         * change the function in cart.php
         * as currently we are not able to login via qr code.
         */
        if ($this->getCurrentCustomer()->check()) {
            $cartData['customer_id'] = !empty($this->getCurrentCustomer()->user()->id) ? $this->getCurrentCustomer()->user()->id : 3;
            $cartData['is_guest'] = 0;
            $cartData['customer_first_name'] = !empty($this->getCurrentCustomer()->user()->first_name) ? $this->getCurrentCustomer()->user()->first_name : "Admin";
            $cartData['customer_last_name'] = !empty($this->getCurrentCustomer()->user()->last_name) ? $this->getCurrentCustomer()->user()->last_name : "Admin";
            $cartData['customer_email'] = !empty($this->getCurrentCustomer()->user()->email) ? $this->getCurrentCustomer()->user()->email : "test@webkul.com" ;
        } else {
            $cartData['is_guest'] = 1;
        }
       
        $cart = $this->cartRepository->create($cartData);
       
        if (! $cart) {
            session()->flash('error', __('shop::app.checkout.cart.create-error'));
            return;
        }        

        $this->putCart($cart);

        return $cart;
    }

     /**
     * Add Product to Cart
     */
    public function addProduct($productId, $data)
    {   
        $cart = $this->getCart();

        if (! $cart && ! $cart = $this->createCart($data)) {
            return ['warning' => __('shop::app.checkout.cart.item.error-add')];
        }

        $product = ProductFlat::find($productId)->toArray();

        $bookingProduct = $this->bookingServiceRepository->findOneWhere([
            'product_id' => $productId,
            'is_service' => 1
        ]);
       
        if (!$bookingProduct) {
            return ['info' => __('shop::app.checkout.cart.item.inactive-add')];
        }
        
        $cartItem = $this->cartItemRepository->create(array_merge($product, [
            'cart_id' => $cart->id,
            'weight' =>10,
        ]));

        $cart["items"] = $cartItem;

        return $this->getCart();
    }

    /**
     * Check Cart Validation
     * Will remove this function and use 
     * default function once the qr login functionality works
     */
    public function getCart(): ?\Webkul\Checkout\Contracts\Cart
    {
        $cart = null;
       
        if (!$this->getCurrentCustomer()->check()) {
            $cart = $this->cartRepository->findOneWhere([
                // 'customer_id' => $this->getCurrentCustomer()->user()->id,
                'customer_id' => 1,
                'is_active'   => 1,
            ]);
        } else if (session()->has('cart')) {
            $cart = $this->cartRepository->find(session()->get('cart')->id);
        }

        return $cart;
    }
    
    /**
     * Placing Order
     */
    public function placeOrder() {
        $session = session()->all();
        $request  = request()->all();
        $cart_id = $session["cart"]->id;
        
        $cartProduct["price"] = $request["ProductPrice"];
        $cartProduct["base_price"] = $request["ProductPrice"];
        $cartProduct["total"] = $request["ProductPrice"];
        $cartProduct["base_total"] = $request["ProductPrice"];
        $cartProduct["discount_amount"] =  $request["CompanyPrice"];
        $cartProduct["base_discount_amount"] =  $request["CompanyPrice"];
        
        $update = $this->cartItemRepository->findOneByField('cart_id', $cart_id);
        $cartItemRepo = $update->update($cartProduct);
        $cart = $this->getCart();
        
        $data = $cart->toArray();
        
        $data['payment']["method"] = "cashondelivery";
        $data['payment']["method_title"] = "";
        $data['payment']["created_at"] = date('Y-m-d H:i:s');
        $data['payment']["updated_at"] = date('Y-m-d H:i:s');

        $data["billing_address"]["address_type"] = "cart_billing";
        $data["billing_address"]["first_name"] = "Admin";
        $data["billing_address"]["last_name"] = "Admin";
        $data["billing_address"]["gender"] = "Male";
        $data["billing_address"]["company_name"] = "Test";
        $data["billing_address"]["address1"] = "44 Main street";
        $data["billing_address"]["city"] = "Boston";
        $data["billing_address"]["state"] = "AL";
        $data["billing_address"]["country"] = "US";
        $data["billing_address"]["email"] = "test@webkul.com";
        $data["billing_address"]["phone"] = "5555555555";
        $data["billing_address"]["created_at"] = date('Y-m-d H:i:s');
        $data["billing_address"]["updated_at"] = date('Y-m-d H:i:s');
 
        $cartItem[] = $this->cartItemRepository->findOneByField('cart_id', $cart_id)->toArray();

        $product = $this->productRepository->findOneByField('id',$cartItem[0]["product_id"]);

        $cartItem[0]["product"] = $product;
        $cartItem[0]["type"] = "booking";
        $cartItem[0]["additional"]["_token"] = $session["_token"];
        $cartItem[0]["additional"]["quantity"] = 1;
        $cartItem[0]["additional"]["product_id"] = $cartItem[0]["product_id"];
        $cartItem[0]["additional"]["locale"] = "en";

        $data["customer"] = $this->customerRepository->findOrFail($cart->customer_id);
        $data["channel"] = $this->channelRepository->findOrFail($cart->channel_id);
        $data["items"] =  $cartItem;
        
        $order = $this->orderRepository->create($data);

        $this->bookingRepository->create(['order' => $order]);
        $this->MarketplaceOrderRepository->create(['order' => $order]);

        Cart::deActivateCart();
        Cart::activateCartIfSessionHasDeactivatedCartId();
        session()->flash('order', $data);

        return response()->json([
            'success' => true,
            'message' => trans('galaxy::app.checkout.order-success'),
        ]);
    }

    public function getCurrentCustomer()
    {
        $guard = request()->has('token') ? 'api' : 'admin';

        return auth()->guard($guard);
    }
    
}


