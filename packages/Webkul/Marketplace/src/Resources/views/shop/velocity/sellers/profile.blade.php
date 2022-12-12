@extends('marketplace::shop.layouts.master')

@section('page_title')
    {{ $seller->shop_title }}
@stop

@section('seo')
    <meta name="description" content="{{ trim($seller->meta_description) != "" ? $seller->meta_description : Illuminate\Support\Str::limit(strip_tags($seller->description), 120, '') }}"/>
    <meta name="keywords" content="{{ $seller->meta_keywords }}"/>
@stop

@push('css')
    <style>
        #home-right-bar-container {
            background-color: {{$seller->profile_background}}
        }
    </style>
@endpush

@push('css')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@section('content-wrapper')
    <div class="main">
        <div class="profile-container">

            @include('marketplace::shop.velocity.sellers.left-profile')

            <div class="profile-right-block">

                @if ($banner = $seller->banner_url)
                    <img src="{{ $banner }}" />
                @else
                    <img src="{{ bagisto_asset('vendor/webkul/marketplace/assets/images/mp-velocity-banner.png') }}" />
                @endif

            </div>

        </div>

        @include('marketplace::shop.products.popular-products')

        <div class="profile-details padding-15">

            <?php $reviews = app('Webkul\Marketplace\Repositories\ReviewRepository')->getRecentReviews($seller->id); ?>

            <div class="profile-details-left-block section">
                @if ($reviews->count())

                    <div class="slider-container">
                        <div class="slider-content">

                            <carousel :per-page="1" pagination-active-color="#979797" pagination-color="#E8E8E8">
                                @foreach ($reviews as $review)

                                    <slide>
                                        <span class="stars">
                                            @for ($i = 1; $i <= $review->rating; $i++)

                                                <span class="icon star-icon"></span>

                                            @endfor
                                        </span>

                                        <p>
                                            {{ $review->comment }}
                                        </p>

                                        <p>

                                            {{
                                                __('marketplace::app.shop.sellers.profile.by-user-date', [
                                                        'name' => $review->customer->name,
                                                        'date' => core()->formatDate($review->created_at, 'F d, Y')
                                                    ])
                                            }}
                                        </p>
                                    </slide>

                                @endforeach
                            </carousel>

                        </div>

                        <a href="{{ route('marketplace.reviews.index', $seller->url) }}">{{ __('marketplace::app.shop.sellers.profile.all-reviews') }}</a>
                    </div>

                @endif

                <accordian :title="'{{ __('marketplace::app.shop.sellers.profile.return-policy') }}'" :active="false">
                    <div slot="header">
                        {{ __('marketplace::app.shop.sellers.profile.return-policy') }}
                        <i class="icon accordian-down-icon"></i>
                    </div>

                    <div slot="body">
                        <div class="full-description">
                            {!! $seller->return_policy !!}
                        </div>
                    </div>
                </accordian>

                <accordian :title="'{{ __('marketplace::app.shop.sellers.profile.shipping-policy') }}'" :active="false">
                    <div slot="header">
                        {{ __('marketplace::app.shop.sellers.profile.shipping-policy') }}
                        <i class="icon accordian-down-icon"></i>
                    </div>

                    <div slot="body">
                        <div class="full-description">
                            {!! $seller->shipping_policy !!}
                        </div>
                    </div>
                </accordian>

                <accordian :title="'{{ __('marketplace::app.shop.sellers.account.profile.privacy_policy') }}'" :active="false">
                    <div slot="header">
                        {{ __('marketplace::app.shop.sellers.account.profile.privacy_policy') }}
                        <i class="icon accordian-down-icon"></i>
                    </div>

                    <div slot="body">
                        <div class="full-description">
                            {!! $seller->privacy_policy !!}
                        </div>
                    </div>
                </accordian>
            </div>

            <div class="profile-details-right-block section">

                <div class="section-heading">
                    <h2>
                        {{ __('marketplace::app.shop.sellers.profile.about-seller') }}<br/>

                        <span class="seperator"></span>
                    </h2>
                </div>

                <div class="section-content">
                    <p>
                        {{
                            __('marketplace::app.shop.sellers.profile.member-since', [
                                'date' => core()->formatDate($seller->created_at, 'Y')
                                ])
                        }}
                    <p>

                    <p>
                        {!! $seller->description !!}
                    </p>
                </div>

            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script>
var color = "{{$seller->profile_background}}"; // colour chosen by marketplace seller
var newcolor = pickTextColorBasedOnBgColorAdvanced(color, '#FFFFFF', '#000000');
$('.shop-title').css('color',newcolor);
$('.review-info').css('color',newcolor);
$('.section-heading').css('color',newcolor);
$('.review-info').css('color',newcolor);

$('p span').css('color',newcolor);

function pickTextColorBasedOnBgColorAdvanced(bgColor, lightColor, darkColor) {
    var color = (bgColor.charAt(0) === '#') ? bgColor.substring(1, 7) : bgColor;
    var r = parseInt(color.substring(0, 2), 16);
    var g = parseInt(color.substring(2, 4), 16);
    var b = parseInt(color.substring(4, 6), 16);
    var uicolors = [r / 255, g / 255, b / 255];
    var c = uicolors.map((col) => {
        if (col <= 0.03928) {
        return col / 12.92;
        }
        return Math.pow((col + 0.055) / 1.055, 2.4);
    });
    var L = (0.2126 * c[0]) + (0.7152 * c[1]) + (0.0722 * c[2]);
return (L > 0.179) ? darkColor : lightColor;
}
</script>
@endpush

