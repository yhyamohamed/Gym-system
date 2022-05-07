<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainingSessionUser;
use App\Models\User;

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
        return $this->belongsToMany(Coach::class)->withPivot('id')->withTimestamps();
    }

    public function training_package(){
        return $this->belongsTo(TrainingPackage::class,'training_package_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('id')->withTimestamps();
    }
    public function gyms()
    {
       if( $this->training_packages)
        return $this->training_packages->gym;
    }
}
