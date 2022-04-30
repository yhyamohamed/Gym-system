<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPackage extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'price',
        'total_session',
        'gym_id'
    ];

    public function gym(){
        return $this->belongsTo(Gym::class);
    }

    public function training_sessions(){
        return $this->hasMany(TrainingSession::class);
    }
}
