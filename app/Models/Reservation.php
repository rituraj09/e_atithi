<?php

namespace App\Models;

use App\Models\Guest;
use App\Models\ReservationRoom;
use App\Models\ReservationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $table = "reservations";

    protected $fillable = [
        'guest_id',
        'guest_house_id',
        'check_in_date',
        'check_out_date',
        'no_of_room_required',
        'occupency',
        'docs',
        'status',
        'remarks',
        'check_in_id',  
        'reservation_no',
        'reservation_type',
        'charges_of_accomodation',
        'remarks_by_guest',
        'remarks_by_admin',
        'approved_by',
        'request_date',
        'cancellation_by_guest_date',
        'cancellation_by_admin_date',
        'approval_date'
    ];

    public $timestamps = false;

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function guestHouse(): BelongsTo
    {
        return $this->belongsTo(Guesthouse::class, 'guest_house_id');
    }

    public function getStatus(): BelongsTo
    {
        return $this->belongsTo(ReservationStatus::class, 'status');
    }

    public function hasRooms () : HasMany
    {
        return $this->hasMany(ReservationRoom::class, 'reservation_id', 'reservation_no');
    }
}
