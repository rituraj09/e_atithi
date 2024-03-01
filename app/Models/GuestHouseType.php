<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestHouseType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "guest_house_types";

    protected $fillable = [
        'name',
        'is_active',
        'deleted_at',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
