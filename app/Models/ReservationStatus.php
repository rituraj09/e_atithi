<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    use HasFactory;

    protected $table = "reservation_statuses";

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
