@if(! $product->is_service?->is_service)

    @push('css')
        <style>
            .has-control-group .control-group {
                width: 50%;
                float: left;
            }

            .has-control-group .control-group:first-child {
                padding-right: 0px !important;
            }

            .has-control-group .control-group:last-child {
                padding-left: 0px !important;
            }

            .slot-list table tbody tr td .control-group label{
                    display: none;
            }

            @media only screen and (max-width: 540px){
                .slot-list table thead{
                    display: none;
                }

                .slot-list table tbody tr td{
                    display: block;
                }

                .slot-list table tbody tr td .control-group label{
                    display: block;
                }

                .table .control-group.date:after, .table .control-group.datetime:after {
                    left: 100%;
                }
            }
        </style>
    @endpush

    {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.booking.before', ['product' => $product]) !!}

    <accordian :title="'{{ __('bookingproduct::app.admin.catalog.products.booking') }}'" :active="true">
        <div slot="body">
            <booking-information></booking-information>
        </div>
    </accordian>

    {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.booking.after', ['product' => $product]) !!}

    @push('scripts')
        @php
            $bookingProduct = app('\Webkul\BookingProduct\Repositories\BookingProductRepository')->findOneByField('product_id', $product->id);
            echo "2";
            dd($bookingProduct);
        @endphp

        <script type="text/x-template" id="booking-information-template">
            <div>
                <div class="control-group" :class="[errors.has('booking[type]') ? 'has-error' : '']">
                    <label class="required">{{ __('bookingproduct::app.admin.catalog.products.booking-type') }}</label>

                    <input type="hidden" name="booking[type]" :value="booking.type"/>

                    <select v-validate="'required'" name="booking[type]" v-model="booking.type" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.booking-type') }}&quot;" :disabled="! is_new">
                        <option value="default">{{ __('bookingproduct::app.admin.catalog.products.default') }}</option>
                        <option value="appointment">{{ __('bookingproduct::app.admin.catalog.products.appointment-booking') }}</option>
                        <option value="event">{{ __('bookingproduct::app.admin.catalog.products.event-booking') }}</option>
                        <option value="rental">{{ __('bookingproduct::app.admin.catalog.products.rental-booking') }}</option>
                        <option value="table">{{ __('bookingproduct::app.admin.catalog.products.table-booking') }}</option>
                    </select>

                    <span class="control-error" v-if="errors.has('booking[type]')">@{{ errors.first('booking[type]') }}</span>
                </div>

                <div class="control-group">
                    <label>{{ __('bookingproduct::app.admin.catalog.products.location') }}</label>
                    <input type="text" name="booking[location]" v-model="booking.location" class="control"/>
                </div>

                <div class="control-group" :class="[errors.has('booking[qty]') ? 'has-error' : '']" v-if="booking.type == 'default' || booking.type == 'appointment' || booking.type == 'rental'">
                    <label class="required">{{ __('bookingproduct::app.admin.catalog.products.qty') }}</label>

                    <input type="text" v-validate="'required|numeric|min:0'" name="booking[qty]" v-model="booking.qty" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.qty') }}&quot;"/>

                    <span class="control-error" v-if="errors.has('booking[qty]')">@{{ errors.first('booking[qty]') }}</span>
                </div>

                <div class="control-group" v-if="booking.type != 'event' && booking.type != 'default'" :class="[errors.has('booking[available_every_week]') ? 'has-error' : '']">
                    <label class="required">{{ __('bookingproduct::app.admin.catalog.products.available-every-week') }}</label>

                    <select v-validate="'required'" name="booking[available_every_week]" v-model="booking.available_every_week" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.available-every-week') }}&quot;">
                        <option value="1">{{ __('bookingproduct::app.admin.catalog.products.yes') }}</option>
                        <option value="0">{{ __('bookingproduct::app.admin.catalog.products.no') }}</option>
                    </select>

                    <span class="control-error" v-if="errors.has('booking[available_every_week]')">@{{ errors.first('booking[available_every_week]') }}</span>
                </div>

                <div v-if="! parseInt(booking.available_every_week)">
                    <div class="control-group date" :class="[errors.has('booking[available_from]') ? 'has-error' : '']">
                        <label class="required">{{ __('bookingproduct::app.admin.catalog.products.available-from') }}</label>

                        <datetime>
                            <input type="text" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss|after:{{\Carbon\Carbon::yesterday()->format('Y-m-d 23:59:59')}}'" name="booking[available_from]" v-model="booking.available_from" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.available-from') }}&quot;" ref="available_from"/>
                        </datetime>

                        <span class="control-error" v-if="errors.has('booking[available_from]')">@{{ errors.first('booking[available_from]') }}</span>
                    </div>

                    <div class="control-group date" :class="[errors.has('booking[available_to]') ? 'has-error' : '']">
                        <label class="required">{{ __('bookingproduct::app.admin.catalog.products.available-to') }}</label>

                        <datetime>
                            <input type="text" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss|after:available_from'" name="booking[available_to]" v-model="booking.available_to" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.available-to') }}&quot;" ref="available_to"/>
                        </datetime>

                        <span class="control-error" v-if="errors.has('booking[available_to]')">@{{ errors.first('booking[available_to]') }}</span>
                    </div>
                </div>

                <div class="default-booking-section" v-if="booking.type == 'default'">
                    @include ('bookingproduct::admin.catalog.products.accordians.booking.default', ['bookingProduct' => $bookingProduct])
                </div>

                <div class="appointment-booking-section" v-if="booking.type == 'appointment'">
                    @include ('bookingproduct::admin.catalog.products.accordians.booking.appointment', ['bookingProduct' => $bookingProduct])
                </div>

                <div class="event-booking-section" v-if="booking.type == 'event'">
                    @include ('bookingproduct::admin.catalog.products.accordians.booking.event', ['bookingProduct' => $bookingProduct])
                </div>

                <div class="rental-booking-section" v-if="booking.type == 'rental'">
                    @include ('bookingproduct::admin.catalog.products.accordians.booking.rental', ['bookingProduct' => $bookingProduct])
                </div>

                <div class="table-booking-section" v-if="booking.type == 'table'">
                    @include ('bookingproduct::admin.catalog.products.accordians.booking.table', ['bookingProduct' => $bookingProduct])
                </div>
            </div>
        </script>

        <script>
            let bookingProduct = @json($bookingProduct);

            Vue.component('booking-information', {
                template: '#booking-information-template',

                inject: ['$validator'],

                data: function() {
                    return {
                        is_new: bookingProduct ? false : true,

                        booking: bookingProduct ? bookingProduct : {

                            type: 'default',

                            location: '',

                            qty: 0,

                            available_every_week: '',

                            available_from: '',

                            available_to: ''
                        }
                    }
                },

                created: function() {
                    this.booking.available_from = "{{ $bookingProduct && $bookingProduct->available_from ? $bookingProduct->available_from->format('Y-m-d H:i:s') : '' }}";

                    this.booking.available_to = "{{ $bookingProduct && $bookingProduct->available_to ? $bookingProduct->available_to->format('Y-m-d H:i:s') : '' }}";
                }
            });
        </script>

        @include ('bookingproduct::admin.catalog.products.accordians.booking.slots')
    @endpush

