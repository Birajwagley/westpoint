<?php

namespace App\Models;

use App\Models\BaseModel;

class JobApplication extends BaseModel
{
    protected $table = 'job_applications';
    protected $fillable = [
        'career_id',
        'full_name',
        'gender',
        'other_gender',
        'date_of_birth_ad',
        'date_of_birth_bs',
        'age',
        'current_address',
        'mobile_number',
        'email',
        'phone_no',
        'highest_education_qualification',
        'cover_letter',
        'cv',
        'remarks',
        'is_scanned',
        'is_shortlisted'
    ];

    protected $casts = [
        'is_scanned' => 'boolean',
        'is_shortlisted' => 'boolean',
    ];


    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id', 'id');
    }
}
