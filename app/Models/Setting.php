<?php

namespace App\Models;

use App\Models\BaseModel;

class Setting extends BaseModel
{
    protected $table = 'settings';
    protected $fillable = [
        'primary_logo',
        'secondary_logo',
        'experience_logo',
        'favicon',
        'school_overview_image',
        'title_en',
        'title_np',
        'address_en',
        'address_np',
        'admission_notify_email',
        'career_notify_email',
        'volunteer_notify_email',
        'feedback_notify_email',
        'map',
        'contacts',
        'emails',
        'facebook',
        'instagram',
        'x',
        'linkedin',
        'youtube',
        'youtube_video',
        'schema_markup',
        'canonical_url',
        'keyword',
        'description_en',
        'description_np',
        'school_hour_en',
        'school_hour_np',
    ];
}
