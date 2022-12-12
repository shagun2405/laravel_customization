<?php

namespace Webkul\GalaxyClinic\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class GalaxyClinicServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
    */
    public function boot()
    {

        $this->app['validator']->extend('phone', function ($attribute, $value, $parameters) {
            return substr($value, 0, 2) == '0';
        });

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'galaxyclinic');

        // $this->publishes([
        //     __DIR__ . '/../../publishable/assets' => public_path('themes/default/assets'),
        // ], 'public');

        $this->app->register(EventServiceProvider::class);

        $this->app->register(ModuleServiceProvider::class);

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'galaxyclinic');

        // Event::listen('bagisto.admin.layout.head', function($viewRenderEventManager) {
        //     $viewRenderEventManager->addTemplate('galaxyclinic::admin.layouts.style');
        // });

        $this->publishes([
            __DIR__ . '/../Resources/views/admin/catalog/products/accordians/booking.blade.php' =>
                resource_path('views/vendor/bookingproduct/admin/catalog/products/accordians/booking.blade.php'),

                __DIR__ . '/../Resources/views/admin/sellers/create.blade.php' 
            => base_path('packages/Webkul/Marketplace/src/Resources/views/admin/sellers/create.blade.php'),

        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/sellers/account/catalog/products/accordians/assign_booking_product_section.blade.php' => resource_path('views/vendor/marketplace/shop/velocity/sellers/account/catalog/products/accordians/assign_booking_product_section.blade.php'),
        ]);

        $this->app->concord->registerModel(
            "Webkul\Product\Contracts\Product", "Webkul\GalaxyClinic\Models\Product"
        );

        $this->app->bind(
            "Webkul\Admin\DataGrids\ProductDataGrid", "Webkul\GalaxyClinic\DataGrids\Admin\AdminDataGrids\ProductDataGrid"
        );

        $this->app->bind(
            "Webkul\Marketplace\DataGrids\Shop\ProductDataGrid", "Webkul\GalaxyClinic\DataGrids\Marketplace\SellerDataGrids\ProductDataGrid"
        );

        $this->app->bind(
            "Webkul\Marketplace\DataGrids\Admin\ProductDataGrid", "Webkul\GalaxyClinic\DataGrids\Marketplace\AdminDataGrids\ProductDataGrid"
        );

        $this->overrideModels();
    }

    public function overrideModels()
    {
        $this->app->concord->registerModel(\Webkul\User\Contracts\Admin::class, \Webkul\GalaxyClinic\Models\Admin::class);
        $this->app->concord->registerModel(\Webkul\Customer\Contracts\Customer::class, \Webkul\GalaxyClinic\Models\Customer::class);

    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );
        
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/acl.php', 'acl'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menu.php', 'menu.customer'
        );
    }
}