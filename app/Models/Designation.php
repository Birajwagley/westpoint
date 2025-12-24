<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends BaseModel
{
    protected $table = 'designations';
    protected $fillable = [
        'name_en',
        'name_np',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
