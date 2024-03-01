<?php

namespace App\Models;

use App\Models\Guesthouse;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatables;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Admin extends Authenticatables
{
    use HasFactory, AuthenticatableTrait, HasApiTokens, HasRoles, HasPermissions, SoftDeletes;

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

    public function guestHouses()
    {
        return $this->belongsToMany(Guesthouse::class, 'guest_house_has_employees', 'employee_id', 'guest_house_id');
    }

    public function admin_info()
    {
        return $this->hasOne(AdminDetails::class);
    }

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
