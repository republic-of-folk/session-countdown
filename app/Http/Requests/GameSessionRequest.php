<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameSessionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => [
                'string',
                'required'
            ],
            'event_date' => [
                'date',
                'required'
            ]
        ];
    }
}
