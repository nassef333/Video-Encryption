<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quizzes extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'week_id',
        'title',
        'minutes',
        'degree',
        'mindegree',
        'start',
        'end',
        'noquestions',
        'answerTime',
        'prize',
        'prizeDegree',
        'level',
        'cdn',
    ];


    
    public function week()
    {
        return $this->belongsTo(Weeks::class,);
    }
    public function users()
     {
         return $this->belongsToMany(Users::class, 'user_quizzes')->withPivot('score', 'id')->withPivot('id', 'created_at', 'updated_at')->wherePivot('deleted_at', NULL);
     }

     public function questions()
     {
         return $this->belongsToMany(Questions::class, 'quiz_questions')->withPivot('degree');
     }
}
