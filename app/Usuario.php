<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /*Por default Laravel llamaría a esta tabla usuarios,
    a la llave primaria la llamaría id,
    y espera tener los campos de creación y modificación de registro.
    Con estas sentencias personalizamos.*/
    protected $table = 'admusuarios';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;
}
