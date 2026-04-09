<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// revolution record
class Revolution extends Model
{
    use HasFactory;

    // mass assignable fields
    protected $fillable = [
        'slug',        // public id
        'label',       // short label
        'title',       // full title
        'years',       // date range
        'summary',     // short summary
        'hero_image',  // optional image
    ];

    // related sections
    public function sections()
    {
        return $this->hasMany(RevolutionSection::class)->orderBy('sort_order');
    }
}