@endif

@if($product->is_service?->is_service)

@push('css')
    <style>
        .has-control-group .control-group {
            width: 50%;
            float: left;
        }

        .has-control-group .control-group:first-child {
            padding-right: 0px !important;
        }

        .has-control-group .control-group:last-child {
            padding-left: 0px !important;
        }

        .slot-list table tbody tr td .control-group label{
                display: none;
         }

        @media only screen and (max-width: 540px){
            .slot-list table thead{
                display: none;
            }

            .slot-list table tbody tr td{
                display: block;
            }

            .slot-list table tbody tr td .control-group label{
                display: block;
            }

            .table .control-group.date:after, .table .control-group.datetime:after {
                left: 100%;
            }
        }
    </style>
@endpush

{!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.booking.before', ['product' => $product]) !!}

<accordian :title="'{{ __('bookingproduct::app.admin.catalog.products.booking') }}'" :active="true">
    <div slot="body">
        
        <booking-information></booking-information>
    </div>
</accordian>

{!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.booking.after', ['product' => $product]) !!}

@push('scripts')
    @php
        $bookingProduct = app('\Webkul\BookingProduct\Repositories\BookingProductRepository')->findOneByField('product_id', $product->id)
    @endphp

    <script type="text/x-template" id="booking-information-template">
        <div>
            <div class="control-group" :class="[errors.has('seller_ids[]') ? 'has-error' : '']">
                <label for="seller_ids">{{ __('galaxyclinic::app.catalog.services.select-clinics') }}</label>
                <select class="control" id="seller_ids" name="seller_ids[]" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.services.select-clinics') }}&quot;" multiple>
                    @foreach (app('Webkul\Marketplace\Repositories\SellerRepository')->findWhere(['is_approved' => 1]) as $seller)
                        <option value="{{ $seller->id }}" {{ array_keys(array_column($sellerProduct, 'marketplace_seller_id'), $seller->id) ? 'selected' : '' }}>
                            {{ $seller->customer->first_name . ' ' . $seller->customer->last_name }}
                        </option>
                    @endforeach
                </select>
                <span class="control-error" v-if="errors.has('seller_ids[]')">@{{ errors.first('seller_ids[]') }}</span>
            </div>
            <div class="control-group" :class="[errors.has('booking[type]') ? 'has-error' : '']">
                <label class="required">{{ __('bookingproduct::app.admin.catalog.products.booking-type') }}</label>

                <input type="hidden" name="booking[type]" :value="booking.type"/>

                <select v-validate="'required'" name="booking[type]" v-model="booking.type" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.booking-type') }}&quot;" :disabled="! is_new">
                    <option value="appointment">{{ __('bookingproduct::app.admin.catalog.products.appointment-booking') }}</option>
                </select>

                <span class="control-error" v-if="errors.has('booking[type]')">@{{ errors.first('booking[type]') }}</span>
            </div>

            <div class="control-group">
                <label>{{ __('bookingproduct::app.admin.catalog.products.location') }}</label>
                <input type="text" name="booking[location]" v-model="booking.location" class="control"/>
            </div>

            <div class="control-group" :class="[errors.has('booking[qty]') ? 'has-error' : '']" v-if="booking.type == 'default' || booking.type == 'appointment' || booking.type == 'rental'">
                <label class="required">{{ __('bookingproduct::app.admin.catalog.products.qty') }}</label>

                <input type="text" v-validate="'required|numeric|min:0'" name="booking[qty]" v-model="booking.qty" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.qty') }}&quot;"/>

                <span class="control-error" v-if="errors.has('booking[qty]')">@{{ errors.first('booking[qty]') }}</span>
            </div>

            <!-- <div class="control-group" v-if="booking.type != 'event' && booking.type != 'default'" :class="[errors.has('booking[available_every_week]') ? 'has-error' : '']">
                <label class="required">{{ __('bookingproduct::app.admin.catalog.products.available-every-week') }}</label>

                <select v-validate="'required'" name="booking[available_every_week]" v-model="booking.available_every_week" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.available-every-week') }}&quot;">
                    <option value="1">{{ __('bookingproduct::app.admin.catalog.products.yes') }}</option>
                    <option value="0">{{ __('bookingproduct::app.admin.catalog.products.no') }}</option>
                </select>

                <span class="control-error" v-if="errors.has('booking[available_every_week]')">@{{ errors.first('booking[available_every_week]') }}</span>
            </div> -->

            <!-- <div v-if="! parseInt(booking.available_every_week)">
                <div class="control-group date" :class="[errors.has('booking[available_from]') ? 'has-error' : '']">
                    <label class="required">{{ __('bookingproduct::app.admin.catalog.products.available-from') }}</label>

                    <datetime>
                        <input type="text" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss|after:{{\Carbon\Carbon::yesterday()->format('Y-m-d 23:59:59')}}'" name="booking[available_from]" v-model="booking.available_from" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.available-from') }}&quot;" ref="available_from"/>
                    </datetime>

                    <span class="control-error" v-if="errors.has('booking[available_from]')">@{{ errors.first('booking[available_from]') }}</span>
                </div>

                <div class="control-group date" :class="[errors.has('booking[available_to]') ? 'has-error' : '']">
                    <label class="required">{{ __('bookingproduct::app.admin.catalog.products.available-to') }}</label>

                    <datetime>
                        <input type="text" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss|after:available_from'" name="booking[available_to]" v-model="booking.available_to" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.available-to') }}&quot;" ref="available_to"/>
                    </datetime>

                    <span class="control-error" v-if="errors.has('booking[available_to]')">@{{ errors.first('booking[available_to]') }}</span>
                </div>
            </div>

            <div class="appointment-booking-section" v-if="booking.type == 'appointment'">
                @include ('bookingproduct::admin.catalog.products.accordians.booking.appointment', ['bookingProduct' => $bookingProduct])
            </div> -->

            <div class="control-group">
                <label>Available Therapists at Selected Clinics: </label>
                @if(isset($clinic_data))
                    @foreach($clinic_data as $clinic_name => $clinic_values)
                        <h3>Clinic  : {{$clinic_name }}</h3> 
                        @foreach($clinic_values as $therapist_id => $therapist_data)
                                <h5> Therapist : {{$therapist_data['name']}}</h5> 
                                
                                @foreach($therapist_data["slots"] as $day => $time)
                                    @if(!empty($time))
                                        <h6> {{$week_days_array[$day]}} : 
                                            @foreach($time as $key => $value)
                                             From : {{$value->from}} & To : {{$value->to}}, &nbsp;
                                            @endforeach
                                        </h6>
                                    @endif
                                @endforeach
                            
                        @endforeach
                    @endforeach
                @endif
               
            </div>
            
        </div>
    </script>

    <script>
        let bookingProduct = @json($bookingProduct);

        Vue.component('booking-information', {
            template: '#booking-information-template',

            inject: ['$validator'],

            data: function() {
                return {
                    is_new: bookingProduct ? false : true,

                    booking: bookingProduct ? bookingProduct : {

                        type: 'default',

                        location: '',

                        qty: 0,

                        available_every_week: '',

                        available_from: '',

                        available_to: ''
                    }
                }
            },

            created: function() {
                this.booking.available_from = "{{ $bookingProduct && $bookingProduct->available_from ? $bookingProduct->available_from->format('Y-m-d H:i:s') : '' }}";

                this.booking.available_to = "{{ $bookingProduct && $bookingProduct->available_to ? $bookingProduct->available_to->format('Y-m-d H:i:s') : '' }}";
            }
        });
    </script>

    @include ('bookingproduct::admin.catalog.products.accordians.booking.slots')
@endpush

@endif