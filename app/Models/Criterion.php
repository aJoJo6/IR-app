<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// criterion model
class Criterion extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];
}