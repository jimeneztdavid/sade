<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $fillable = [
        'user_id', 'accion', 'descripcion', 'modulo', 'direccion_ip'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}