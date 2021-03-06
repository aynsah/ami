<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisingImage extends Model
{
    public $table = 'advertising_image';

    public $fillable = [
        'image_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image_url' => 'string',
        'order' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image_url' => 'required|string'
    ];

}
