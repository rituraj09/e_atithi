<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomFeatures extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $dates = ['deleted_at'];
}
