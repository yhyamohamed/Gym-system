<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TrainingSessionUser extends Pivot
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'training_session_id' 
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
}
