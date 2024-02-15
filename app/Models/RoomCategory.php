<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;

    protected $table = "room_categories";

    protected $fillable = [
        'name',
        'guest_house_id',
        'created_by',
        'is_active',
        'is_delete',
    ];

    public $timestamps = false;
}
