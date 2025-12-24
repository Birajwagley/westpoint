<?php

namespace App\Models;

use App\Models\BaseModel;

class Subject extends BaseModel
{
    protected $table = 'subjects';

    protected $fillable = [
        'name_en',
        'name_np',
        'display_order',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Pivot table: group_subject_faculty
     */
    public function groupSubjectFaculties()
    {
        return $this->hasMany(FacultyGroupSubject::class);
    }

    /**
     * Faculties related to this subject via pivot
     */
    public function faculties()
    {
        return $this->belongsToMany(
            Faculty::class,
            'group_subject_faculty',
            'subject_id',
            'faculty_id'
        );
    }

    public function facultyGroupSubject()
    {
        return $this->hasMany(FacultyGroupSubject::class, 'subject_id', 'id');
    }

    public function groups()
    {
        return $this->hasManyThrough(
            Group::class,
            FacultyGroupSubject::class,
            'subject_id',
            'id',
            'id',
            'group_id'
        );
    }

    public function admissions()
    {
        return $this->belongsToMany(Admission::class, 'admission_subject', 'subject_id', 'admission_id');
    }
}
