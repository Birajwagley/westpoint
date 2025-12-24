<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyGroupSubject extends Model
{
    protected $table = 'group_subject_faculty';
    protected $fillable = ['group_id', 'faculty_id', 'subject_id'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }
}
