<?php

namespace App\Models;

use App\Models\BaseModel;

class Alumni extends BaseModel
{
    protected $table = 'alumni';
    protected $fillable = ['images', 'description_en', 'description_np', 'group_en', 'group_np', 'links'];

    protected $casts = [
        'links' => 'array',
    ];
}
