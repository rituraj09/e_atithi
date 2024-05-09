<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $table = "features";

    protected $fillable = [
        'name',
        'description',
        'price',
        'remarks',
        'guest_house_id',
    ];

    public $timestamps = false;

}
