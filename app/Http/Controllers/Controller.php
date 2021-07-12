<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $errorMsgs = [
        'required' => '• El campo es obligatorio<br>',
        'max' => '• debe contener máximo :max digitos<br>',
        'min' => '• debe contener mínimo :min digitos<br>',
        'numeric' => '• Debe ser un número válido<br>',
        'in' => '• Opción no válida<br>',
        'unique' => '• Ya existe un registro con este valor<br>',
        'digits_between' => '• el valor de :attribute debe estar entre :min - :max digitos<br>',
        'digits' => '• El valor de :attribute debe ser de :digits digitos<br>'
    ];
    
}
