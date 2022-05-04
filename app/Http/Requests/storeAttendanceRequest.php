<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CanAttend;
use App\Rules\SessionDate;

class storeAttendanceRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'training_session_id' => ['required', 'exists:training_sessions,id',new SessionDate],
            'user_id' => ['required', 'exists:users,id', new CanAttend],
        ];
    }
    public function messages()
    {
        return [
            'training_session_id.required' => 'A ID is required',
            'training_session_id.date_equals' => 'the apointment has passed',
        ];
    }
}
