<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ValidarFormularioClientesEditar extends FormRequest
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

    public function rules(Request $request)
    {
        return [
            'nombre' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'documento' => 'required|numeric|integer|min:1111|max:9999999999|unique:clientes,documento,'.$request->id.'',
            'correo' => 'required|email|unique:clientes,correo,'.$request->id.'',
            'direccion' => 'required',
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

        ];
    }

    public function attributes()
    {
        return [
            'nombre'         => 'nombre del cliente',
            'documento'      => 'documento del cliente',
            'correo'         => 'correo del cliente',
            'direccion'      => 'dirección del cliente',
        ];
    }

}
