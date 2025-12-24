<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class AdmissionCollege extends BaseModel
{
    use HasFactory;

    protected $table = 'admission_college';

    protected $fillable = ['faculty_id', 'gpa', 'board'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    // Many subjects
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'admission_subject', 'admission_id', 'subject_id');
    }

    // Reverse link to Admission (optional if you add admission_id later)
    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }
}
