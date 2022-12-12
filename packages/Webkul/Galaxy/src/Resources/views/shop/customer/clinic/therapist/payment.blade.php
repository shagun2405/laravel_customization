@extends('galaxy::layouts.master')

@section('page_title')
    {{ __('galaxy::app.customer.clinic.therapist.services') }}
@stop

@section('content')
    <payment></payment>       
@stop

@push('scripts')

    <script type="text/x-template" id="payment-template">
        <div>
            <div class="min-h-full max-w-3xl mx-auto pt-8">
                <div class="rounded-lg bg-white overflow-hidden shadow mt-10 ml-20">
                    <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
                    <div class="bg-white p-6">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-5">
                                <div class="flex-shrink-0">
                                    <img class="mx-auto h-20 w-20 rounded-full" src="https://static.bestille.no/cs2017/stjarnkliniken/Ref2/Josefine.jpg" alt="">
                                </div>

                                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                    <p class="text-md font-medium text-gray-600">Bekräfta och betala din tid,</p>
                                    <p class="text-xl font-bold text-gray-900 sm:text-2xl">hos Josefine Engström</p>
                                    <p class="text-lg font-bold text-gray-900 sm:text-lg">@{{bookingService.day}} @{{bookingService.date}}  @{{bookingService.slot.from}} - @{{bookingService.slot.to}}</p>

                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <div class="bg-white sm:rounded-lg">
                                <div class="px-0 py-5 sm:pt-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('galaxy::app.customer.clinic.therapist.have-discount-coupon')}}</h3>
                                    
                                    <div class="mt-2 max-w-xl text-md text-gray-500">
                                        <p>{{ __('galaxy::app.customer.clinic.therapist.activate-coupon')}}</p>
                                    </div>

                                    <form class="mt-5 sm:flex sm:items-center custom-form"  method="post" @submit.prevent="applyCoupon">
                                        <div class="w-full sm:max-w-xs" :class="[errorMessage ? 'has-error' : '']">
                                            <input 
                                            type="text" 
                                            name="code" 
                                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-md border-gray-300 rounded-md"
                                            v-model="couponCode" 
                                            placeholder="{{ __('shop::app.checkout.onepage.enter-coupon-code') }}">

                                            <div class="control-error">@{{ errorMessage }}</div>
                                        </div>
                                        
                                        <button type="submit" class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-green-800 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-md" :disabled="disableButton">{{ __('shop::app.checkout.onepage.apply-coupon') }}</button>
                                    </form>
                                </div>
                            </div>

                            <div class="pt-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('galaxy::app.customer.clinic.therapist.paying-for-you-now')}}</h3>
                                <dl class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-3">
                                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                        <dt class="text-md font-medium text-gray-500 truncate">{{ __('galaxy::app.customer.clinic.therapist.total-cost')}}</dt>
                                        <dd class="mt-1 text-3xl tracking-tight font-semibold text-gray-900">@{{price.product_price}} </dd>
                                    </div>

                                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                        <dt class="text-md font-medium text-gray-500 truncate">{{ __('galaxy::app.customer.clinic.therapist.employer-pays')}}</dt>
                                        <dd class="mt-1 text-3xl tracking-tight font-semibold text-gray-900">@{{price.company_price}}</dd>
                                    </div>

                                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                                        <div class="text-md font-medium text-gray-500 truncate">{{ __('galaxy::app.customer.clinic.therapist.left-to-pay')}}</div>
                                        <div class="mt-1 text-3xl tracking-tight font-semibold text-gray-900" v-html="LeftPrice"></div>
                                    </div>
                                </dl>
                            </div>
                        </div>

                    </div>

                    <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">
                        <div class="px-6 py-5 text-md font-medium text-center bg-gray-800 hover:bg-gray-700" @click="backOneStep">
                            <span class="text-white font-bold">{{ __('galaxy::app.customer.clinic.therapist.back-one-step')}}</span>
                        </div>

                        <div class="inline-flex items-center px-3 py-2 bg-green-800 hover:bg-green-700 flex" @click="placeOrder">
                            <img class="-ml-0.5 mr-2 h-12 ml-4" src="https://images.ctfassets.net/zrqoyh8r449h/7taM7P2vHzWdGUE5VIm4ou/ba9ff9d11fe33dac9a170cf7d8e2468c/Swish_Logo_Primary_Dark-BG_P3.png?w=600" />
                            <span class="ml-4 text-white font-bold">{{ __('galaxy::app.customer.clinic.therapist.pay')}} </span>
                            <span class="ml-4 text-white font-bold" v-html="LeftPrice"></span>
                            <span class="ml-4 text-white font-bold" >{{ __('galaxy::app.customer.clinic.therapist.sek-withswish')}}</span>
                        </div>
                    </div>
                </div>
            </div>     
        </div>
    </script>

    <script>
    var bookingService = @json($bookingService);
    var price = @json($price);
    Vue.component('payment', {
        template: '#payment-template',
        inject: ['$validator'],

        data: function() {
            return {
                bookingService:bookingService,
                price:price,
                couponCode: '',
                errorMessage: '',
                appliedCoupon: "",
                routeName: "{{ request()->route()->getName() }}",
                disableButton: false,
                removeIconEnabled: true,
                LeftPrice:price.left_price,
                CompanyPrice:price.company_price,
                ProductPrice:price.product_price,
            }
        },

        watch: {
            couponCode: function (value) {
                if (value != '') {
                    this.errorMessage = '';
                }
            }
        },

        methods: {
                applyCoupon: function() {
                    if (! this.couponCode.length) {
                        this.errorMessage = '{{ __('shop::app.checkout.total.invalid-coupon') }}';
                        return;
                    }

                    this.errorMessage = null;
                    let code = this.couponCode;
                    this.LeftPrice = price.left_price;
                    axios.post('{{ route('shop.customer.clinic.therapist.coupon.apply') }}', {code, LeftPrice: this.LeftPrice}
                        ).then(response => {
                            if (response.data.success) {
                                this.$emit('onApplyCoupon');
                                this.appliedCoupon = this.couponCode;
                                this.couponCode = '';
                                this.LeftPrice = response.data.price;
                                window.showAlert(
                                    'alert-success',
                                    response.data.label,
                                    response.data.message
                                 );
                            } 
                        }).catch(error => {
                            this.errorMessage = error.response.data.message;
                            this.disableButton = false;
                        });
                },

                removeCoupon: function () {
                    let self = this;
                    if (self.removeIconEnabled) {
                        self.removeIconEnabled = false;
                        axios.delete('{{ route('shop.checkout.coupon.remove.coupon') }}')
                        .then(function(response) {
                            self.$emit('onRemoveCoupon')
                            self.appliedCoupon = '';
                            self.disableButton = false;
                            self.removeIconEnabled = true;
                            window.showAlert(
                                'alert-success',
                                response.data.label,
                                response.data.message
                            );
                            self.redirectIfCartPage();
                        })
                        .catch(function(error) {
                            window.flashMessages = [{'type': 'alert-error', 'message': error.response.data.message}];
                            self.$root.addFlashMessages();
                            self.disableButton = false;
                            self.removeIconEnabled = true;
                        });
                    }
                },

                redirectIfCartPage: function() {
                    if (this.routeName != 'shop.checkout.cart.index') return;

                    setTimeout(function() {
                        window.location.reload();
                    }, 700);
                },

                placeOrder:function(){
                    axios.post('{{ route('shop.customer.clinic.therapist.place.order') }}', {CompanyPrice:this.CompanyPrice, LeftPrice: this.LeftPrice,ProductPrice:this.ProductPrice} 
                        ).then(response => {
                            if (response.data.success) {
                                window.showAlert(
                                    'alert-success',
                                    response.data.label,
                                    response.data.message
                            
                                 );
                            } 
                        }).catch(error => {
                            window.showAlert(
                                    'alert-danger',
                                    "error",
                                    "Order not placed"
                                 );
                        });
                        setTimeout(function() {
                            window.location.href ="{{ route('shop.home.index') }}";
                        }, 700);
                },

                backOneStep() {
                    window.location.href = "{{ route('shop.customer.clinic.therapist.slots')}}"
                }
        }
        
    });
    </script>

@endpush