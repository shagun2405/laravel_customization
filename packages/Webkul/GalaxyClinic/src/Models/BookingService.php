<?php

namespace Webkul\GalaxyClinic\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\ProductProxy;
use Webkul\GalaxyClinic\Contracts\BookingService as BookingServiceContract;

class BookingService extends Model implements BookingServiceContract
{
    protected $table = 'booking_services';

    protected $fillable = [
        'is_service',
        'product_id',
    ];

    /**
     * Get the product that owns the image.
     */
    public function product()
    {
        return $this->belongsTo(ProductProxy::modelClass());
    }
}
