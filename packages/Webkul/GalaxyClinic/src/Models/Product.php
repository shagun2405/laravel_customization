<?php

namespace Webkul\GalaxyClinic\Models;

use Webkul\Product\Models\Product as ProductBaseModel;
use Webkul\GalaxyClinic\Models\BookingServiceProxy;

class Product extends ProductBaseModel
{
    /**
     * Get the service type.
     */
    public function is_service()
    {
        return $this->hasOne(BookingServiceProxy::modelClass(), 'product_id');
    }
}