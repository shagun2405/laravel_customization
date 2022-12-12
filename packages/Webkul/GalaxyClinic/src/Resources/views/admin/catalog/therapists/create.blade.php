@extends('admin::layouts.content')

@section('page_title')
    {{ __('galaxyclinic::app.catalog.therapists.add-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.galaxyclinic.catalog.therapists.store') }}" enctype="multipart/form-data" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.galaxyclinic.catalog.therapists.index') }}'"></i>

                        {{ __('galaxyclinic::app.catalog.therapists.title') }}

                        {{ Config::get('carrier.social.facebook.url') }}
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

                    {!! view_render_event('bagisto.admin.customers.create.before') !!}

                    <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                        <label for="first_name" class="required">{{ __('galaxyclinic::app.catalog.therapists.first_name') }}</label>
                        <input type="text" class="control" id="first_name" name="first_name" v-validate="'required'" value="{{ old('first_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;">
                        <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.first_name.after') !!}

                    <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                        <label for="last_name" class="required">{{ __('galaxyclinic::app.catalog.therapists.last_name') }}</label>
                        <input type="text" class="control" id="last_name" name="last_name" v-validate="'required'" value="{{ old('last_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;">
                        <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.last_name.after') !!}

                    <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                        <label for="email" class="required">{{ __('shop::app.customer.signup-form.email') }}</label>
                        <input type="email" class="control" id="email" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                        <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.email.after') !!}

                    <div class="control-group" :class="[errors.has('gender') ? 'has-error' : '']">
                        <label for="gender" class="required">{{ __('galaxyclinic::app.catalog.therapists.gender') }}</label>
                        <select name="gender" class="control" id="gender" v-validate="'required'" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.therapists.gender') }}&quot;">
                            <option value="">{{ __('galaxyclinic::app.catalog.therapists.select-gender') }}</option>
                            <option value="{{ __('galaxyclinic::app.catalog.therapists.male') }}">{{ __('galaxyclinic::app.catalog.therapists.male') }}</option>
                            <option value="{{ __('galaxyclinic::app.catalog.therapists.female') }}">{{ __('galaxyclinic::app.catalog.therapists.female') }}</option>
                            <option value="{{ __('galaxyclinic::app.catalog.therapists.other') }}">{{ __('galaxyclinic::app.catalog.therapists.other') }}</option>
                        </select>
                        <span class="control-error" v-if="errors.has('gender')">@{{ errors.first('gender') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.gender.after') !!}

                    <div class="control-group" :class="[errors.has('date_of_birth') ? 'has-error' : '']">
                        <label for="dob">{{ __('galaxyclinic::app.catalog.therapists.date_of_birth') }}</label>
                        <input type="date" class="control" id="dob" name="date_of_birth" v-validate="" value="{{ old('date_of_birth') }}" placeholder="{{ __('galaxyclinic::app.catalog.therapists.date_of_birth_placeholder') }}" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.therapists.date_of_birth') }}&quot;">
                        <span class="control-error" v-if="errors.has('date_of_birth')">@{{ errors.first('date_of_birth') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.date_of_birth.after') !!}

                    <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                        <label for="phone">{{ __('galaxyclinic::app.catalog.therapists.phone') }}</label>
                        <input type="text" class="phone control" id="phone" name="phone" value="{{ old('phone') }}" data-vv-as="&quot;{{ __('galaxyclinic::app.catalog.therapists.phone') }}&quot;">
                        <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.phone.after') !!}

                    <div class="control-group" :class="[errors.has('image') ? 'has-error' : '']">
                        <label class="required" for="image" >{{ __('galaxyclinic::app.catalog.therapists.therapists_profile_image') }}</label>
                        <input type="file" name="image" id="image" class="form-control" style="margin-top:1%;">
                        <span class="control-error" v-if="errors.has('image')">@{{ errors.first('image') }}</span>
                    </div>

                    <div class="control-group">
                        <label for="customerGroup" >{{ __('galaxyclinic::app.catalog.therapists.customer_group') }}</label>
                        <select  class="control" id="customerGroup" name="customer_group_id">
                        @foreach ($groups as $group)
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
                                <option value="{{ $seller->id }}">
                                    {{ $seller->customer->first_name . ' ' . $seller->customer->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="control-error" v-if="errors.has('default_clinic_id')">@{{ errors.first('default_clinic_id') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.customers.create.after') !!}

                    <div class="control-group" :class="[errors.has('available_at_clinic') ? 'has-error' : '']">
                        <label for="available_at_clinic">{{ __('galaxyclinic::app.catalog.therapists.default_clinic') }}</label>
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
            </div>
        </form>
    </div>
@stop


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

    <script>

        $(document).ready(function(){
            $('.phone').inputmask('(099)-999-9999');
        });

    </script>
@endpush