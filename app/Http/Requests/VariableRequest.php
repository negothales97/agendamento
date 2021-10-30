<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariableRequest extends FormRequest
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
            'mins_available_after_closing' => 'required',
            'tolerance_mins' => 'required',
            'percentage' => 'required',
            'chargeback_1' => 'required',
            'chargeback_2' => 'required',
            'chargeback_3' => 'required',
            'chargeback_4' => 'required',
        ];
    }
}
