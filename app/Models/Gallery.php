<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends BaseModel
{
    protected $table = 'galleries';
    protected $fillable = [
        'type',
        'name_en',
        'name_np',
        'slug',
        'value',
        'cover_image',
        'display_order',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
}
