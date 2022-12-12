@extends('galaxy::layouts.master')

@section('page_title')
    {{ __('galaxy::app.customer.clinic.therapist.services') }}
@stop

@section('content')
    <slots></slots>       
@stop

@push('scripts')
    <script type="text/x-template" id="slots-template">
        <div>
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
                                    <p class="text-md font-medium text-gray-600">Boka tid i Katrineholm,</p>
                                    <p class="text-xl font-bold text-gray-900 sm:text-2xl">hos Josefine Engström</p>

                                    <div aria-live="assertive" class="flex px-0 py-0 pointer-events-none sm:pt-2 sm:items-start">
                                        <div class="w-full flex flex-col space-y-4 ">
                                            <div class="w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden -mb-6">
                                                <div class="p-4">
                                                    <div class="flex items-start">
                                                        <div class="flex-shrink-0">
                                                            <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>

                                                        <div class="ml-3  flex-1 pt-0.5">
                                                            <p class="text-md font-medium text-gray-900">Hej Andreas,</p>
                                                            <p class="mt-1 text-md text-gray-500">Jag har tagit fram förslag på tider de kommande 7 dagarna. Vill du boka längre fram, välj annan period i rullisten.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-md mt-4 font-medium text-green-600 font-bold"></p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 max-w-3xl mx-auto">
                            <label id="listbox-label" class="block text-md font-medium text-gray-700"> Välj annan period </label>
                            <div class="mt-1 relative">
                                <button type="button" class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-md" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                    <span class="flex items-center">
                                        <span aria-label="Online" class="bg-green-800 flex-shrink-0 inline-block h-2 w-2 rounded-full"></span>
                                        <span class="ml-3 block truncate" v-text="selectedDate">vecka 33 - 15/8 - 19/8 2022 </span>
                                    </span>

                                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4 flex sm:grid-cols-3 mt-4 " >
                            <div class="relative rounded-lg border border-gray-300 bg-green-800 px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500" v-for="(item, index) in slots_values" @click="saveSlot(index,item.slots,item.dates)">
                                <div class="flex-1 min-w-0">
                                    <a class="focus:outline-none">
                                        <p class="text-md font-medium text-white">@{{index}} @{{item.dates}}</p>
                                        <p class="text-md text-white truncate" v-if="item.slots.from">@{{item.slots.from}} - @{{item.slots.to}}</p>
                                        <p class="text-md text-white truncate" v-else>@{{item.slots}} </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x " style="padding-bottom:2.5rem; !important">
                        <div class="px-6 py-5 text-md font-medium text-center bg-gray-800 hover:bg-gray-700" @click="backOneStep">
                            <span class="text-white font-bold">{{ __('galaxy::app.customer.clinic.therapist.back-one-step')}}</span>
                        </div>

                        <div class="px-6 py-5 text-md font-medium text-center bg-green-800 hover:bg-green-700" @click="proceedPayment" >
                            <span class="text-white font-bold">{{ __('galaxy::app.customer.clinic.therapist.proceed-to-payment')}}</span>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </script>

    <script>
    var slots_values = @json($slots_data);
    
    Vue.component('slots', {
        template: '#slots-template',

        data: function() {
            return {
                slots_values:slots_values,
                selectedDate:"{{trans('galaxy::app.customer.clinic.therapist.select-slot')}}",
            }
        },

        methods: {
            saveSlot(day,slot,date) {
               this.selectedDate = day + '' + date;
                axios.post('{{ route("shop.customer.clinic.therapist.check-slot") }}', {day,slot,date})
                .then(response => {
                    if (response) {
                        this.res = response.data;
                        window.showAlert(
                            `alert-success`, 
                            "{{trans('galaxy::app.customer.clinic.therapist.success')}}", 
                            "{{trans('galaxy::app.customer.clinic.therapist.slot-selected')}}"
                        );
                    }
                }).catch(error => {
                    this.errorMessage = error.response.statusText;

                    if(error.response.status == 412) {
                        window.showAlert(
                            `alert-warning`, 
                            "{{trans('galaxy::app.customer.clinic.therapist.error')}}", 
                            "{{trans('galaxy::app.customer.clinic.therapist.future-slot')}}"
                        );
                    } else if(error.response.status == 403) {
                        window.showAlert(
                            `alert-warning`, 
                            "{{trans('galaxy::app.customer.clinic.therapist.error')}}", 
                            "{{trans('galaxy::app.customer.clinic.therapist.available-slot')}}"
                        );
                    }
                });
            },
            proceedPayment() {
                window.location.href = "{{ route('shop.customer.clinic.therapist.payment')}}"
            },
            backOneStep() {
                window.location.href = "{{ route('shop.customer.clinic.therapist.services')}}"
            }
        }
    });
    </script>
@endpush