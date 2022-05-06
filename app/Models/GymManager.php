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

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
