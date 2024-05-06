<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\State;
use App\Models\States;
use App\Models\Country;
use App\Models\Countries;
use App\Models\Districts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guesthouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'guesthouses';

    protected $fillable = [
        'name',
        'official_email',
        'contact_no',
        'address',
        'district',
        'state',
        'country',
        'pin',
        'guest_house_type',
        'is_active',
        'deleted_at',
    ];


    public function country_name()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function state_name()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function district_name()
    {
        return $this->belongsTo(Districts::class, 'district');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'guest_house_has_employees', 'guest_house_id', 'employee_id');
    }

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
