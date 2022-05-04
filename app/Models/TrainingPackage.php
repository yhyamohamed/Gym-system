<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\User;

class TrainingPackage extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'price',
        'total_sessions',
        'gym_id'
    ];
    
    public function gym(){
        return $this->belongsTo(Gym::class);
    }

    public function training_sessions(){
        return $this->hasMany(TrainingSession::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('id','remaining_sessions','amount_paid')->withTimestamps();
    }

}
