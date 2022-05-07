<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGymManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>"required",
            'email'=>["required","unique:users,email"],
            'password'=>"min:6",
            'gym_id' =>"required",
            'confirmation_password'=>'required|same:password|min:6',
            'NID'=> "required",

        ];
    }

    public function messages(){
        return [
            'password.required' => 'you must enter password at least 6 characters and numbers',
            'confirmation_password.required' => 'The confirmation password must match the password',

        ];
    }
}
