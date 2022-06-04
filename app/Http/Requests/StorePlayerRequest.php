<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
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
           "email" => "required|string|email|unique:users,email",
           "education" => "required|numeric",
           "institution" => "required_if:education,1|string",
           "grade" => "required|numeric|min:1",
           "country" => "required|string",
           "state" => "required|string",
           "city" => "required|string",
           "role" => "required|string"
        ];
    }
}
