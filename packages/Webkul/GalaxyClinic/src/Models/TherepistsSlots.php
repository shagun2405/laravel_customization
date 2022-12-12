<?php

namespace Webkul\GalaxyClinic\Models;

use Illuminate\Database\Eloquent\Model;

class TherepistsSlots extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'therapists_slots';

    protected $fillable = [
        'therapists_id',
        'clinic_id',
        'duration',
        'break_time',
        'slots',
    ];
}