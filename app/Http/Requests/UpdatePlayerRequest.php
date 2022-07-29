<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
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
            "name" => "required|string",
            "email" => "required|string|email",
            "education" => "required|numeric|exists:education,id",
            "institution" => "required_if:education,1",
            "grade" => "required|numeric|exists:grades,id",
            "country_iso" => "required|string",
            "state" => "required|string",
            "city" => "required|string",
            "role" => "required|string|exists:roles,name"
        ];
    }
}
