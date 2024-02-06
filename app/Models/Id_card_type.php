<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Id_card_type extends Model
{
    use HasFactory;

    protected $table = 'id_card_types';

    protected $fillable = [
        'name',
        'is_active',
        'is_delete',
        'created_at',
    ];

    public $timestamps = false;
}
