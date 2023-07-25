<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public function weeks()
     {
         return $this->belongsToMany(Course::class, 'user_weeks', 'user_id', 'week_id');
     }
     public function codes()
     {
         return $this->hasMany(Codes::class);
     }
     public function quizzes()
     {
         return $this->belongsToMany(Quizzes::class, 'user_quizzes')->withPivot(['score', 'created_at', 'updated_at']);
     }
     public function homeworks()
     {
        return $this->belongsToMany(Homeworks::class, 'user_homeworks')->withPivot(['created_at', 'updated_at']);
    }
     public function videos()
     {
         return $this->belongsToMany(Videos::class, 'user_videos');
     }
     
     public function solved_quizzes()
     {
         return $this->hasManyThrough(Quizzes::class, questions::class);
     }
     public function solved_homeworks()
     {
         return $this->hasManyThrough(homeworks::class, questions::class);
     }
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'pphone',
        'government',
        'level',
        'approved',
        'role',
        'balance',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
