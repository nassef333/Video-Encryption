<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolvedHomeworks extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'homework_id',
        'question_id',
        'true',
        'choosen',
    ];
}
