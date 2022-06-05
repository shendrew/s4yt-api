<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rule = [
            'name' => 'required|string|min:3',
            'education_id' => 'required|integer|max:3',
            'grade_id' => 'nullable|required|integer|max:4',
            'school' => "nullable|required|string",
        ];

        return $rule;
    }
}
