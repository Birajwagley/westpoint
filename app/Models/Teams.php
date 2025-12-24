<?php

namespace App\Models;

use App\Models\BaseModel;

class Teams extends BaseModel
{
    protected $table = 'teams';
    protected $fillable = [
        'type',
        'name_en',
        'name_np',
        'designation_id',
        'department_id',
        'image',
        'phone_number',
        'email',
        'description_en',
        'description_np',
        'facebook',
        'linked_in',
        'display_order',
        'is_published',
        'is_featured'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }
}
