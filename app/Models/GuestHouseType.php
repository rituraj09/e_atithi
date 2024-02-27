<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestHouseType extends Model
{
    use HasFactory;

    protected $table = "guest_house_types";

    protected $fillable = [
        'name',
        'is_active',
        'deleted_at',
    ];

    public $timestamps = false;
}
