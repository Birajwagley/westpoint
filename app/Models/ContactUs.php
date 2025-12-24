<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends BaseModel
{
    protected $table = 'contact_us';
    protected $fillable = [
        'full_name',
        'contact_no',
        'email',
        'message',
        'is_contacted',
        'contact_remarks',
        'contacted_by',
    ];

    protected $casts = [
        'is_contacted' => 'boolean',
    ];
}
