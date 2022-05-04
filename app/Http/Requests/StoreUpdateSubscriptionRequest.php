<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'training_package_id' => 'required|exists:training_packages,id',
            'user_id' => 'required|exists:users,id',
            'ammount_paid' => 'required|numeric',
            'remaining_sessions' => 'required|numeric',
        ];
    }
}
