<?php

namespace App\Models;

use App\Models\BaseModel;

class AlumniForm extends BaseModel
{
    protected $table = 'alumni_form';
    protected $fillable = [
        'full_name',
        'email',
        'mobile_number',
        'occupation',
        'company_logo',
        'designation',
        'batch',
        'country',
        'section_type',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
}
