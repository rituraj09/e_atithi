<?php

namespace App\Models;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\RoomTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "bills";

    protected $fillable = [
        'guest_house_id',
        'proceed_by',
        'bill_no',
        'reservation_id',
        'transaction_id',
        'bill_to',
        'bill_date',
        'amount',
        'remarks',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * Get the reservation that owns the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'bill_to');
    }

}
