<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name',
        'display_order',
        'is_published',
        'have_multi_subject'
    ];

    protected $casts = [
        'is_published'      => 'boolean',
        'have_multi_subject' => 'boolean',
    ];

    /**
     * Subjects linked to this group via group_subject_faculty pivot table
     */
    public function groupSubjectFaculties()
    {
        return $this->hasMany(FacultyGroupSubject::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeDisplayOrder($query)
    {
        return $query->orderBy('display_order');
    }
}
