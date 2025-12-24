<?php

namespace App\Models;

use App\Models\BaseModel;

class Slider extends BaseModel
{
    protected $table = 'sliders';
    protected $fillable = [
        'name_en',
        'name_np',
        'image',
        'link',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
