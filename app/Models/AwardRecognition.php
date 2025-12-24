<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardRecognition extends BaseModel
{
    protected $table = 'award_recognition';
    protected $fillable = [
        'type',
        'award_type',
        'title_en',
        'title_np',
        'image',
        'short_description_en',
        'short_description_np',
        'display_order',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
}
