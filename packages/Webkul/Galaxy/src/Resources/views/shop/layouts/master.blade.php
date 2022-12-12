<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>@yield('page_title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if ($favicon = core()->getConfigData('general.design.admin_logo.favicon'))
            <link rel="icon" sizes="16x16" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}" />
        @else
            <link rel="icon" sizes="16x16" href="{{ asset('/themes/galaxy/assets/images/logga_svart.png') }}" />
        @endif
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>

        <script src="https://cdn.tailwindcss.com"></script>
        <script type="text/javascript" src="{{ asset('themes/galaxy/assets/js/galaxy.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>

   
        <script type="text/javascript">
            window.flashMessages = [];

            if(localStorage.getItem('dark-mode') == 'true'){
                document.body.classList.toggle("dark-mode");
            }    

            @foreach (['success', 'warning', 'error', 'info'] as $key)
                @if ($value = session($key))
                    window.flashMessages.push({'type': 'alert-{{ $key }}', 'message': "{{ $value }}" });
                @endif
            @endforeach

            window.serverErrors = [];
            @if (isset($errors))
                @if (count($errors))
                    window.serverErrors = @json($errors->getMessages());
                @endif
            @endif

            

        </script>

        <style type="text/tailwindcss">
        @layer utilities {
            .content-auto {
                content-visibility: auto;
            }
        }
        .main_class{
            position: relative !important;
            justify-content: center !important;
        }

        </style>

        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

        <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">
        <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('themes/galaxy/assets/css/galaxy.css') }}">

        @yield('css')

        @if (request()->route()->getName() != "shop.therapist.login.index" && !request()->routeIs('shop.customer.*')  && !request()->routeIs('shop.home.index'))
            @include('shop::layouts.header.index')
        @endif
        
        {!! view_render_event('bagisto.admin.layout.head') !!}
    </head>
    <body>
        
        <div id="app"  @if (request()->routeIs('shop.customer.*') || request()->route()->getName() == "shop.therapist.login.index") class="main_class" @endif>

            @if (request()->routeIs('shop.customer.*') || request()->routeIs('shop.home.index'))
                
                <div >

                    <div class="shadow" style="position: fixed;top: 0;width: 100%;background-color: white;">
                        
                        <div>
                            <img class="h-10" src="{{ asset('/themes/galaxy/assets/images/logga_svart.png') }}" alt="Stjärnkliniken" >
                            @if(!request()->routeIs('shop.home.index'))
                            <div class="max-w-7xl pt-3 pr-3 float-right" style="float:right;margin-top: -46px; margin-right:150px" >
                                @include('galaxy::layouts.header.customer')
                            </div>
                            @endif
                        <div>

                    

                    </div>

                    
                </div>
            @endif

                <div>
                    @if(request()->route()->getName() != "shop.therapist.login.index" && !request()->routeIs('shop.customer.*') && !request()->routeIs('shop.home.index'));
                        @include('galaxy::shop.layouts.top-nav.index')
                    @endif
                </div>

                <div>
                    @if(request()->routeIs('shop.customer.*')  && !request()->routeIs('shop.home.index'))
                        @include('galaxy::shop.layouts.top-nav.customer')
                    @endif
                </div>

                <div>
                    @yield('content')
                    <flash-wrapper ref='flashes'></flash-wrapper>
                </div>
                    <div id="alert-container" class="p-5" ></div>

                
            </div>
        </div>

    
        @stack('scripts')

        <div class="modal-overlay"></div>
        <script type="text/javascript">
            let message = @json(app('Webkul\Velocity\Helpers\Helper')->getMessage());

            if (message.messageType && message.message !== '') {
                window.showAlert(message.messageType, message.messageLabel, message.message);
            }

            /* activate server error messages */
            window.serverErrors = [];
            @if (isset($errors))
                @if (count($errors))
                    window.serverErrors = @json($errors->getMessages());
                @endif
            @endif
            /* add translations */
            window._translations = @json(app('Webkul\Velocity\Helpers\Helper')->jsonTranslations());
        </script>
    </body>
</html>
