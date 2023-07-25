<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materials extends Model
{
    use HasFactory, SoftDeletes;

    public function week()
    {
        return $this->belongsTo(weeks::class);
    }
    protected $fillable = [
        'cdn',
        'week_id',
        'title'
    ];
}
