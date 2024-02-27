<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRoom extends Model
{
    use HasFactory;

    protected $table = "reservation_rooms";

    protected $fillable = [
        'reservation_id',
        'room_id',
        'created_at',
    ];

    public $timestamps = false;
}
