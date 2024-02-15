<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'profile_pic',
        'id_card_no',
        'id_card_type',
        'remarks',
    ];

    public $timestamps = false;
}
