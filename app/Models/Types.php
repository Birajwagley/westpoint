<?php

namespace App\Models;

use App\Models\BaseModel;

class Types extends BaseModel
{
    protected $table = 'types';
    protected $fillable = [
        'name_en',
        'name_np',
        'slug',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
