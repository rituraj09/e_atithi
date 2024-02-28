<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $table = "rooms";

    protected $fillable = [
        'room_number',
        'guest_house_id',
        'room_type',
        'no_of_beds',
        'capacity',
        'toilet_attached',
        'width',
        'length',
        'is_active',
        'deleted_at',
    ];

    public $timestamps = false;
}
