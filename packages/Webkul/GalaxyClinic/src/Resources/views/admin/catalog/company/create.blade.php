@extends('admin::layouts.content')

@section('page_title')
    {{ __('galaxyclinic::app.catalog.company.add-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.galaxyclinic.catalog.company.store') }}" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.galaxyclinic.catalog.company.index') }}'"></i>

                        {{ __('galaxyclinic::app.catalog.company.title') }}

                        {{ Config::get('carrier.social.facebook.url') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('galaxyclinic::app.catalog.company.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    @csrf()

                    {!! view_render_event('bagisto.admin.customers.create.before') !!}

                    <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                        <label for="first_name" class="required">{{ __('galaxyclinic::app.catalog.company.company_name') }}</label>
                        <input type="text" class="control" id="first_name" name="first_name" v-validate="'required'" value="{{ old('first_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;">
                        <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.first_name.after') !!}

                    <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                        <label for="email" class="required">{{ __('shop::app.customer.signup-form.email') }}</label>
                        <input type="email" class="control" id="email" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                        <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.email.after') !!}

                    <div class="control-group" :class="[errors.has('gender') ? 'has-error' : '']" style="display:none">
                        <label for="gender" class="required">{{ __('galaxyclinic::app.catalog.company.gender') }}</label>
                        <select name="gender" class="control" id="gender" v-validate="'required'" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.company.gender') }}&quot;">
                            <option value="{{ __('galaxyclinic::app.catalog.company.male') }}">{{ __('galaxyclinic::app.catalog.company.male') }}</option>
                        </select>
                        <span class="control-error" v-if="errors.has('gender')">@{{ errors.first('gender') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.gender.after') !!}

                    <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                        <label for="phone">{{ __('galaxyclinic::app.catalog.company.phone') }}</label>
                        <input type="text" class="control" id="phone" name="phone" value="{{ old('phone') }}" v-validate="'numeric'" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.company.phone') }}&quot;">
                        <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('discount_percentage') ? 'has-error' : '']">
                        <label for="discount_percentage">{{ __('galaxyclinic::app.catalog.company.discount_percentage') }}</label>
                        <input type="text" class="control" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage') }}" v-validate="'numeric'" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.company.discount_percentage') }}&quot;">
                        <span class="control-error" v-if="errors.has('discount_percentage')">@{{ errors.first('discount_percentage') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.phone.after') !!}

                    <div class="control-group" style="display:none">
                        <label for="customerGroup" >{{ __('galaxyclinic::app.catalog.therapists.customer_group') }}</label>
                        <select  class="control" id="customerGroup" name="customer_group_id">
                        @foreach ($groups as $group)
                            @if(core()->getConfigData('galaxyclinic.settings.general.default_company_group') == $group->id)
                                <option value="{{ $group->id }}"> {{ $group->name}} </>
                            @endif    
                        @endforeach
                        </select>
                    </div>

                    <div class="control-group" :class="[errors.has('customer_ids[]') ? 'has-error' : '']">
                        <label for="customer_ids">{{ __('galaxyclinic::app.catalog.company.assign-customers') }}</label>
                        <select class="control" id="customer_ids" name="customer_ids[]" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.company.assign-customers') }}&quot;" multiple>
                            @foreach ($only_customers as $customer)
                                <option value="{{ $customer['id'] }}">
                                    {{ $customer['first_name'] . ' ' . $customer['last_name'] }}
                                </option>
                            @endforeach
                        </select>
                        <span class="control-error" v-if="errors.has('customer_ids[]')">@{{ errors.first('customer_ids[]') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.after') !!}
                </div>
            </div>
        </form>
    </div>
@stop