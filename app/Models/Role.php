<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";

    protected $fillable = [
        'name',
        'guard_name',
        'role_group',
    ];

    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    public $timestamps = false;
}
