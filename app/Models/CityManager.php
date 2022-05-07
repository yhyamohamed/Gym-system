<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityManager extends Model
{
    use HasFactory;

    protected $fillable=[
      'email',
      'password',
      'name',
      'avatar'
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
