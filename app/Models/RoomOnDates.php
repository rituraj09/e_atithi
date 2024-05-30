<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomOnDates extends Model
{
    use HasFactory;

    protected $table = "room_on_dates";

    protected $fillable = [
        'room_id',
        'date',
        'status',
        'reservation_id',
        'is_cancelled',
    ];

    public $timestamps = false;
}
