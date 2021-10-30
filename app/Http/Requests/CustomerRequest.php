<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $id = auth()->id();
        if ($id == null) {
            $id = last(request()->segments());
        }
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'cellphone' => 'required',
            'document' => 'required',
            'email' => "required|unique:customers,email,{$id}",
            'password' => 'nullable|confirmed|min:6'
        ];
    }
}
