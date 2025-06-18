<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endoscopy extends Model
{
    protected $fillable = [
        'patient_id',
        'type',
        'performed_at',
        'notes',
        'attachment',
    ];

    public function sections()
    {
        return $this->hasMany(EndoscopySection::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
