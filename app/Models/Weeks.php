<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weeks extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'course_id',
        'level',
    ];
    public function students()
     {
         return $this->belongsToMany(Users::class, 'user_weeks', 'week_id', 'user_id')->withPivot('created_at', 'id');
     }

     public function videos()
     {
         return $this->hasMany(Videos::class);
     }
     public function material()
     {
         return $this->hasMany(Materials::class);
     }
     public function quizzes()
     {
         return $this->hasMany(Quizzes::class);
     }
     public function homeworks()
     {
         return $this->hasMany(Homeworks::class);
     }
     public function solved_quizzes()
     {
         return $this->hasManyThrough(quizzes::class, questions::class);
     }
     public function courses()
     {
         return $this->belongsToMany(Course::class);
     }

}
