<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\TrainingPackageUser;

class CanAttend implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

 
    public function passes($attribute, $value)
    {
        $user_subscription = TrainingPackageUser::find($value)->first();
        return $user_subscription->amount_paid > 0 && $user_subscription->remaining_sessions > 0;
    }

    public function message()
    {
        return 'you need to buy a package.';
    }
}
