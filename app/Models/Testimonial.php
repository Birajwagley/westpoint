<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends BaseModel
{
    protected $table = 'testimonials';
    protected $fillable = [
        'alumni_form_id',
        'image',
        'full_name',
        'testimonial_text',
        'testimonial_video',
        'perspective_from',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function alumni()
    {
        return $this->belongsTo(AlumniForm::class, 'alumni_form_id', 'id');
    }
}
