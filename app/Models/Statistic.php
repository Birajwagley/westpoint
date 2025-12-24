<?php

namespace App\Models;

use App\Models\BaseModel;

class Statistic extends BaseModel
{
    protected $table = 'statistics';
    protected $fillable = [
        'name_en',
        'name_np',
        'icon',
        'count',
        'display_order',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
