<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trip_id',
        'role',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trip(){
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
