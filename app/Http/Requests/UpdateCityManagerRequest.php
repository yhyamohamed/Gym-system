<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCityManagerRequest extends FormRequest
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
            Rule::unique('city_managers')->ignore($this->city_manager)],
            'password'=>"min:6",
            'fileUpload'=>['nullable','image','mimes:jpg,png,jpeg'],
        ];
    }
}
