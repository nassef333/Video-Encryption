<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'video_id',
        'user_id',
        'comment',
        'img',
        'parent_comment',
    ];

    public function video()
    {
        return $this->belongsTo(Videos::class);
    }
    public function replies()
     {
        // return "hamadaaa";
         return $this->hasMany(Replies::class);
     }
}
