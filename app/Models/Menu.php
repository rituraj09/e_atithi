<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";

    protected $fillable = [
        'level',
        'level_under_id',
        'menu',
        'serial',
        'roll_id',
        'preference_setting',
    ];

    public $timestamps = false;
}
