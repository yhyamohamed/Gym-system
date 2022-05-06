<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use App\models\TrainingSessionUser;

class User extends Authenticatable implements MustVerifyEmail, BannableContract
{
    use HasApiTokens, HasFactory, Notifiable, Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'gender',
        'profile_image',
        'last_login_at'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function training_packages()
    {
        return $this->belongsToMany(TrainingPackage::class)->withPivot('id','remaining_sessions','amount_paid')->withTimestamps();
    }

    public function training_sessions()
    {
        return $this->belongsToMany(TrainingSession::class)->withPivot('id')->withTimestamps();
    }
    public function gym_managers(){
        return $this->hasMany(GymManager::class);
    }
    public function city_managers(){
        return $this->hasMany(CityManager::class);
    }
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

}
