<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $table = "accommodations";

    protected $fillable = [
        'checkin_no',
        'reservation_id',
        'room_id',
        'reservation_type',
        'rate_list_id',
        'purpose_of_visit',
        'status',
        'remarks',
        'created_by',
        'is_active',
        'checkin_at',
        'deleted_at',
    ];
}
