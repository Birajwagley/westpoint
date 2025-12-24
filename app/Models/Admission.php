<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class Admission extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'photo',
        'dob_bs',
        'dob_ad',
        'age',
        'gender',
        'other_gender',
        'permanent_address',
        'current_address',
        'nationality',
        'contact_no',
        'living_with_guardian',
        'academic_year',
        'previous_school',
        'previous_school_address',
        'pick_drop_facility_needed',
        'pick_drop_location',
        'academic_level_id',
        'is_school',
        'approval',
    ];

    /**
     * --------------------------
     * RELATIONSHIPS
     * --------------------------
     */

    // A student has many parents
    public function parents()
    {
        return $this->hasMany(AdmissionParent::class);
    }

    // A student has one school admission info
    public function school()
    {
        return $this->hasOne(AdmissionSchool::class);
    }

    // A student has one college admission info
    public function college()
    {
        return $this->hasOne(AdmissionCollege::class);
    }

    // Belongs to Academic Level
    public function academicLevel()
    {
        return $this->belongsTo(AcademicLevel::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'admission_subject', 'admission_id', 'subject_id');
    }
}
