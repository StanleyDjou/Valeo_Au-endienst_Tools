<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'user_id',
        'title',
        'description',
        
    ];

    public function images(){
        return $this->morphMany(Images::class, 'imageable');
    }

    public function skills(){
        $skills = [];
        $user_service = UserServiceSkill::where('user_service_id', $this->id)->get();
        foreach ($user_service as $us){
            array_push($skills, $us->skill);
        }
        return $skills;
    }

    
}
