<?php

namespace App\Models;

use App\Models\BaseModel;

class Grievence extends BaseModel
{
    protected $table = 'grievances';
    protected $fillable = ['is_confidential', 'is_affected_party', 'full_name', 'relation', 'email', 'contact_no', 'address', 'message'];

    protected $casts = [
        'is_confidential' => 'boolean',
        'is_affected_party' => 'boolean',
    ];
}
