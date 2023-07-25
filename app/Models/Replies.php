<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Replies extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reply',
        'comment_id',
        'img',
        'user_id'
    ];

    public function comment()
     {
         return $this->belongsTo(Comments::class);
     }

}
