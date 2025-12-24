<?php

namespace App\Models;

use App\Models\BaseModel;

class Volunteer extends BaseModel
{
protected $table = 'volunteer';
    protected $fillable = [
        'images',
        'description_en',
        'description_np',
        'qualification_en',
        'qualification_np',
        'need_of_volunteer_en',
        'need_of_volunteer_np',
    ];
}
