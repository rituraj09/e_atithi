<?php

namespace App\Models;

use App\Models\RateList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "room_categories";

    protected $fillable = [
        'name',
        'guest_house_id',
        'created_by',
        'price_modifier',
        'is_active',
        'deleted_at',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    // public function rooms()
    // {
    //     return $this->hasMany(RateList::class,'room_category');
    // }
}
