<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserServiceSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_service_id',
        'skill_id'
    ];

    public function skill(){
        return $this->belongsTo(Skill::class, 'skill_id');
    }
}
