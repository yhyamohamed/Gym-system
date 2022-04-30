<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'start_at',
        'finish_at',
        'gym_id',
        'training_package_id'
        
    ];

    public function gym(){
        return $this->belongsTo(Gym::class);
    }

    public function coaches(){
        return $this->belongsToMany(Coach::class);
    }

    public function training_package(){
        return $this->belongsTo(TrainingPackage::class);
    }

}
