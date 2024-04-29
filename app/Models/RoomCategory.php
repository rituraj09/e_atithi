<?php

namespace App\Models;

use App\Models\RateList;
use App\Models\RoomCategoryHasPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "room_categories";

    protected $fillable = [
        'name',
        'guest_house_id',
        'created_by',
        // 'price_modifier',
        'is_active',
        'deleted_at',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function Price(): HasOne
    {
        return $this->hasOne(RoomCategoryHasPrice::class,'room_category_id','id');
    }

    /**
     * Get the user associated with the RoomCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function user(): HasOne
    // {
    //     return $this->hasOne(User::class, 'foreign_key', 'local_key');
    // }
}
