<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name','slug',
    ];

    public function permissions() {

        return $this->belongsToMany(Permissions::class,'role_permissions');

    }

    public function permissionsR() {

        return $this->hasMany(RolePermission::class,'role_id');

    }

    public function users() {

        return $this->belongsToMany(Admin::class,'user_roles', 'role_id','user_id');
    }

    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;

    }
}
