<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestHouseImage extends Model
{
    use HasFactory;

    protected $table = "guest_house_images";

    protected $fillable = [
        'image',
        'guest_house_id',
        'is_thumb',
    ];

    public $timestamps = false;
}
