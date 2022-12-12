@extends('marketplace::shop.layouts.account')

@section('page_title')
    {{ __('marketplace::app.shop.sellers.account.catalog.products.assing-edit-title') }}
@endsection

@section('content')

    <div class="account-layout right m10">

        <form method="POST" action="" enctype="multipart/form-data" @submit.prevent="onSubmit" class="account-table-content">

            <div class="account-head mb-10">
                <span class="account-heading">
                    {{ __('marketplace::app.shop.sellers.account.catalog.products.assing-edit-title') }}
                </span>

                <div class="account-action">
                    <button type="submit" class="btn btn-primary">
                        {{ __('marketplace::app.shop.sellers.account.catalog.products.save-btn-title') }}
                    </button>
                </div>

                <div class="horizontal-rule"></div>
            </div>

            {!! view_render_event('marketplace.sellers.account.catalog.product.edit-assign.before') !!}

            <div class="account-table-content">

                @csrf()

                <div class="product-information">

                    <div class="product-image">
                        <img src="{{ asset($product->product->base_image_url ?? 'vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}"/>
                    </div>

                    <div class="product-details">
                        <div class="product-name">
                            <a href="{{ url()->to('/').'/'.$product->product->url_key }}" target="_blank" title="{{ $product->product->name }}">
                                <span>
                                    {{ $product->product->name }}
                                </span>
                            </a>
                        </div>

                        @include ('shop::products.price', ['product' => $product->product])
                    </div>

                </div>

                <input name="_method" type="hidden" value="PUT">

                <accordian :title="'{{ __('marketplace::app.shop.sellers.account.catalog.products.general') }}'" :active="true">
                    <div slot="header">
                        {{ __('marketplace::app.shop.sellers.account.catalog.products.general') }}
                        <i class="icon expand-icon right"></i>
                    </div>
                    <div slot="body">

                        <div class="control-group" :class="[errors.has('price') ? 'has-error' : '']">
                            <label for="price" class="required mandatory">{{ __('marketplace::app.shop.sellers.account.catalog.products.price') }}</label>
                            <input type="text" v-validate="'required|decimal'" class="control" id="price" name="price" value="{{ old('price') ?: $product->price }}" data-vv-as="&quot;{{ __('marketplace::app.shop.sellers.account.catalog.products.price') }}&quot;" />
                            <span class="control-error" v-if="errors.has('price')">@{{ errors.first('price') }}</span>
                        </div>

                        <div class="control-group form-group" :class="[errors.has('description') ? 'has-error' : '']">
                            <label for="description" class="required mandatory">{{ __('marketplace::app.shop.sellers.account.catalog.products.description') }}</label>
                            <textarea v-validate="'required'" class="control" id="description" name="description" data-vv-as="&quot;{{ __('marketplace::app.shop.sellers.account.catalog.products.description') }}&quot;">{{ old('description') ?: $product->description }}</textarea>
                            <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                        </div>

                    </div>
                </accordian>

                <accordian :title="'{{ __('marketplace::app.shop.sellers.account.catalog.products.images') }}'" :active="true">
                    <div slot="header">
                        {{ __('marketplace::app.shop.sellers.account.catalog.products.images') }}
                        <i class="icon expand-icon right"></i>
                    </div>
                    <div slot="body">

                        <image-wrapper :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'" input-name="images" :images='@json($product->images)'></image-wrapper>

                    </div>
                </accordian>

                @include ('marketplace::shop.sellers.account.catalog.products.accordians.assign-videos')
            </div>

            @include ('marketplace::shop.sellers.account.catalog.products.accordians.assign_booking_product_section')

            {!! view_render_event('shop.marketplace.sellers.account.catalog.product.edit-assign.after',['product' => $product]) !!}

        </form>

    </div>

@endsection