<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    public function roles() {

        return $this->belongsToMany(Role::class,'role_permissions');

    }

    public function users() {

        return $this->belongsToMany(Admin::class,'user_permissions','user_id');

    }

    public function byLocale()
    {
        if (\App::getLocale() == "fr") {
            $this->name = $this->name_fr != null ? $this->name_fr : $this->name;
        }
        return $this;

    }
}
