<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class GymManager extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = [
      'email',
      'name',
      'password',
      'gym_id',
      'user_id',
      'NID'
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
