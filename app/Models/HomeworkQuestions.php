<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeworkQuestions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'homework_id',
        'question_id',
    ];
}
