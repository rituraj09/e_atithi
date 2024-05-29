<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\State;
use App\Models\States;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Countries;
use App\Models\Districts;
use App\Models\GuestHouseImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'guest_type',
        'payment_type',
        'base_price',
        'cgst',
        'sgst',
        'govt_base_price',
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

    /**
     * Get the thumbnail associated with the Guesthouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thumbnail(): HasOne
    {
        return $this->hasOne(GuestHouseImage::class, 'guest_house_id', 'id');
    }

    /**
     * Get all of the features for the Guesthouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features(): HasMany
    {
        return $this->hasMany(Feature::class, 'guest_house_id', 'id');
    }

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    // guest type = 1 = govt
    // guest type = 0 = all
}
