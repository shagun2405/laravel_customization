<?php

use Illuminate\Support\Facades\Route;
use Webkul\GalaxyClinic\Http\Controllers\Shop\Account\AssignServiceController;
use Webkul\GalaxyClinic\Http\Controllers\Shop\Account\ServiceController;

/**
 * Shop routes.
 */
// Route::group(['middleware' => ['web', 'theme', 'locale', 'currency', 'galaxyclinic']], function () {
    Route::group(['middleware' => ['web', 'theme', 'locale', 'currency']], function () {

    /**
     * galaxyclinic routes starts here.
     */
    Route::prefix('galaxyclinic')->group(function () {
        /**
         * Auth Routes.
         */
        Route::group(['middleware' => ['customer']], function () {

            /**
             * galaxyclinic accounts.
             */
            Route::prefix('account')->group(function () {

                /**
                 * Catalog Routes.
                 */
                Route::prefix('catalog')->group(function () {

                    /**
                     * Catalog Product Routes.
                    */
                    Route::get('/services', [ServiceController::class, 'index'])->defaults('_config', [
                        'view' => 'galaxyclinic::shop.clinics.account.catalog.services.index'
                    ])->name('galaxyclinic.account.services.index');

                    Route::get('/services/search', [AssignServiceController::class, 'index'])->defaults('_config', [
                        'view' => 'galaxyclinic::shop.clinics.account.catalog.services.search'
                    ])->name('galaxyclinic.account.services.search');

                    Route::post('/services/assign', [AssignServiceController::class, 'store'])->defaults('_config', [
                        'redirect' => 'galaxyclinic.account.services.index'
                    ])->name('galaxyclinic.account.services.assign');

                    Route::get('/services/edit-assign/{id}', [AssignServiceController::class, 'edit'])->defaults('_config', [
                        'view' => 'galaxyclinic::shop.clinics.account.catalog.services.edit-assign'
                    ])->name('galaxyclinic.account.services.assign.edit');

                    Route::put('/services/edit-assign/{id}', [AssignServiceController::class, 'update'])->defaults('_config', [
                        'redirect' => 'galaxyclinic.account.services.index'
                    ])->name('galaxyclinic.account.services.assign.update');

                    Route::post('/services/delete/{id}', [AssignServiceController::class, 'destroy'])->name('galaxyclinic.account.services.assign.delete');

                    Route::post('services/massdelete', [AssignServiceController::class, 'massDestroy'])->defaults('_config', [
                        'redirect' => 'galaxyclinic.account.services.index'
                    ])->name('galaxyclinic.account.services.assign.massdelete');
                });
            });
        });
    });
});