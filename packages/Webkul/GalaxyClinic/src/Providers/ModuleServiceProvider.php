<?php

namespace Webkul\GalaxyClinic\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\GalaxyClinic\Models\BookingService::class,
    ];
}