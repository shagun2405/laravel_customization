@extends('galaxy::layouts.master')

@section('page_title')
    {{ __('galaxy::app.therapist.patient_view_title') }}
@stop

@section('content')
   <div>
        <main class="grid grid-cols-4 gap-4">
            <div class="bg-white shadow col-span-3">
                <div class="px-4 sm:px-6 lg:max-w-10xl lg:mx-auto lg:px-8">
                    <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
                        <div class="flex-1 min-w-0">
                            <!-- Profile -->
                            <div class="flex items-center">
                                <img class="hidden h-16 w-16 rounded-full sm:block" src="https://media-exp1.licdn.com/dms/image/C4D03AQHtulLvxUbCRA/profile-displayphoto-shrink_200_200/0/1658218166565?e=1668643200&amp;v=beta&amp;t=PUDTeMpXd01mnHoSkjMFRdziJ-UQMsz5qSZLxdmlmBo" alt="">
                                <div>
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 rounded-full sm:hidden" src="https://media-exp1.licdn.com/dms/image/C4D03AQHtulLvxUbCRA/profile-displayphoto-shrink_200_200/0/1658218166565?e=1668643200&amp;v=beta&amp;t=PUDTeMpXd01mnHoSkjMFRdziJ-UQMsz5qSZLxdmlmBo" alt="">
                                        <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">Patient: Andrea Kviby - Massage 90 min - 2022-09-16 12:45</h1>
                                    </div>

                                    <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                                        <dt class="sr-only">Company</dt>
                                        <dd class="flex items-center text-sm text-gray-500 font-medium capitalize sm:mr-6">
                                            <!-- Heroicon name: solid/office-building -->
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                                            </svg>
                                            Kliniken i Katrineholm
                                        </dd>
                                        <dt class="sr-only">Account status</dt>
                                        <dd class="mt-3 flex items-center text-sm text-gray-500 font-medium sm:mr-6 sm:mt-0 capitalize">
                                            <!-- Heroicon name: solid/check-circle -->
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Inloggad senast: 2022-09-16 09:15
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Kontakta kund</button>
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Ny anteckning</button>
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-900 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">Ny bokning</button>
                        </div>
                    </div>
                </div>

                <div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Översikt - Andreas Kviby</h2>
                    <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/scale -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                        </svg>
                                    </div>

                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Kund sedan</dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">Den 17 aug 2020</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-green-900 hover:text-green-700"> Visa alla bokningar</a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                        </svg>
                                    </div>

                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Föregående behandling - Massage 45 min</dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">2022-08-26</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-green-900 hover:text-green-700"> Visa föregående behandling </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                        </svg>
                                    </div>

                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Betyg från Andreas Kviby</dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">4.8 av 5</div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-5 py-3">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-green-900 hover:text-green-700"> Visa kommentarer </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pl-8 pt-4">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Behandling idag 2022-09-16 2022 kl 12:45</h3>
                                <p class="mt-1 text-sm text-gray-600">Här är information gällande dagens besök</p>
                            </div>
                        </div>

                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <form action="#" method="POST">
                                <div class="shadow sm:overflow-hidden sm:rounded-md">
                                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                        <div>
                                            <label for="about" class="block text-sm font-medium text-gray-700">Anteckning</label>
                                            <div class="mt-1">
                                                <textarea id="about" name="about" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-800 focus:ring-green-800 sm:text-sm" placeholder="Dina anteckningar gällande dagens besök."></textarea>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Krypterad anteckning gällande dagens besök</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Foton / Bilder</label>
                                            <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                                <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>

                                                    <div class="flex text-sm text-gray-600">
                                                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-green-800 focus-within:outline-none focus-within:ring-2 focus-within:ring-green-800 focus-within:ring-offset-2 hover:text-green-800">
                                                            <span>Ladda upp</span>
                                                            <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                                        </label>
                                                        <p class="pl-1">eller dra hit</p>
                                                    </div>

                                                    <p class="text-xs text-gray-500">PNG, JPG, GIF max 10MB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-green-800 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-800 focus:ring-offset-2">Spara</button>
                                    </div>
                                </div>
                            </form>

                            <div class="flex items-start space-x-4 pt-10 pr-6">
                                <div class="flex-shrink-0">
                                    <img class="inline-block h-10 w-10 rounded-full" src="https://static.bestille.no/cs2017/stjarnkliniken/Ref2/Josefine.jpg" alt="">
                                </div>

                                <div class="min-w-0 flex-1">
                                    <form action="#">
                                        <div class="border-b border-gray-200 focus-within:border-green-800">
                                            <label for="comment" class="sr-only">Lägg till sökbar anteckning (ej krypterad)</label>
                                            <textarea rows="3" name="comment" id="comment" class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 focus:border-green-800 focus:ring-0 sm:text-sm" placeholder="Skriv anteckning inför uppföljning"></textarea>
                                        </div>

                                        <div class="flex justify-between pt-2">
                                            <div class="flex items-center space-x-5">
                                                <div class="flow-root">
                                                    <button type="button" class="-m-2 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500">
                                                        <!-- Heroicon name: outline/paper-clip -->
                                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"></path>
                                                        </svg>
                                                        <span class="sr-only">Attach a file</span>
                                                    </button>
                                                </div>

                                                <div class="flow-root">
                                                    <div>
                                                        <label id="listbox-label" class="sr-only"> Your mood </label>
                                                        <div class="relative">
                                                            <button type="button" class="relative -m-2 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                                                <span class="flex items-center justify-center">
                    
                                                                    <span>
                                                                    <!-- Heroicon name: outline/face-smile -->
                                                                    <svg class="h-6 w-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"></path>
                                                                    </svg>

                                                                    <span class="sr-only"> Add your mood </span>
                                                                    
                                                                    </span>
                                                                    <!-- Selected item label, show/hide based on listbox state. -->
                                                                    <span>

                                                                    <span class="bg-red-500 w-8 h-8 rounded-full flex items-center justify-center">
                                                                        <!-- Heroicon name: mini/fire -->
                                                                        <svg class="h-5 w-5 flex-shrink-0 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path fill-rule="evenodd" d="M13.5 4.938a7 7 0 11-9.006 1.737c.202-.257.59-.218.793.039.278.352.594.672.943.954.332.269.786-.049.773-.476a5.977 5.977 0 01.572-2.759 6.026 6.026 0 012.486-2.665c.247-.14.55-.016.677.238A6.967 6.967 0 0013.5 4.938zM14 12a4 4 0 01-4 4c-1.913 0-3.52-1.398-3.91-3.182-.093-.429.44-.643.814-.413a4.043 4.043 0 001.601.564c.303.038.531-.24.51-.544a5.975 5.975 0 011.315-4.192.447.447 0 01.431-.16A4.001 4.001 0 0114 12z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <span class="sr-only"> Mycket bättre </span>
                                                                    </span>
                                                                </span>
                                                            </button>

                                                            <ul class="absolute z-10 -ml-6 w-60 rounded-lg bg-white py-3 text-base shadow ring-1 ring-black ring-opacity-5 focus:outline-none sm:ml-auto sm:w-64 sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-5">
                                                              
                                                                <li class="bg-white relative cursor-default select-none py-2 px-3" id="listbox-option-0" role="option">
                                                                    <div class="flex items-center">
                                                                        <div class="bg-red-500 w-8 h-8 rounded-full flex items-center justify-center">
                                                                            <!-- Heroicon name: mini/fire -->
                                                                            <svg class="text-white flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                                <path fill-rule="evenodd" d="M13.5 4.938a7 7 0 11-9.006 1.737c.202-.257.59-.218.793.039.278.352.594.672.943.954.332.269.786-.049.773-.476a5.977 5.977 0 01.572-2.759 6.026 6.026 0 012.486-2.665c.247-.14.55-.016.677.238A6.967 6.967 0 0013.5 4.938zM14 12a4 4 0 01-4 4c-1.913 0-3.52-1.398-3.91-3.182-.093-.429.44-.643.814-.413a4.043 4.043 0 001.601.564c.303.038.531-.24.51-.544a5.975 5.975 0 011.315-4.192.447.447 0 01.431-.16A4.001 4.001 0 0114 12z" clip-rule="evenodd"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <span class="ml-3 block truncate font-medium">Uppföljning 7 dagar</span>
                                                                    </div>
                                                                </li>

                                                                <li class="bg-white relative cursor-default select-none py-2 px-3" id="listbox-option-2" role="option">
                                                                    <div class="flex items-center">
                                                                        <div class="bg-yellow-400 w-8 h-8 rounded-full flex items-center justify-center">
                                                                            <!-- Heroicon name: mini/face-frown -->
                                                                            <svg class="text-white flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3.536-3.475a.75.75 0 001.061 0 3.5 3.5 0 014.95 0 .75.75 0 101.06-1.06 5 5 0 00-7.07 0 .75.75 0 000 1.06zM9 8.5c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S7.448 7 8 7s1 .672 1 1.5zm3 1.5c.552 0 1-.672 1-1.5S12.552 7 12 7s-1 .672-1 1.5.448 1.5 1 1.5z" clip-rule="evenodd"></path>
                                                                            </svg>
                                                                        </div>

                                                                        <span class="ml-3 block truncate font-medium">Uppföljning 14 dagar</span>
                                                                    </div>
                                                                </li>

                                                                <li class="bg-white relative cursor-default select-none py-2 px-3" id="listbox-option-3" role="option">
                                                                    <div class="flex items-center">
                                                                        <div class="bg-green-400 w-8 h-8 rounded-full flex items-center justify-center">
                                                                            <!-- Heroicon name: mini/face-smile -->
                                                                            <svg class="text-white flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.536-4.464a.75.75 0 10-1.061-1.061 3.5 3.5 0 01-4.95 0 .75.75 0 00-1.06 1.06 5 5 0 007.07 0zM9 8.5c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S7.448 7 8 7s1 .672 1 1.5zm3 1.5c.552 0 1-.672 1-1.5S12.552 7 12 7s-1 .672-1 1.5.448 1.5 1 1.5z" clip-rule="evenodd"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <span class="ml-3 block truncate font-medium">Uppföljning 30 dagar</span>
                                                                    </div>
                                                                </li>

                                                                <li class="bg-white relative cursor-default select-none py-2 px-3" id="listbox-option-4" role="option">
                                                                    <div class="flex items-center">
                                                                        <div class="bg-blue-500 w-8 h-8 rounded-full flex items-center justify-center">
                                                                            <!-- Heroicon name: mini/hand-thumb-up -->
                                                                            <svg class="text-white flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                                <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <span class="ml-3 block truncate font-medium">Uppföljning 60 dagar</span>
                                                                    </div>
                                                                </li>

                                                                <li class="bg-white relative cursor-default select-none py-2 px-3" id="listbox-option-5" role="option">
                                                                    <div class="flex items-center">
                                                                        <div class="bg-transparent w-8 h-8 rounded-full flex items-center justify-center">
                                                                            <!-- Heroicon name: mini/x-mark -->
                                                                            <svg class="text-gray-400 flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <span class="ml-3 block truncate font-medium">Uppföljning 90 dagar</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex-shrink-0">
                                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-green-800 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Spara uppföljning</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="col-span-1">
                <div class="sticky space-y-4 top-4 mr-4">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Boka ny tid direkt</h2>

                    <div class="pt-0 pb-0">
                        <label id="listbox-label" class="block text-sm font-medium font-bold text-gray-700"> Välj klinik </label>
                        <div class="mt-1 relative mb-0">
                            <button type="button" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-green-800 focus:border-green-800 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                <span class="block truncate"> Katrineholm (förvald) </span>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <!-- Heroicon name: solid/selector -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                            </button>

                        </div>
                    </div>

                    <div class="pt-0 pb-0">
                        <label id="listbox-label" class="block text-sm font-medium text-gray-700"> Välj terapeut </label>
                        <div class="mt-1 relative">
                            <button type="button" class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
      <span class="flex items-center">
        <img src="https://static.bestille.no/cs2017/stjarnkliniken/Ref2/Josefine.jpg" alt="" class="flex-shrink-0 h-6 w-6 rounded-full">
        <span class="ml-3 block truncate"> Josefine Engström (förvald) </span>
      </span>
                                <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
        <!-- Heroicon name: solid/selector -->
        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </span>
                            </button>


                        </div>
                    </div>

                    <div class="pt-0 pb-0">
                        <label id="listbox-label" class="block text-sm font-medium font-bold text-gray-700"> Välj behandling </label>
                        <div class="mt-1 relative mb-0">
                            <button type="button" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-green-800 focus:border-green-800 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                <span class="block truncate"> Massage 90 min (förvald)</span>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <!-- Heroicon name: solid/selector -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                            </button>

                        </div>
                    </div>
                    <div class="pt-0 max-w-3xl mx-auto">
                        <label id="listbox-label" class="block text-sm font-medium text-gray-700"> Välj annan period </label>
                        <div class="mt-1 relative">
                            <button type="button" class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                          <span class="flex items-center">
                            <span aria-label="Online" class="bg-green-800 flex-shrink-0 inline-block h-2 w-2 rounded-full"></span>
                            <span class="ml-3 block truncate">vecka 33 - 15/8 - 19/8 2022 </span>
                          </span>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <!-- Heroicon name: solid/selector -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                          </span>
                            </button>

                        </div>
                    </div>
                    <div class="pt-0 pb-0">
                        <label id="listbox-label" class="block text-sm font-medium font-bold text-gray-700"> Välj dag &amp; period </label>
                        <div class="mt-1 relative mb-0">
                            <button type="button" class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-green-800 focus:border-green-800 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                <span class="block truncate"> Fredagar 11 - 13 (förvald)</span>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <!-- Heroicon name: solid/selector -->
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                            </button>

                        </div>
                    </div>
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="grid grid-cols-1 gap-1 sm:grid-cols-3 mt-4">


                        <div class="relative rounded-lg border border-gray-300 bg-green-800 px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <div class="flex-1 min-w-0">
                                <a href="#" class="focus:outline-none">

                                    <p class="text-sm font-medium text-white">Fredag 23 september</p>
                                    <p class="text-sm text-white truncate">11:00</p>


                                </a>
                            </div>
                        </div>

                        <div class="relative rounded-lg border border-gray-300 bg-green-800 px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <div class="flex-1 min-w-0">
                                <a href="#" class="focus:outline-none">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    <p class="text-sm font-medium text-white">Fredag 30 september</p>
                                    <p class="text-sm text-white truncate">12:45</p>
                                </a>
                            </div>
                        </div>


                        <div class="relative rounded-lg border border-gray-300 bg-green-800 px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <div class="flex-1 min-w-0">
                                <a href="#" class="focus:outline-none">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    <p class="text-sm font-medium text-white">Fredag 7 oktober</p>
                                    <p class="text-sm text-white truncate">11:00</p>
                                </a>
                            </div>
                        </div>


                    </div>

                    <div class="sticky space-y-4 top-4">
                        <!-- <div class="relative rounded-lg border border-gray-300 bg-sky-500 hover:bg-sky-700 px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <div class="flex-1 min-w-0">
                                <a href="betala_swish.html" class="focus:outline-none"  data-toggle="modal" data-target="#modal_code">
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                    <p class="text-sm text-center font-medium text-white">VISA SWISHKOD FÖR KUND</p>
                                </a>
                            </div>
                        </div> -->
                        <a 
                            href="javascript:void(0);"
                            onclick="window.showShareWishlistModal();" class="m-20">
                            {{ __('shop::app.customer.account.wishlist.share') }}
                        </a>
                    </div>

                </div>
            </aside>
        </main>
   </div>

@stop

<div id="shareWishlistModal" class="d-none">
                <modal id="shareWishlist" :is-open="modalIds.shareWishlist">
                    <h3 slot="header">
                        {{ __('shop::app.customer.account.wishlist.share-wishlist') }}
                    </h3>

                    <div slot="body">
                        <share-component></share-component>
                    </div>
                </modal>

@push('scripts')
    <script>
        $(document).on('click','#code_modal' ,function(){
            $("#code_modal").modal('show');
        });

        function showShareWishlistModal() {
                document.getElementById('shareWishlistModal').classList.remove('d-none');

                window.app.showModal('shareWishlist');
            }
    </script>
@endpush
