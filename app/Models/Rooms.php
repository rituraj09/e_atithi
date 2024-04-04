<?php

namespace App\Models;

use App\Models\RateList;
use App\Models\BedCategory;
use App\Models\RoomCategory;
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
        'bed_type',
        'room_category',
        'total_price',
        'width',
        'length',
        'is_active',
        'created_at',
        'deleted_at',
    ];

    public function bedType(): BelongsTo
    {
        return $this->belongsTo(BedCategory::class, 'bed_type')->withTrashed();
    }

    public function roomCategory(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class, 'room_category')->withTrashed();
    }

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
