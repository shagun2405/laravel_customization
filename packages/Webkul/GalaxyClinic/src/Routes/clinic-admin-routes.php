<?php

use Illuminate\Support\Facades\Route;
use Webkul\GalaxyClinic\Http\Controllers\Admin\ServiceController;
use Webkul\GalaxyClinic\Http\Controllers\Admin\AssignedServiceController;
use Webkul\GalaxyClinic\Http\Controllers\Admin\TherapistsController;
use Webkul\GalaxyClinic\Http\Controllers\Admin\CompanyController;

/**
 * Seller routes.
 */
Route::group(['middleware' => ['web', 'admin']], function () {
    // Route::group(['middleware' => ['web', 'galaxyclinic']], function () {

    Route::prefix('admin/galaxyclinic')->group(function () {

        Route::prefix('catalog')->group(function () {

            Route::get('services', [ServiceController::class, 'index'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.services.index',
            ])->name('admin.galaxyclinic.catalog.services.index');

            Route::get('services/create', [ServiceController::class, 'create'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.services.create',
            ])->name('admin.galaxyclinic.catalog.services.create');

            Route::post('/services/create', [ServiceController::class, 'store'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.services.edit',
            ])->name('admin.galaxyclinic.catalog.services.store');

            Route::get('services/edit/{id}', [ServiceController::class, 'edit'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.services.edit',
            ])->name('admin.galaxyclinic.catalog.services.edit');

            Route::put('/services/edit/{id}', [ServiceController::class, 'update'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.services.index',
            ])->name('admin.galaxyclinic.catalog.services.update');

            Route::post('/services/delete/{id}', [ServiceController::class, 'destroy'])->name('admin.galaxyclinic.catalog.services.delete');

            Route::post('services/massdelete', [ServiceController::class, 'massDestroy'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.services.index',
            ])->name('admin.galaxyclinic.catalog.services.massdelete');

            Route::post('services/massupdate', [ServiceController::class, 'massUpdate'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.services.index',
            ])->name('admin.galaxyclinic.catalog.services.massupdate');

            Route::get('assigned-services', [AssignedServiceController::class, 'index'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.assigned-services.index',
            ])->name('admin.galaxyclinic.catalog.assigned-services.index');

            /**
             * Therapists routes.
             */
            Route::get('/therapists', [TherapistsController::class, 'index'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.therapists.index',
            ])->name('admin.galaxyclinic.catalog.therapists.index');

            Route::get('/therapists/create', [TherapistsController::class, 'create'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.therapists.create',
            ])->name('admin.galaxyclinic.catalog.therapists.create');

            Route::post('/therapists/create', [TherapistsController::class, 'store'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.therapists.index',
            ])->name('admin.galaxyclinic.catalog.therapists.store');

            Route::get('/therapists/edit/{id}', [TherapistsController::class, 'edit'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.therapists.edit',
            ])->name('admin.galaxyclinic.catalog.therapists.edit');

            Route::put('/therapists/edit/{id}', [TherapistsController::class, 'update'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.therapists.index',
            ])->name('admin.galaxyclinic.catalog.therapists.update');

            Route::post('/therapists/delete/{id}', [TherapistsController::class, 'destroy'])->name('admin.galaxyclinic.catalog.therapists.delete');

            Route::get('/therapists/confirm/{id}', [TherapistsController::class, 'confirm'])->defaults('_config', [
                'view' => 'admin::customers.confirm-password',
            ])->name('admin.galaxyclinic.catalog.supertherapists.confirm');

            Route::post('/therapists/confirm/{id}', [TherapistsController::class, 'destroySelf'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.therapists.index',
            ])->name('admin.galaxyclinic.catalog.therapists.destroy');

            Route::post('/therapists/services', [TherapistsController::class, 'getServices'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.therapists.services',
            ])->name('admin.galaxyclinic.catalog.therapists.services');

            Route::get('/therapists/setting', function () {
                return redirect('/admin/configuration/galaxyclinic/settings');
            })->name('admin.galaxyclinic.catalog.therapists.settings');
            
            Route::get('/therapists/clinics/{id}', [TherapistsController::class, 'clinics'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.therapists.clinics',
            ])->name('admin.galaxyclinic.catalog.therapists.clinics');

            Route::put('/therapists/addTherapistsSlots/{id}', [TherapistsController::class, 'addTherapistsSlots'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.therapists.index',
            ])->name('admin.galaxyclinic.catalog.therapists.addtherapistsslots');

            Route::put('/therapists/updateTherapistsSlots/{id}', [TherapistsController::class, 'updateTherapistsSlots'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.therapists.index',
            ])->name('admin.galaxyclinic.catalog.therapists.updatetherapistsslots');

            /**
             * Company routes.
             */
            Route::get('/company', [CompanyController::class, 'index'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.company.index',
            ])->name('admin.galaxyclinic.catalog.company.index');

            Route::get('/company/create', [CompanyController::class, 'create'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.company.create',
            ])->name('admin.galaxyclinic.catalog.company.create');

            Route::post('/company/create', [CompanyController::class, 'store'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.company.index',
            ])->name('admin.galaxyclinic.catalog.company.store');

            Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.company.edit',
            ])->name('admin.galaxyclinic.catalog.company.edit');

            Route::put('/company/edit/{id}', [CompanyController::class, 'update'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.company.index',
            ])->name('admin.galaxyclinic.catalog.company.update');

            Route::post('/company/delete/{id}', [CompanyController::class, 'destroy'])->name('admin.galaxyclinic.catalog.company.delete');

            Route::get('/company/confirm/{id}', [CompanyController::class, 'confirm'])->defaults('_config', [
                'view' => 'admin::customers.confirm-password',
            ])->name('admin.galaxyclinic.catalog.supercompany.confirm');

            Route::post('/company/confirm/{id}', [CompanyController::class, 'destroySelf'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.company.index',
            ])->name('admin.galaxyclinic.catalog.company.destroy');

            Route::get('/company/setting', function () {
                return redirect('/admin/configuration/galaxyclinic/settings');
            })->name('admin.galaxyclinic.catalog.company.settings');
            
            Route::get('/company/clinics/{id}', [CompanyController::class, 'clinics'])->defaults('_config', [
                'view' => 'galaxyclinic::admin.catalog.company.customer',
            ])->name('admin.galaxyclinic.catalog.company.customer');

            Route::put('/company/addcompanySlots/{id}', [CompanyController::class, 'addcompanySlots'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.company.index',
            ])->name('admin.galaxyclinic.catalog.company.addcompanyslots');

            Route::put('/company/updatecompanySlots/{id}', [CompanyController::class, 'updatecompanySlots'])->defaults('_config', [
                'redirect' => 'admin.galaxyclinic.catalog.company.index',
            ])->name('admin.galaxyclinic.catalog.company.updatecompanyslots');

        });
    });
});