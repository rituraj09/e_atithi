<?php

namespace App\Models;

use App\Models\RateList;
use App\Models\BedCategory;
use App\Models\RoomCategory;
use App\Models\RoomCategoryHasPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rooms extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "rooms";

    protected $fillable = [
        'room_number',
        'guest_house_id',
        'base_price',
        'no_of_beds',
        'capacity',
        'room_category',
        'total_price',
        'total_govt_price',
        'width',
        'length',
        'is_active',
        'created_at',
        'deleted_at',
    ];

    public function bedType()
    {
        return $this->belongsToMany(BedCategory::class, 'room_has_beds', 'room_id', 'bed_type');
    }

    public function roomCategory(): BelongsTo
    {
        return $this->belongsTo(RoomCategoryHasPrice::class, 'room_category')->withTrashed();
    }

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}