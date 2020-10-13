<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'name' => 'required',
            'last_name' => 'required',
            'identification' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'identification.required' => 'La identificación es obligatoria.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe ser un email válido.',
            'phone.required' => 'El celular es obligatorio.',
            'city.required' => 'Debe escoger una ciudad de la lista de autocompletado.',
        ];
    }
}
