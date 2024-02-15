<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatables;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Laravel\Sanctum\HasApiTokens;

class Guest extends Authenticatables
{
    use HasFactory, AuthenticatableTrait, HasApiTokens;

    protected $table = 'guest';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'otp',
        'dob',
        'is_active',
        'is_delete',
        'created_at',
    ];


    public $timestamps = false;

}
