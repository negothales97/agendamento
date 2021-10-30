<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialistRequest extends FormRequest
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
        $unique = ($id == 'specialist') ? 'unique:specialists' : "unique:specialists,email,{$id}";
        $required = ($id == 'specialist') ? 'required' : 'nullable';
        return [
            'name' => 'required',
            'email' => "required|{$unique}",
            'password' => "{$required}|confirmed|min:6",
            'specialty_id' => 'required',
            'specialty_category_id' => 'required',
            'abstract' => 'required',
            'bank_code' => "$required|max:3",
            'agencia' => "$required|max:4",
            'agencia_dv' => 'nullable|max:1',
            'conta' => "$required|max:13",
            'conta_dv' => "$required|max:2",
            'document_number' => $required,
            'picture' => "{$required}|mimes:jpg,png,webp"
        ];
    }
}
