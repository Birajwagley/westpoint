<?php

namespace App\Models;

use App\Models\BaseModel;

class Popup extends BaseModel
{
    protected $table = 'popups';
    protected $fillable = [
        'name_en',
        'name_np',
        'image',
        'download_document',
        'publish_date',
        'publish_upto',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
