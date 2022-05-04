<?php

namespace App\Rules;

use App\Models\TrainingSession;
use Illuminate\Contracts\Validation\Rule;

class SessionDate implements Rule
{
    
    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
      return TrainingSession::find($value)->start_at->isToday();
    }

    public function message()
    {
        return 'appointment has passed';
    }
}
