<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class AdmissionSubject extends BaseModel
{
    use HasFactory;

    protected $table = 'admission_subject';

    public $timestamps = false;

    protected $fillable = [
        'admission_id',
        'subject_id',
    ];
}
