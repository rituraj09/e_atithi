<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;

    protected $tables = "districts";

    protected $fillable = [
        'state_id',
        'name',
        'district_code',
        'is_active',
        'is_delete',
    ];

    public $timestamps = false;
}
