<?php

namespace Webkul\Galaxy\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Webkul\Galaxy\Facades\Galaxy as GalaxyFacade;

class GalaxyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {

        include __DIR__ . '/../Routes/front-routes.php';

        //$this->app->register(EventServiceProvider::class);
        
        //  $this->loadGloableVariables();

        $this->loadPublishableAssets();

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'galaxy');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'galaxy');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->registerConfig();

        // $this->registerFacades();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        // $this->mergeConfigFrom(
        //     dirname(__DIR__) . '/Config/admin-menu.php',
        //     'menu.admin'
        // );

        // $this->mergeConfigFrom(
        //     dirname(__DIR__) . '/Config/acl.php',
        //     'acl'
        // );
    }

    /**
     * Register Bouncer as a singleton.
     *
     * @return void
     */
    protected function registerFacades()
    {
        // $loader = AliasLoader::getInstance();

        // $loader->alias('galaxy', GalaxyFacade::class);
    }

    /**
     * This method will load all publishables.
     *
     * @return boolean
     */
    private function loadPublishableAssets()
    {
        $this->publishes([
            __DIR__ . '/../../publishable/assets/' => public_path('themes/galaxy/assets'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../Resources/views/shop' => resource_path('themes/galaxy/views'),
        ]);

        $this->publishes([__DIR__ . '/../Resources/lang' => lang_path('vendor/galaxy')]);

        return true;
    }

    /**
     * This method will provide global variables shared by view (blade files).
     *
     * @return boolean
     */
    private function loadGloableVariables()
    {
        // view()->composer('*', function ($view) {
        //     $galaxyHelper = app(\Webkul\Galaxy\Helpers\Helper::class);
        //     $view->with('showRecentlyViewed', true);
        //     $view->with('galaxyHelper', $galaxyHelper);
        //    // $view->with('velocityMetaData', $velocityHelper->getVelocityMetaData());
        // });

        // return true;
    }
}
