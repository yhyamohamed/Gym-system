<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class CityManager extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [

        'NID',
        'user_id',
        'city_name',
    ];

    public function gyms()
    {
        return $this->hasMany(Gym::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
