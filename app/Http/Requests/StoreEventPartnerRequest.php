<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventPartnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => 'string',
            'short_description' => 'string',
            'description' => 'text',
            'meet_day' => 'date',
            'meet_from' => 'string|max:5',
            'meet_to' => 'string|max:5',
            'meet_link' => 'string',
            'awards_confirmed' => 'integer',
            'youtube_link' => 'string',
            'active' => 'boolean',
            'step' => 'integer'
        ];
    }
}
