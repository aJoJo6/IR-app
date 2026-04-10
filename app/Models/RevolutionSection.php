<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// revolution section record
class RevolutionSection extends Model
{
    use HasFactory;

    // mass assignable fields
    protected $fillable = [
        'revolution_id', // parent revolution
        'section_key',   // internal key
        'section_title', // display title
        'body',          // section content
        'image_path',    // optional image
        'sort_order',    // display order
    ];

    // parent revolution
    public function revolution()
    {
        return $this->belongsTo(Revolution::class);
    }

    //image
    public function images()
    {
        return $this->hasMany(SectionImage::class)->orderBy('sort_order')->orderBy('id');
    }
}