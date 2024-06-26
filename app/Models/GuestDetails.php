<?php

namespace App\Models;

use App\Models\GuestCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestDetails extends Model
{
    use HasFactory;

    protected $table = "guest_details";

    protected $fillable = [
        'guest_id',
        'guestcategory_id',
        'nationality',
        'address',
        'gender',
        'dob',
        'profile_pic',
        'id_card_number',
        'id_card_file',
        'id_card_type',
        'remarks',
    ];

    public $timestamps = false;

    /**
     * Get the user that owns the GuestDetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function guestCategory(): belongsTo
    {
        return $this->belongsTo(GuestCategories::class, 'guestcategory_id');
    }
}
