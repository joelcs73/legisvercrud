<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    /*Por default Laravel llamaría a esta tabla distritos,
    a la llave primaria la llamaría id,
    y espera tener los campos de creación y modificación de registro.
    Con estas sentencias personalizamos.*/
    protected $table = 'cat_distritos';
    protected $primaryKey = 'idDistrito';
    public $timestamps = false;
}
