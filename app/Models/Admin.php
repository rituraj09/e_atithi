<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatables;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Admin extends Authenticatables
{
    use HasFactory, AuthenticatableTrait, HasApiTokens, HasRoles, HasPermissions;

    protected $guard_name = "web";

    protected $table = "admins";

    protected $fillable = [
        'admin_name',
        'phone',
        'email',
        'role',
        'password',
    ];

    // public function roles()
    // {
    //     return $this->belongsTo(Role::class, 'role');
    // }

    public $timestamps = false;
}
