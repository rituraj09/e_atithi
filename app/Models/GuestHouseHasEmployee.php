<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestHouseHasEmployee extends Model
{
    use HasFactory;

    protected $table = "guest_house_has_employees";

    protected $fillable = [
        'guest_house_id',
        'employee_id',
    ];

    public $timestamps = false;
}
