<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'skill_id'
    ];


    public function coverImage(){
        return asset('storage/'.$this->image);
    }

    public function isParent(){
        return !isset($this->skill_id);
    }

    public function children(){
        return self::where('skill_id', $this->id)->get();
    }

    public function services(){
        return $this->belongsToMany(UserService::class, "user_service_skills",'skill_id','user_service_id');
    }
}
