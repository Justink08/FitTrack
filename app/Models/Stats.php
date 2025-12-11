<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    protected $fillable = [
        'weight',
        'height',
        'age',
        'gender',
        'daily_calorie_goal',
        'daily_protein_goal'
    ];
}
