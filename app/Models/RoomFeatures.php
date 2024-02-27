<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFeatures extends Model
{
    use HasFactory;

    protected $table = "room_features";

    protected $fillable = [
        'room_id',
        'name',
        'description',
        'price',
        'remarks',
        'created_by',
        'is_active',
        'created_at',
        'deleted_at',
    ];

    public $timestamps = false;
}
