<?php

namespace App\Http\Requests;

use App\Rules\SessionConflict;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTrainingSessionRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'start_at' => ['required', 'date', new SessionConflict],
            'finish_at' => ['required', 'date', new SessionConflict],
            'training_package_id' => 'required|exists:training_packages,id',
        ];
    }
}
