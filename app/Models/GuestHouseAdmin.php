<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestHouseAdmin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "guest_house_admins";

    protected $fillable = [
        'name',
        'password',
        'email',
        'phone',
        'role',
        'is_active',
        'deleted_at',
    ];

    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    protected $dates = ['deleted_at'];
}
