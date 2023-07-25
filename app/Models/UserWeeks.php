<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWeeks extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'week_id',
        'payment_method_id',
        'tranaction_code',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

}
