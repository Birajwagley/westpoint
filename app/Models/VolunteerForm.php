<?php

namespace App\Models;

use App\Models\BaseModel;


class VolunteerForm extends BaseModel
{
protected $table = 'volunteer_form';
    protected $fillable = [
        'full_name',
        'date_of_birth_ad',
        'date_of_birth_bs',
        'age',
        'gender',
        'other_gender',
        'nationality',
        'passport_number',
        'email',
        'contact_no',
        'current_address',
        'emergency_full_name',
        'emergency_relationship',
        'emergency_contact_number',
        'emergency_email',
        'area_of_interest',
        'skill_experties',
        'motivation',
        'previous_volunteer_experience',
        'start_date',
        'end_date',
        'daily_availability',
        'accomodation_required',
        'dietary_restriction',
        'medical_condition',
        'medical_description',
        'travel_insurance',
        'insurance_proof',
        'cv',
        'passport_copy',
        'visa_copy',
        'criminal_record',
        'aggrement',
        'is_scanned',
        'is_shortlisted',
        'digital_signature',
        'remarks',
    ];

        protected $casts = [
        'is_scanned' => 'boolean',
        'is_shortlisted' => 'boolean',
    ];
}
