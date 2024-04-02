<?php

namespace App\Models;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function roomDetails () : BelongsTo 
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
}
