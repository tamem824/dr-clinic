<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EndoscopyTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',          // 'upper' or 'lower'
        'section_name',  // like 'المريء', 'القولون'
        'order',         // display order
    ];

    public $timestamps = true;

    /**
     * Scope for upper type
     */
    public function scopeUpper($query)
    {
        return $query->where('type', 'upper')->orderBy('order');
    }

    /**
     * Scope for lower type
     */
    public function scopeLower($query)
    {
        return $query->where('type', 'lower')->orderBy('order');
    }
}
