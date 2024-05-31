<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLogs extends Model
{
    use HasFactory;

    protected $table = "admin_logs";

    protected $fillable = [
        'activity',
        'admin_id',
        'admin_role',
        'ip_address',
    ];


    public $timestamps = false;
}
