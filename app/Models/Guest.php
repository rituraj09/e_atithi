<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Guest extends AuthenticatableUser implements Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'guest';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'otp',
        'dob',
        'is_active',
        'created_at',
    ];

    public $timestamps = false;
}
