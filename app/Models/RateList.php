<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateList extends Model
{
    use HasFactory;

    protected $table = "rate_lists";

    protected $fillable = [
        'name',
        'guest_house_id',
        'room_category',
        'price',
        'is_active',
        'deleted_at',
        'created_at',
    ];

    public $timestamps = false;
}
