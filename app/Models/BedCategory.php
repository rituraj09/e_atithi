<?php

namespace App\Models;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BedCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "bed_categories";

    protected $fillable = [
        "name",
        "capacity",
        "price_modifier",
        "remarks",
        "guest_house_id"
    ];

    public function rooms()
    {
        return $this->belongsToMany(Rooms::class, 'room_has_beds', 'bed_type', 'room_id');
    }

    public $timestamps = false;
}
