@extends('galaxy::layouts.master')

@section('page_title')
    {{ __('galaxy::app.customer.clinic.therapist.message') }}
@stop

@section('content')

    <div class="min-h-full max-w-3xl mx-auto pt-8">
        <div class="rounded-lg bg-white overflow-hidden shadow mt-10 ml-20">
            <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
            <div class="bg-white p-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div class="sm:flex sm:space-x-5">
                        <div class="flex-shrink-0">
                            <img class="mx-auto h-20 w-20 rounded-full" src="https://static.bestille.no/cs2017/stjarnkliniken/Ref2/Josefine.jpg" alt="">
                        </div>

                        <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                            <p class="text-md font-medium text-gray-600">Du har en bokad till hos,</p>
                            <p class="text-xl font-bold text-gray-900 sm:text-2xl">hos Josefine Engström</p>
                            <p class="text-lg font-bold text-gray-900 sm:text-lg">tisdag 17 augusti kl 14:00</p>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <label for="comment" class="block text-md font-medium text-gray-700">Skriv ett meddelande</label>
                    <div class="mt-1">
                        <textarea rows="4" name="comment" placeholder="Ditt meddelande skickas krypterat till terapeuten och är information som du anser är bra om terapeuten får veta innan ditt besök." id="comment" class="shadow-sm focus:ring-green-800 focus:border-green-800 block w-full sm:text-md border-1 border-green-800 rounded-md"></textarea>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">
                <div class="px-6 py-5 text-md font-medium text-center bg-gray-800 hover:bg-gray-700">
                    <span class="text-white font-bold">Tillbaka</span>
                    <span class="text-white">ett steg</span>
                </div>

                <div class="px-6 py-5 text-md font-medium text-center bg-green-800 hover:bg-green-700">
                    <span class="text-white font-bold">Bekräfta och</span>
                    <span class="text-white">betala</span>
                </div>
            </div>
        </div>
    </div>
    
@stop