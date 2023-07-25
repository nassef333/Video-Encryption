<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'reference_id',
        'total',
        'status',
        'course_id',
        'payment_method',
        'paid_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function userWeeks()
    {
        return $this->hasMany(UserWeeks::class);
    }
    

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
