<?php

namespace App\Models;

use App\Models\BaseModel;

class Club extends BaseModel
{
    protected $table = 'clubs';
    protected $fillable = ['slug','school_amenity', 'name_en', 'name_np', 'icon', 'thumbnail_image', 'images', 'short_description_en', 'short_description_np', 'description_en', 'description_np','menu_id', 'is_featured', 'external_link', 'display_order', 'is_published'];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
}
