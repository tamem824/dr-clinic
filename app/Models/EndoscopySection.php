<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndoscopySection extends Model
{
    protected $fillable = [
        'endoscopy_id',
        'template_id',
        'status',
        'description',
    ];

    public function endoscopy()
    {
        return $this->belongsTo(Endoscopy::class);
    }

    public function template()
    {
        return $this->belongsTo(EndoscopyTemplate::class);
    }
}
