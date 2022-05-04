<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email'=>["required",
            Rule::unique('users')->ignore($this->user)],
            'password'=>"min:6",
            'date_of_birth'=>"required",
            'fileUpload'=>['nullable','image','mimes:jpg,png,jpeg'],
        ];
    }
}
