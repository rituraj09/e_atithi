<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDetails extends Model
{
    use HasFactory;

    protected $table = "admin_details";

    protected $fillable = [
        'admin_id',
        'nationality',
        'address',
        'gender',
        'dob',
        'profile_pic',
        'remarks',
    ];

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public $timestamps = false;
}
