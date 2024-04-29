<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BedHasPriceModifier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "bed_has_price_modifiers";

    protected $fillable = [
        "bed_type",
        "guest_house_id",
        "price_modifier",
        "remarks",
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the BedHasPriceModifier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Bed(): BelongsTo
    {
        return $this->belongsTo(BedCategory::class, 'bed_type');
    }

}
