<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atleta extends Model
{
    protected $fillable = [
    	'nombre', 'apellido', 'cedula', 'pasaporte', 'nacionalidad',
    	'correo', 'twitter', 'municipio', 'parroquia', 'telefono_movil',
    	'telefono_casa', 'pnf_id', 'lapso_inscripcion', 'disciplina_id', 
    	'fecha_nacimiento', 'lugar_nacimiento', 'tipo_sangre', 'estatura',
    	'talla_zapato', 'talla_franela', 'talla_short', 'peso', 'direccion',
    	'observaciones', 'foto_carnet'
    ];
}
