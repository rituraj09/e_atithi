<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guesthouse extends Model
{
    use HasFactory;

    protected $table = 'guesthouses';

    protected $fillable = [
        'name',
        'official_email',
        'contact_no',
        'address',
        'district',
        'state',
        'country',
        'pin',
        'guest_house_type',
        'is_active',
        'is_delete',
    ];


    public $timestamps = false;
}
