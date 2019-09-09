<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartidoPolitico extends Model
{
    /*Por default Laravel llamaría a esta tabla partidospoliticos,
    a la llave primaria la llamaría id,
    y espera tener los campos de creación y modificación de registro.
    Con estas sentencias personalizamos.*/
    protected $table = 'cat_partidospoliticos';
    protected $primaryKey = 'idPartido';
    public $timestamps = false;
}
