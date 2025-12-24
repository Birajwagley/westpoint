<?php

namespace App\Models;

use App\Models\BaseModel;

class Career extends BaseModel
{
    protected $table = 'careers';
    protected $fillable = [
        'slug',
        'name_en',
        'name_np',
        'designation_id',
        'number_of_post',
        'timing',
        'valid_date',
        'requirement_en',
        'requirement_np',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }
}
