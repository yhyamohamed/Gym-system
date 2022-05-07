<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityManager extends Model
{
    use HasFactory;

    protected $fillable=[
      
      'NID',
      'user_id'
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
