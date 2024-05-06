<?php

namespace App\Models;

// use App\Models\Guesthouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $table = "countries";

    protected $fillable = [
        'name',
        'country_code',
        'is_active',
        'is_delete',
    ];

    public function GuestHouse(): HasMany
    {
        return $this->hasMany(Guesthouse::class);
    }

    public $timestamps = false;
}
