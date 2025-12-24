<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
    protected $fillable = [
        'image_one',
        'image_two',
        'image_three',
        'title_en',
        'title_np',
        'description_en',
        'description_np',
        'mission_en',
        'mission_np',
        'vision_en',
        'vision_np',
    ];
}
