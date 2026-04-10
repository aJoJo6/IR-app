<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionImage extends Model
{
    protected $fillable = [
        'revolution_section_id',
        'image_path',
        'caption',
        'sort_order',
    ];

    public function section()
    {
        return $this->belongsTo(RevolutionSection::class, 'revolution_section_id');
    }
}