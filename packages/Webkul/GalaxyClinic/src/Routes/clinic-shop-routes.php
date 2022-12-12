<?php

use Illuminate\Support\Facades\Route;

/**
 * Shop routes.
 */
Route::group([
    'prefix'     => 'galaxyclinic',
    'middleware' => ['web', 'theme', 'locale', 'currency']
], function () {

    Route::get('/', 'Webkul\GalaxyClinic\Http\Controllers\Shop\GalaxyClinicController@index')->defaults('_config', [
        'view' => 'galaxyclinic::shop.index',
    ])->name('shop.galaxyclinic.index');

});