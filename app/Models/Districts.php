<?php

namespace App\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function GuestHouse()
    {
        return $this->hasMany(Guesthouse::class);
    }

    public function state_name()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public $timestamps = false;
}
