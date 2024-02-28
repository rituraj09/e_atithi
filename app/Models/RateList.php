<?php

namespace App\Models;

use App\Models\RoomCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function roomCategory(): BelongsTo 
    {
        return $this->belongsTo(RoomCategory::class, 'room_category');
    }

    public $timestamps = false;
}
