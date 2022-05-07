<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymManager extends Model
{
    use HasFactory;

    protected $fillable = [
      'email',
      'name',
      'password',
      'gym_id',
      'avatar'
    ];

    public function gyms()
    {
        return $this->belongsTo(Gym::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
   
}
