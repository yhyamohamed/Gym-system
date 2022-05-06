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

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
