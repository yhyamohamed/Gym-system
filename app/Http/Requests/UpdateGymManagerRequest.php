<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateGymManagerRequest extends FormRequest
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
    {   dd($this->request->email);
        return [
            'name'=>"required",
            'email'=>["required",Rule::unique('users')->ignore($this->request)],
            'password'=>"min:6",
            'fileUpload'=>['nullable','image','mimes:jpg,png,jpeg'],
        ];
    }
}
