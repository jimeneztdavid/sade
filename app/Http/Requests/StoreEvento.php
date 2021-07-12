<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEvento extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $user = Auth::user();
        // return $user->isAdmin;
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
            'fecha'         => 'required|date',
            'descripcion'   => 'string|required|max:255',
            'disciplina_id' => 'digits:1|required',
            'categoria_id'  => 'digits:1|required'
        ];
    }

   
}
