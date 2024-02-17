<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class countries extends Model
{
    use HasFactory;

    protected $table = "countries";

    protected $fillable = [
        'name',
        'country_code',
        'is_active',
        'is_delete',
    ];

    public $timestamps = false;
}
