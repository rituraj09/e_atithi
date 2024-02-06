<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCategories extends Model
{
    use HasFactory;

    protected $table = 'guest_categories';

    protected $fillable = [
        'name',
        'is_active',
        'is_delete',
    ];

    public $timestamps = false;
}
