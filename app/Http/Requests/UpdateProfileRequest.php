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
        return [
            'name' => 'required|string|min:3',
            'education_id' => 'required|integer|max:3',
            'grade_id' => 'required_unless:education_id,3|integer|max:4',
            'school' => 'required_if:education_id,1|string',
            'country' => 'required|string|max:50',
            'state' => 'required|string|max:3',
            'city_id' => 'required|integer'
        ];
    }
}
