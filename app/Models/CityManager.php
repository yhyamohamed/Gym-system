<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class CityManager extends Model
{
    use HasFactory,HasRoles;

    protected $fillable=[
      'email',
      'password',
      'name',
      'user_id',
      'NID'
    ];

    public function gyms()
    {
        return $this->hasMany(Gym::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
