<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\TrainingSessionUser;
use App\models\User;

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
    protected $dates = [
        'created_at',
        'updated_at',
        'start_at',
        'finish_at'
    ];
    


    public function coaches(){
        return $this->belongsToMany(Coach::class);
    }

    public function training_package(){
        return $this->belongsTo(TrainingPackage::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(TrainingSessionUser::class);
    }
}
