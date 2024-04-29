<?php

namespace App\Models;

use App\Models\RoomCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomCategoryHasPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "room_category_has_prices";

    protected $fillable = [
        "guest_house_id",
        "room_category_id",
        "price_modifier",
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the RoomCategoryHasPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Category(): BelongsTo
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }
}
