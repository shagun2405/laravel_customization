@extends('admin::layouts.content')

@section('page_title')
    {{ __('galaxyclinic::app.catalog.company.edit-title') }}
@stop

@section('content')
    <div class="content">
    <form method="POST" action="{{ route('admin.galaxyclinic.catalog.company.update', $customer->id) }}" @submit.prevent="onSubmit">

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
                    <input name="_method" type="hidden" value="PUT">

                    <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                        <label for="first_name" class="required"> {{ __('galaxyclinic::app.catalog.company.company_name') }}</label>
                        <input type="text"  class="control" name="first_name" v-validate="'required'" value="{{$customer->first_name}}"
                        data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;"/>
                        <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                        <label for="email" class="required"> {{ __('galaxyclinic::app.catalog.company.email') }}</label>
                        <input type="email"  class="control"  name="email" v-validate="'required|email'" value="{{$customer->email}}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                        <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                        <label for="phone">{{ __('galaxyclinic::app.catalog.company.phone') }}</label>
                        <input type="text" class="control" id="phone" name="phone"  value="{{ $customer->phone }}" v-validate="'numeric'" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.company.phone') }}&quot;">
                        <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                    </div>
                    {!! view_render_event('bagisto.admin.customers.create.phone.after') !!}

                    <div class="control-group" :class="[errors.has('discount_percentage') ? 'has-error' : '']">
                        <label for="discount_percentage">{{ __('galaxyclinic::app.catalog.company.discount_percentage') }}</label>
                        <input type="text" class="control" id="discount_percentage" name="discount_percentage"  value="{{ $discount_percentage }}" v-validate="'numeric'" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.company.discount_percentage') }}&quot;">
                        <span class="control-error" v-if="errors.has('discount_percentage')">@{{ errors.first('discount_percentage') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('customer_ids[]') ? 'has-error' : '']">
                        <label for="customer_ids">{{ __('galaxyclinic::app.catalog.company.assign-customers') }}</label>
                        <select class="control" id="customer_ids" name="customer_ids[]" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.company.assign-customers') }}&quot;" multiple>
                            @foreach ($only_customers as $customer)
                                <option value="{{ $customer['id'] }}" @if(in_array($customer['id'], $assigned_cutomers_ids)) {{ 'selected' }} @endif>
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