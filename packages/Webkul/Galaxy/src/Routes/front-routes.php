<?php

use Illuminate\Support\Facades\Route;
use Webkul\Galaxy\Http\Controllers\Shop\PatientController;
use Webkul\Galaxy\Http\Controllers\Shop\TherapistController;
use Webkul\Galaxy\Http\Controllers\Shop\CustomerController;

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
    /**
     * Cart merger middleware. This middleware will take care of the items
     * which are deactivated at the time of buy now functionality. If somehow
     * user redirects without completing the checkout then this will merge
     * full cart.
     *
     * If some routes are not able to merge the cart, then place the route in this
     * group.
     */
    
    Route::group(['middleware' => ['cart.merger']], function () {
        /**
         * Authenticated routes. All the routes inside this, will be passed
         * by customer middleware.
         */

         
        Route::group(['middleware' => ['customer']], function () {
            /**
             * Customer compare products.
             */
           
        });

        Route::get('/', [CustomerController::class, 'index'])->defaults('_config', [
            'view' => 'shop::customer.login.index',
        ])->name('shop.home.index');

        Route::prefix('customer')->group(function () {
          
            /**
             * Booking routes.
             */

            Route::get('/login/test', [CustomerController::class, 'Test'])->defaults('_config', [
                'view' => 'shop::customer.login.index',
            ])->name('shop.customer.login.test');


            Route::get('/login/bankid', [CustomerController::class, 'bankid'])->defaults('_config', [
                'view' => 'shop::customer.login.index',
            ])->name('shop.customer.login.bankid');
    
            Route::get('/clinic/therapist-services', [CustomerController::class, 'services'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.services',
            ])->name('shop.customer.clinic.therapist.services');

            Route::post('/clinic/therapist-services', [CustomerController::class, 'clinics'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.services',
            ])->name('shop.customer.clinic.therapist.clinics');

            Route::post('/clinic/therapist-data', [CustomerController::class, 'therapists'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.services',
            ])->name('shop.customer.clinic.therapist.therapist');

            Route::post('/clinic/proceed-slot', [CustomerController::class, 'proceedSlot'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.services',
            ])->name('shop.customer.clinic.therapist.proceedSlot');

            Route::post('/clinic/check-slot', [CustomerController::class, 'checkSlot'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.services',
            ])->name('shop.customer.clinic.therapist.check-slot');
    
            Route::get('/clinic/therapist-slots', [CustomerController::class, 'slots'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.slots',
            ])->name('shop.customer.clinic.therapist.slots');
    
            Route::get('/clinic/therapist-message', [CustomerController::class, 'message'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.message',
            ])->name('shop.customer.clinic.therapist.message');

            Route::get('/clinic/therapist-payment', [CustomerController::class, 'payment'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.payment',
            ])->name('shop.customer.clinic.therapist.payment');

            Route::post('/clinic/coupon', [CustomerController::class, 'applyCoupon'])->name('shop.customer.clinic.therapist.coupon.apply');
    


            Route::get('/clinic/therapist-company', [CustomerController::class, 'company'])->defaults('_config', [
                'view' => 'shop::customer.clinic.therapist.company',
            ])->name('shop.customer.clinic.therapist.company');

            Route::post('/clinic/place-order', [CustomerController::class, 'placeOrder'])->name('shop.customer.clinic.therapist.place.order');

        });


        
    });

    Route::prefix('therapist')->group(function () {

        Route::get('/login', function () {
            return redirect('/customer/social-login/azure');
        })->name('shop.therapist.login.index');
            
        Route::get('/dashboard', [TherapistController::class, 'view'])->defaults('_config', [
            'view' => 'shop::therapist.view.dashboard',
        ])->name('shop.therapist.view.dashboard');
            
        Route::get('/patient/{id}', [PatientController::class, 'view'])->defaults('_config', [
            'view' => 'shop::therapist.patient.index',
        ])->name('shop.therapist.patient.index');
            
        Route::post('/signin', [TherapistController::class, 'verify'])->defaults('_config', [
            ])->name('shop.therapist.signin.verify');
    });
});

            
    
            
