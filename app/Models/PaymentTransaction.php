<?php

namespace App\Models;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "payment_transactions";

    protected $fillable = [
        'payment_no',
        'bill_id',
        'transaction_id',
        'reservation_id',
        'proceed_by',
        'guest_id',
        'guest_house_id',
        'total_amount',
        'status',
        'remarks',
        'transaction_time',
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * Get the guest that owns the PaymentTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }
}
