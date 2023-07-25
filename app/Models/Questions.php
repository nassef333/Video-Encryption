<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model
{
    use HasFactory, SoftDeletes;



    protected $fillable = [
        'img',
        'question',
        'level',
        'c1',
        'c2',
        'c3',
        'c4',
        'answer',
        'lesson',
        'answer_explain',
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quizzes::class, 'quiz_questions');
    }
    public function homeworks()
    {
        return $this->belongsToMany(Homeworks::class, 'homework_questions');
    }
}
