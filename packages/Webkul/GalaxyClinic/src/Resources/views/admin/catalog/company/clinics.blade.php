@extends('admin::layouts.content')

@section('page_title')
    {{ __('galaxyclinic::app.catalog.services.add-clinics-slots') }}
@stop

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

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.galaxyclinic.catalog.therapists.addtherapistsslots', $therapists_id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        {{ __('galaxyclinic::app.catalog.services.add-clinics-slots') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('galaxyclinic::app.catalog.services.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                @csrf()
                <input name="_method" type="hidden" value="PUT">
                @foreach (app('Webkul\Marketplace\Repositories\SellerRepository')->findWhere(['is_approved' => 1]) as $seller)
                    <accordian title="{{ $seller->customer->first_name . ' ' . $seller->customer->last_name }}">
                        <div slot="body">
                            <appointment-booking :clinicid="'{{ $seller->customer->id }}'"></appointment-booking>
                        </div>
                    </accordian>
                @endforeach
                
            </div>
        </form>
    </div>
@stop

@push('scripts')
    <script type="text/x-template" id="appointment-booking-template">
        <div>
            <div class="control-group" :class="[errors.has('booking[duration]') ? 'has-error' : '']">
                <label class="required">{{ __('bookingproduct::app.admin.catalog.products.slot-duration') }}</label>

                <input type="text" v-validate="'required|min_value:1'" :name="'booking[' + clinicid + '][duration]'" v-model="appointment_booking.duration" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.slot-duration') }}&quot;"/>

                <span class="control-error" v-if="errors.has('booking[duration]')">@{{ errors.first('booking[duration]') }}</span>
            </div>

            <div class="control-group" :class="[errors.has('booking[break_time]') ? 'has-error' : '']">
                <label class="required">{{ __('bookingproduct::app.admin.catalog.products.break-time') }}</label>

                <input type="text" v-validate="'required|min_value:1'" :name="'booking[' + clinicid + '][break_time]'" v-model="appointment_booking.break_time" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.break-time') }}&quot;"/>

                <span class="control-error" v-if="errors.has('booking[break_time]')">@{{ errors.first('booking[break_time]') }}</span>
            </div>
            <div class="section">
                <div class="secton-title">
                    <span>{{ __('bookingproduct::app.admin.catalog.products.slots') }}</span>
                </div>

                <div class="section-content">
                    <slot-list
                        booking-type="appointment_slot"
                        :same-slot-all-days="0"
                        :clinicid="clinicid">
                    </slot-list>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('appointment-booking', {
            template: '#appointment-booking-template',

            inject: ['$validator'],

            props: ['clinicid'],

            data: function() {
                return {
                    appointment_booking: {
                        duration: 45,

                        break_time: 15,

                        same_slot_all_days: 1,

                        slots: []
                    }
                }
            }
        });
    </script>

<script type="text/x-template" id="slot-list-template">
    <div>
        <div class="slot-list table" v-if="parseInt(sameSlotAllDays)">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('bookingproduct::app.admin.catalog.products.from') }}</th>
                        <th>{{ __('bookingproduct::app.admin.catalog.products.to') }}</th>
                        <th class="actions"></th>
                    </tr>
                </thead>

                <tbody>
                    <slot-item
                        v-for="(slot, index) in slots['same_for_week']"
                        :key="index"
                        :slot-item="slot"
                        :clinicid="clinicid"
                        :control-name="'booking[' + clinicid + '][slots][' + index + ']'"
                        @onRemoveSlot="removeSlot($event)">
                    </slot-item>
                </tbody>
            </table>

            <button type="button" class="btn btn-lg btn-primary" style="margin-top: 20px" @click="addSlot()">
                {{ __('bookingproduct::app.admin.catalog.products.add-slot') }}
            </button>
        </div>

        <div class="slot-list table" v-else>
            <accordian
                v-for="(day, dayIndex) in week_days"
                :key="dayIndex"
                :title="day"
                :active="false">

                <div slot="header">
                    <i class="icon expand-icon left"></i>
                    <h1>@{{ day }}</h1>
                </div>

                <div slot="body">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('bookingproduct::app.admin.catalog.products.from') }}</th>
                                <th>{{ __('bookingproduct::app.admin.catalog.products.to') }}</th>
                                <th class="actions"></th>
                            </tr>
                        </thead>

                        <tbody v-if="slots['different_for_week'][dayIndex] && slots['different_for_week'][dayIndex].length">
                            <slot-item
                                v-for="(slot, slotIndex) in slots['different_for_week'][dayIndex]"
                                :key="dayIndex + '_' + slotIndex"
                                :slot-item="slot"
                                :control-name="'booking[' + clinicid + '][slots][' + dayIndex + '][' + slotIndex + ']'"
                                @onRemoveSlot="removeSlot($event, dayIndex)"
                            ></slot-item>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-lg btn-primary" style="margin-top: 20px" @click="addSlot(dayIndex)">
                        {{ __('bookingproduct::app.admin.catalog.products.add-slot') }}
                    </button>
                </div>
            </accordian>
        </div>
    </div>
