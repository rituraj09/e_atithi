<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "bills";

    protected $fillables = [
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

}
