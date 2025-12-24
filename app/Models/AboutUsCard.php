<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsCard extends Model
{
    protected $table = 'about_us_card';
    protected $fillable = [
        'name_en',
        'name_np',
        'link',
        'image',
        'short_description_en',
        'short_description_np',
    ];
}
