<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'img',
        'level',
    ];


    public function students()
    {
        return $this->belongsToMany(Users::class, 'user_weeks', 'week_id', 'user_id')
                    ->wherePivot('status', true)
                    ->wherePivot('deleted_at', NULL)
                    ->withPivot('created_at', 'id');
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
    public function weeks()
    {
        return $this->belongsToMany(Weeks::class);
    }
}
