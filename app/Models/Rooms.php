<?php

namespace App\Models;

use App\Models\RateList;
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
        'room_rate',
        'no_of_beds',
        'capacity',
        'toilet_attached',
        'width',
        'length',
        'is_active',
        'created_at',
        'deleted_at',
    ];

    public function roomRate(): BelongsTo
    {
        return $this->belongsTo(RateList::class, 'room_rate')->withTrashed();
    }

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
