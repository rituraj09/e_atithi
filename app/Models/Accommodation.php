<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accommodation extends Model
{
    use HasFactory, SoftDeletes;

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

    public $timestamp = false;

    protected $dates = ['deleted_at'];
}
