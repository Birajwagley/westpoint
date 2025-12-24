<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_id',
        'relation',
        'name',
        'occupation',
        'contact_no',
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }
}
