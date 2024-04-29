<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomHasBed extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "room_has_beds";

    protected $fillable = [
        "room_id",
        "bed_type",
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
