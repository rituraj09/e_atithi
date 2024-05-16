<?php

namespace App\Models;

use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "receipts";

    protected $fillable = [
        'guest_house_id',
        'proceed_by',
        'receipt_no',
        'reservation_id',
        'transaction_id',
        'receipt_to',
        'receipt_date',
        'amount',
        'remarks',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * Get the guest that owns the Receipt
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'receipt_to');
    }

    /**
     * Get the reservation that owns the Receipt
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

}
