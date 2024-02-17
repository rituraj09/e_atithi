<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class states extends Model
{
    use HasFactory;

    protected $table = "states";

    protected $fillable = [
        'country_id',
        'name',
        'state_code',
        'is_active',
        'is_delete',
    ];

    public $timestamps = false;
}
