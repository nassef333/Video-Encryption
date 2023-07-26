<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Videos extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'video',
        'title',
        'iframe',
        'noviews',
        'minutes_views',
        'type',
        'video_dauration',
        'week_id',
        'level',
    ];

    protected $casts = [
        'hashed_links' => 'array'
    ];

    public function week()
    {
        return $this->belongsTo(Weeks::class);
    }
    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_videos', 'video_id', 'user_id')->withPivot('id', 'count', 'created_at', 'updated_at')->wherePivot('deleted_at', NULL);
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
