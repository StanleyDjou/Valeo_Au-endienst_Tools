<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function images(){
        return $this->morphMany(Images::class, 'imageable');
    }


    public function service(){
        return $this->belongsTo(UserService::class, 'service_id');
    }
}
