<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyRequest extends FormRequest
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
        $id = last(request()->segments());
        $required = ($id == 'specialty') ? 'required' : "nullable";
        return [
            'name' => 'required',
            'icon' => "{$required}|mimes:jpg,png,webp",
            'background_image' => "{$required}|mimes:jpg,png,webp",
            'background' => 'required',
        ];
    }
}
