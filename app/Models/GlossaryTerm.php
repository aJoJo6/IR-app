<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// glossary term model
class GlossaryTerm extends Model
{
    protected $fillable = [
        'term',
        'definition',
    ];
}