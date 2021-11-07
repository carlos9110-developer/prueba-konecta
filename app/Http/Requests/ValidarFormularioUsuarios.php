<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarFormularioUsuarios extends FormRequest
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
            'nombre' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'documento' => 'unique:users|required|numeric|integer|min:1111|max:9999999999',
            'correo' => 'required|email|unique:users',
            'direccion' => 'required',
            'rol' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'nombre.required'   => 'El :attribute es obligatorio.',
            'nombre.min'        => 'El :attribute debe contener por lo menos tres letras.',
            'nombre.regex'      => 'El :attribute  solo debe contener letras y espacios.',

            'documento.required'   => 'El :attribute es obligatorio.',
            'documento.unique'     => 'El :attribute ya esta registrado en la base de datos',
            'documento.min'        => 'El :attribute debe contener por lo menos cuatro digitos.',
            'documento.max'        => 'El :attribute no debe de tener más de diez digitos.',
            'documento.numeric'    => 'El :attribute  solo debe contener números.',
            'documento.integer'    => 'El :attribute  solo debe contener números.',

            'correo.required'   => 'El :attribute es obligatorio.',
            'correo.email'      => 'El :attribute debe tener formato de correo electrónico',
            'correo.unique'     => 'El :attribute ya esta registrado en la base de datos',

            'direccion.required' => 'la :attribute es obligatorio.',

            'rol.required'       => 'El :attribute es obligatorio.',

        ];
    }

    public function attributes()
    {
        return [
            'nombre'         => 'nombre de usuario',
            'documento'      => 'documento del usuario',
            'correo'         => 'correo del usuario',
            'direccion'      => 'dirección del usuario',
            'rol'            => 'rol del usuario',
        ];
    }
}
