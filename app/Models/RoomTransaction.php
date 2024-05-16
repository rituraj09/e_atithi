<?php

namespace App\Models;

use App\Models\Rooms;
use App\Models\Reservation;
use App\Models\ReservationRoom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "room_transactions";

    protected $fillable = [
        'transaction_id',
        'reservation_no',
        'checked_in_date',
        'checked_in_time',
        'checked_out_date',
        'checked_out_time',
        'room_id',
        'guest_house_id',
        'proceed_by',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * Get the room that owns the RoomTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservedRooms(): BelongsTo
    {
        return $this->belongsTo(ReservationRoom::class, 'room_id');
    }

    public function reservationDetails(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_no');
    }

}
