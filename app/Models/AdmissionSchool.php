<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class AdmissionSchool extends BaseModel
{
    use HasFactory;

    protected $table = 'admission_school';

    protected $fillable = [
        'admission_id',
        'admission_type',
        'class_id',
        'last_class_id',
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function lastClass()
    {
        return $this->belongsTo(Classes::class, 'last_class_id');
    }
}
