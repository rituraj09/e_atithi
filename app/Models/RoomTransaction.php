<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

}
