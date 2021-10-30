<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
            'holder_name' => 'required',
            'email' => 'required',
            "cvv" => 'required',
            'card_number' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
        ];
    }
}
