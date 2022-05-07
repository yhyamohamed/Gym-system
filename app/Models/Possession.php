<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Possession extends Model
{
    use HasFactory;
    protected $fillable = [
        'possession',
       
      ];
      public function users()
      {
          return $this->belongsTo(User::class);
      }
  
}
