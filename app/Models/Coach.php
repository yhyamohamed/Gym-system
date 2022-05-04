<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',

    ];

    public function training_sessions(){
        return $this->belongsToMany(TrainingSession::class)->withPivot('id')->withTimestamps();
    }
}
