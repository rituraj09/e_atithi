<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestsLogs extends Model
{
    use HasFactory;

    protected $table = 'guest_logs';

    protected $fillable = [
        'activity',
        'guest_id',
        'ip_address',
        'is_active',
        'is_delete',
    ];

    public $timestamps = false;
}
