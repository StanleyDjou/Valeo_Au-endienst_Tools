<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permissions\HasPermissionsTrait;


class UserRole extends Authenticatable
{
    public $table = "user_roles";

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
