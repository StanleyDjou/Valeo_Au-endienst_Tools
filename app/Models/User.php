<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'status',
        'role',
        'email',
        'phone',
        'company',
        'website',
        'city_id',
        'region_id',
        'address',
        'password',
        'profile',
        'bio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function requests(){
        return $this->hasMany(Request::class, 'user_id');
    }
    public function portfolios(){
        return $this->hasMany(Portfolio::class, 'user_id');
    }

    public function city(){
        return $this->belongsTo(Cities::class , "city_id");
    }

    public function region(){
        return $this->belongsTo(Regions::class , "region_id");
    }

    public function skills(){
        return $this->belongsToMany(UserSkill::class , "user_skills", "user_id");
    }

    public function isAdmin(){
        return $this->admin === 1;
    }

    public function getProfilePictureAttribute(){
        return asset('storage/'.$this->profile);
    }

    public function services(){
        return $this->hasMany(UserService::class, 'user_id');
    }

    public function portfolio(){
        return $this->hasMany(Portfolio::class, 'user_id');
    }



}