</script>

<script type="text/x-template" id="slot-item-template">
    <tr>
        <td>
            <div class="control-group date" :class="[errors.has(controlName + '[from]') ? 'has-error' : '']">
                
               <label>{{ __('bookingproduct::app.admin.catalog.products.from') }}</label> 
            
                <time-component>
                    <input type="text" v-validate="'required'" :name="controlName + '[from]'" v-model="slotItem.from" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.from') }}&quot;">
                </time-component>

                <span class="control-error" v-if="errors.has(controlName + '[from]')">
                    @{{ errors.first(controlName + '[from]') }}
                </span>
            </div>
        </td>

        <td>
            <div class="control-group date" :class="[errors.has(controlName + '[to]') ? 'has-error' : '']">
                
                <label>{{ __('bookingproduct::app.admin.catalog.products.to') }}</label> 
                
                <time-component>
                    <input type="text" v-validate="{required: true, time_min: slotItem.from }" :name="controlName + '[to]'" v-model="slotItem.to" class="control" data-vv-as="&quot;{{ __('bookingproduct::app.admin.catalog.products.to') }}&quot;">
                </time-component>

                <span class="control-error" v-if="errors.has(controlName + '[to]')">
                    @{{ errors.first(controlName + '[to]') }}
                </span>
            </div>
        </td>

        <td>
            <i class="icon remove-icon" @click="removeSlot()"></i>
        </td>
    </tr>
</script>

<script>
    Vue.component('slot-list', {

        template: '#slot-list-template',

        props: ['bookingType', 'sameSlotAllDays', 'clinicid'],

        inject: ['$validator'],

        data: function() {
            return {
                slots: {
                    'same_for_week': [],

                    'different_for_week': [[], [], [], [], [], [], []]
                },

                week_days: [
                    "{{ __('bookingproduct::app.admin.catalog.products.monday') }}",
                    "{{ __('bookingproduct::app.admin.catalog.products.tuesday') }}",
                    "{{ __('bookingproduct::app.admin.catalog.products.wednesday') }}",
                    "{{ __('bookingproduct::app.admin.catalog.products.thursday') }}",
                    "{{ __('bookingproduct::app.admin.catalog.products.friday') }}",
                    "{{ __('bookingproduct::app.admin.catalog.products.saturday') }}",
                    "{{ __('bookingproduct::app.admin.catalog.products.sunday') }}",
                ]
            }
        },

        created: function() {
            this.slots['different_for_week'] = [];
        },

        methods: {
            addSlot: function (dayIndex = null) {
                if (dayIndex !== null) {
                    if (this.slots['different_for_week'][dayIndex] == undefined) {
                        this.slots['different_for_week'][dayIndex] = [];
                    }

                    var slot = {
                        'from': '',
                        'to': ''
                    };

                    this.slots['different_for_week'][dayIndex].push(slot)

                    Vue.set(this.slots['different_for_week'], dayIndex, this.slots['different_for_week'][dayIndex])
                } else {
                    var slot = {
                        'from': '',
                        'to': ''
                    };

                    this.slots['same_for_week'].push(slot);
                }
            },

            removeSlot: function(slot, dayIndex = null) {
                if (dayIndex != null) {
                    let index = this.slots['different_for_week'][dayIndex].indexOf(slot)

                    this.slots['different_for_week'][dayIndex].splice(index, 1)
                } else {
                    let index = this.slots['same_for_week'].indexOf(slot)

                    this.slots['same_for_week'].splice(index, 1)
                }
            },
        }
    });

    Vue.component('slot-item', {

        template: '#slot-item-template',

        props: ['slotItem', 'controlName', 'clinicid'],

        inject: ['$validator'],

        methods: {
            removeSlot: function() {
                this.$emit('onRemoveSlot', this.slotItem)
            },
        }
    });

    const time_validator = {
        getMessage: (field) => {
            return "{{ __('bookingproduct::app.admin.catalog.products.time-error') }}"
        },

        validate: (value, min) => {
            if (Array.isArray(value) || value === null || value === undefined || value === '') {
                return false;
            }

            return value > min;
        }
    };

    VeeValidate.Validator.extend('time_min', time_validator);
</script>

@endpush



