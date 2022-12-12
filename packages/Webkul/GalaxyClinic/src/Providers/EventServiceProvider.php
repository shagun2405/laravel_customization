<?php

namespace Webkul\GalaxyClinic\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
    */
    public function boot() {
        // Event::listen('bagisto.galaxyclinic.catalog.service.edit_form_accordian.additional_views.after', function($viewRenderEventManager) {
        //     $viewRenderEventManager->addTemplate('galaxyclinic::admin.catalog.products.accordians.assign-product');
        // });
    }
}