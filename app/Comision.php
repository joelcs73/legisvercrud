<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    /*Por default Laravel llamaría a esta tabla comisiones,
    a la llave primaria la llamaría id,
    y espera tener los campos de creación y modificación de registro.
    Con estas sentencias personalizamos.*/
    protected $table = 'cat_comisiones';
    protected $primaryKey = 'idComision';
    public $timestamps = false;
}
