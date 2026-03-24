<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
              'nombre' => 'required|max:100|unique:categorias,nombre',
            'descripcion' => 'required',
            'status'=>'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'=>'El campo nombre es obligatorio',
            'nombre.max'=>'El campo nombre no puede tener mas de 100 caracteres',
            'nombre.unique'=>'El campo nombre ya existe',
            'descripcion.required'=>'El campo descripcion es obligatorio',
            'status.required'=>'El campo estatus es obligatorio',
        ];
    }
}

