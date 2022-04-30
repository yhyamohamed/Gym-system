<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'creator',
        'cover_img',
        'city',
        'city_manager_id',
    ];

    public function city_manager(){
        return $this->belongsTo(CityManager::class);
    }

    public function training_sessions(){
        return $this->hasMany(TrainingSession::class);
    }

    public function gym_managers(){
        return $this->hasMany(GymManager::class);
    }
    public function training_packages(){
        return $this->hasMany(TrainingPackage::class);
    }



}

