<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPackageUser extends Model
{
    use HasFactory;
    protected $table = 'training_package_user';
    protected $fillable = [
        'training_package_id',
        'user_id',
        'remaining_sessions',
        'amount_paid',
        'payment_status',
        'payment_link_id'
    ];
}
