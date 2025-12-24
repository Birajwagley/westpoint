<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsCronology extends Model
{
    protected $table = 'about_us_cronology';
    protected $fillable = [
        'name_en',
        'name_np',
        'date_en',
        'date_np',
        'description_en',
        'description_np',
    ];
}
