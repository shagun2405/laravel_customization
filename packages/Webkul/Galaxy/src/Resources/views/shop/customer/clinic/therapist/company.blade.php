@extends('galaxy::layouts.master')

@section('page_title')
    {{ __('galaxy::app.customer.clinic.therapist.company') }}
@stop

@section('content')
    <company></company>       
@stop

@push('scripts')

    <script type="text/x-template" id="company-template">

        <div>
            <div class="min-h-full max-w-3xl mx-auto pt-8">
                <div class="rounded-lg bg-white overflow-hidden shadow mt-10 ml-20">
                    <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
                    <div class="bg-white p-6">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-5">
                                <div class="flex-shrink-0">
                                    <img class="mx-auto h-20 w-20 rounded-full" src="data:image/jpeg;base64,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" alt="">
                                </div>

                                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                    <p class="text-md font-medium text-gray-600">Välkommen tillbaka,</p>
                                    <p class="text-xl font-bold text-gray-900 sm:text-2xl">Andreas Kviby</p>
                                    <p class="text-md font-medium text-gray-600">andreaskviby@icloud.com</p>

                                    <p class="text-md mt-4 font-medium text-green-600 font-bold">Du finns i våra system både som privatperson och medarbetare i en eller flera organisationer. Välj under vilket konto du avser boka.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">
                        <div class="px-6 py-5 text-md font-medium text-center bg-green-800 hover:bg-green-700">
                            <span class="text-white font-bold">Boka som</span>
                            <span class="text-white">Privatperson</span>
                        </div>

                        <div class="px-6 py-5 text-md font-medium text-center bg-cyan-900 hover:bg-cyan-700" @click="RedirectPage()">
                            <span class="text-white font-bold">Boka som</span>
                            <span class="text-white">Medarbetare på NTM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </script>

    <script>
        Vue.component('company', {
            template: '#company-template',
            data: function() {
                return {
                
                }
            },

            methods: {
                RedirectPage: function() {
                    window.location.href ="{{ route('shop.customer.clinic.therapist.services') }}";
                }
            }
        });

    </script>
@endpush