

<div class="header" id="header">
    
        <div class="right-content">

            <ul class="right-content-menu">


                {!! view_render_event('bagisto.galaxy.layout.header.currency-item.before') !!}


                <li>
                    <span class="dropdown-toggle">
                        <i class="icon account-icon"></i>
                      
                        <span class="name"></span>

                        <i class="icon arrow-down-icon"></i>
                    </span>

                    @guest('customer')
                        <ul class="dropdown-list account guest p-2" >
                            <li>
                                <div class="button-group">
                                    <a class="btn btn-primary btn-md" href="" style="color: #ffffff">
                                        {{ __('galaxy::app.header.sign-in') }}
                                    </a>

                                    <a class="btn btn-primary btn-md" href="" style="float: right; color: #ffffff">
                                        {{ __('galaxy::app.header.sign-up') }}
                                    </a>
                                </div>
                            </li>

                            <hr>
                        </ul>
                    @endguest

                    @auth('customer')
                        <ul class="dropdown-list account customer">
                            <li>
                                <div>
                                    <label style="color: #9e9e9e; font-weight: 700; text-transform: uppercase; font-size: 15px;">
                                        {{ auth()->guard('customer')->user()->first_name }}
                                    </label>
                                </div>

                                <ul>
                                    <li>
                                        <a href="{{ route('customer.profile.index') }}">{{ __('galaxy::app.header.profile') }}</a>
                                    </li>

                                    <li>
                                        <form id="customerLogout" action="{{ route('customer.session.destroy') }}" method="POST">
                                            @csrf

                                            @method('DELETE')
                                        </form>

                                        <a
                                            href="{{ route('customer.session.destroy') }}"
                                            onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                                            {{ __('galaxy::app.header.logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </li>

                {!! view_render_event('bagisto.galaxy.layout.header.account-item.after') !!}


                {!! view_render_event('bagisto.galaxy.layout.header.cart-item.before') !!}

                <!-- <li class="cart-dropdown-container">

                    @include('galaxy::checkout.cart.mini-cart')

                </li> -->

                {!! view_render_event('bagisto.galaxy.layout.header.cart-item.after') !!}

            </ul>

            <span class="menu-box" ><span class="icon icon-menu" id="hammenu"></span>
        </div>
    </div>

   

</div>

@push('scripts')
   
    

    <script>
        $(document).ready(function() {

            $('body').delegate('#search, .icon-menu-close, .icon.icon-menu', 'click', function(e) {
                toggleDropdown(e);
            });

            @auth('customer')
                @php
                    $compareCount = app('Webkul\Velocity\Repositories\VelocityCustomerCompareProductRepository')
                        ->count([
                            'customer_id' => auth()->guard('customer')->user()->id,
                        ]);
                @endphp

                let comparedItems = JSON.parse(localStorage.getItem('compared_product'));
                $('#compare-items-count').html({{ $compareCount }});
            @endauth

            @guest('customer')
                let comparedItems = JSON.parse(localStorage.getItem('compared_product'));
                $('#compare-items-count').html(comparedItems ? comparedItems.length : 0);
            @endguest

            function toggleDropdown(e) {
                var currentElement = $(e.currentTarget);

                if (currentElement.hasClass('icon-search')) {
                    currentElement.removeClass('icon-search');
                    currentElement.addClass('icon-menu-close');
                    $('#hammenu').removeClass('icon-menu-close');
                    $('#hammenu').addClass('icon-menu');
                    $("#search-responsive").css("display", "block");
                    $("#header-bottom").css("display", "none");
                } else if (currentElement.hasClass('icon-menu')) {
                    currentElement.removeClass('icon-menu');
                    currentElement.addClass('icon-menu-close');
                    $('#search').removeClass('icon-menu-close');
                    $('#search').addClass('icon-search');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "block");
                } else {
                    currentElement.removeClass('icon-menu-close');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "none");
                    if (currentElement.attr("id") == 'search') {
                        currentElement.addClass('icon-search');
                    } else {
                        currentElement.addClass('icon-menu');
                    }
                }
            }
        });
    </script>
@endpush