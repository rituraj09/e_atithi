<?php

namespace App\Models;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomCategoryFeature extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "room_category_features";

    protected $fillable = [
        'feature_id',
        'room_category_id',
        'guest_house_id',
        'created_by',
        'is_active',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * Get the featureDetails that owns the RoomCategoryFeature
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function featureDetails(): BelongsTo
    {
        return $this->belongsTo(Feature::class, 'feature_id');
    }
}
