@extends('admin::layouts.content')

@section('page_title')
{{ __('galaxyclinic::app.catalog.therapists.edit-title') }}
@stop

@section('content')
    <div class="content">
        {!! view_render_event('bagisto.admin.customer.edit.before', ['customer' => $customer]) !!}

        <form method="POST" action="{{ route('admin.galaxyclinic.catalog.therapists.update', $customer->id) }}" enctype="multipart/form-data" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('galaxyclinic::app.catalog.therapists.title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                    {{ __('galaxyclinic::app.catalog.therapists.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    @csrf()

                    <input name="_method" type="hidden" value="PUT">

                    <accordian :title="'{{ __('admin::app.account.general') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                                <label for="first_name" class="required"> {{ __('admin::app.customers.customers.first_name') }}</label>
                                <input type="text"  class="control" name="first_name" v-validate="'required'" value="{{$customer->first_name}}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                                <label for="last_name" class="required"> {{ __('admin::app.customers.customers.last_name') }}</label>
                                <input type="text"  class="control"  name="last_name"   v-validate="'required'" value="{{$customer->last_name}}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;">
                                <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required"> {{ __('admin::app.customers.customers.email') }}</label>
                                <input type="email"  class="control"  name="email" v-validate="'required|email'" value="{{$customer->email}}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="gender" class="required">{{ __('admin::app.customers.customers.gender') }}</label>
                                <select name="gender" class="control" value="{{ $customer->gender }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customers.customers.gender') }}&quot;">
                                    <option value="Male" {{ $customer->gender == "Male" ? 'selected' : '' }}>{{ __('admin::app.customers.customers.male') }}</option>
                                    <option value="Female" {{ $customer->gender == "Female" ? 'selected' : '' }}>{{ __('admin::app.customers.customers.female') }}</option>
                                </select>
                                <span class="control-error" v-if="errors.has('gender')">@{{ errors.first('gender') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status" class="required">{{ __('admin::app.customers.customers.status') }}</label>
                                <select name="status" class="control" value="{{ $customer->status }}" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.customers.customers.status') }}&quot;">
                                    <option value="1" {{ $customer->status == "1" ? 'selected' : '' }}>{{ __('admin::app.customers.customers.active') }}</option>
                                    <option value="0" {{ $customer->status == "0" ? 'selected' : '' }}>{{ __('admin::app.customers.customers.in-active') }}</option>
                                </select>
                                <span class="control-error" v-if="errors.has('status')">@{{ errors.first('status') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('date_of_birth') ? 'has-error' : '']">
                                <label for="dob">{{ __('admin::app.customers.customers.date_of_birth') }}</label>
                                <input type="date" class="control" name="date_of_birth" value="{{ $customer->date_of_birth }}" v-validate="" data-vv-as="&quot;{{ __('admin::app.customers.customers.date_of_birth') }}&quot;">
                                <span class="control-error" v-if="errors.has('date_of_birth')">@{{ errors.first('date_of_birth') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                                <label for="phone">{{ __('admin::app.customers.customers.phone') }}</label>
                                <input type="text" class="control" id="phone" name="phone"  value="{{ $customer->phone }}"  data-vv-as="&quot;{{ __('admin::app.customers.customers.phone') }}&quot;">
                                <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('image') ? 'has-error' : '']">
                                <label class="required" for="image" >{{ __('galaxyclinic::app.catalog.therapists.therapists_profile_image') }}</label>
                                <img src="{{url('storage'. '/' . $customer->profile_image)}}" alt="Image" style="width:200px; height:100px;"/>
                                <input type="file" name="image" id="image" class="form-control" style="margin-top:1%;">
                                <span class="control-error" v-if="errors.has('image')">@{{ errors.first('image') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="customerGroup" >{{ __('admin::app.customers.customers.customer_group') }}</label>

                                @if (! is_null($customer->customer_group_id))
                                    <?php $selectedCustomerOption = $customer->group->id ?>
                                @else
                                    <?php $selectedCustomerOption = '' ?>
                                @endif

                                <select  class="control" name="customer_group_id">
                                
                                    @foreach (app('Webkul\Customer\Repositories\CustomerGroupRepository')->all() as $group)
                                        @if(core()->getConfigData('galaxyclinic.settings.general.default_therapists_group') == $group->id)
                                            <option value="{{ $group->id }}"> {{ $group->name}} </>
                                        @endif 
                                    @endforeach
                                </select>
                            </div>

                            <div class="control-group" :class="[errors.has('default_clinic_id') ? 'has-error' : '']">
                                <label for="default_clinic_id">{{ __('galaxyclinic::app.catalog.therapists.default_clinic') }}</label>
                                <select class="control" id="default_clinic_id" name="default_clinic_id" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.therapists.default_clinic') }}&quot;">
                                    @foreach (app('Webkul\Marketplace\Repositories\SellerRepository')->findWhere(['is_approved' => 1]) as $seller)
                                        <option value="{{ $seller->id }}" @if($customer->default_clinic_id == $seller->id) {{ 'selected' }} @endif>
                                            {{ $seller->customer->first_name . ' ' . $seller->customer->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('default_clinic_id')">@{{ errors.first('default_clinic_id') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('available_at_clinic') ? 'has-error' : '']">
                                <label for="available_at_clinic">{{ __('galaxyclinic::app.catalog.therapists.available_at_clinic') }}</label>
                                <select class="control" id="available_at_clinic" name="available_at_clinic[]" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.therapists.available_at_clinic') }}&quot;" multiple>
                                    @foreach (app('Webkul\Marketplace\Repositories\SellerRepository')->findWhere(['is_approved' => 1]) as $seller)
                                        <option value="{{ $seller->id }}">
                                            {{ $seller->customer->first_name . ' ' . $seller->customer->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('available_at_clinic')">@{{ errors.first('available_at_clinic') }}</span>
                            </div>


                        </div>
                    </accordian>

                    <?php
                        $seller = app('Webkul\Marketplace\Repositories\SellerRepository')->findOneWhere([
                            'customer_id' => $customer->id
                        ]);
                    ?>

                    @if ($seller)
                        <accordian :title="'{{ __('marketplace::app.admin.sellers.commission') }}'" :active="true">
                            <div slot="body">

                                <seller-commission
                                :percentage = "'{{ $seller->commission_percentage }}'"
                                :enable = "'{{ $seller->commission_enable }}'"
                                >
                                </seller-commission>

                            </div>
                        </accordian>
                    @endif

                </div>
            </div>
        </form>
        @if ( core()->getConfigData('marketplace.settings.seller_flag.enable') && $seller)
        <accordian :title="'{{ __('marketplace::app.admin.products.flag.flag-title') }}'" :active="'true'">

            <div slot="body">
                {!! app('Webkul\Marketplace\DataGrids\Admin\SellerFlagDataGrid')->render() !!}
            </div>
        </accordian>
        @endif

        {!! view_render_event('bagisto.admin.customer.edit.after', ['customer' => $customer]) !!}
    </div>
@stop

@push('scripts')

<script type="text/x-template" id="seller-commission-template">

    <div>
        <div class="control-group">
            <span class="checkbox">
                <input type="checkbox" id="status" name="commission_enable" @change="check"
                v-model="commission_enable" value="1">

                <label class="checkbox-view" for="status"></label>
                {{ __('marketplace::app.admin.sellers.change-commission') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('commission_percentage') ? 'has-error' : '']">
            <label for="commission_percentage" :class="isRequired ? 'required' : ''">
                {{ __('marketplace::app.admin.sellers.commission-percentage') }}
            </label>

            <input type="text"  class="control" name="commission_percentage" v-validate="isRequired ? 'required|between:.5,99' : ''" v-model="commission_percentage" data-vv-as="&quot;{{ __('marketplace::app.admin.sellers.commission-percentage') }}&quot;"
            :disabled="isActive == false ? true : false"/>

            <span class="control-error" v-if="errors.has('commission_percentage')">@{{ errors.first('commission_percentage') }}</span>
        </div>
    </div>

</script>

<script>

    Vue.component('seller-commission', {

        template: '#seller-commission-template',

        inject: ['$validator'],

        props: ['percentage', 'enable'],

        data: function() {
            return {
                commission_enable : 0,

                commission_percentage: '',

                isActive : false,

                isRequired: false,
            }
        },

        created: function() {
            if (this.enable == 1) {
                this.commission_percentage = this.percentage;
                this.commission_enable = 1;
                this.isActive = true;
                this.isRequired = false;
            }
        },

        methods: {
            check: function() {
                this.isActive = !this.isActive;
                this.isRequired = !this.isRequired;
            }
        }
    });

</script>

@endpush