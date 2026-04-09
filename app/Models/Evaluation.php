<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// evaluation model
class Evaluation extends Model
{
    protected $fillable = [
        'revolution',
        'criterion',
        'value',
    ];
}