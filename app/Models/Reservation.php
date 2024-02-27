<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'created_at',
        'reservation_no',
        'reservation_type',
        'charges_of_accommodation',
        'remarks_by_guest',
        'remarks_by_admin',
        'approved_by',
    ];

    public $timestamps = false;
}
