<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $table = 'genders';

    protected $fillable = [
        'name',
        'is_active',
        'is_delete',
        'created_at',
    ];

    public $timestamps = false;
}
