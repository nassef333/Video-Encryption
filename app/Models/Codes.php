<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Codes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'value',
        'code',
        'admin',
    ];

    public function userWeeks()
    {
        return $this->hasMany(UserWeeks::class);
    }
}
