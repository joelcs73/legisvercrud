<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diputado extends Model
{
    /*Por default Laravel llamaría a esta tabla diputados,
    a la llave primaria la llamaría id,
    y espera tener los campos de creación y modificación de registro.
    Con estas sentencias personalizamos.*/
    protected $table = 'cat_diputados';
    protected $primaryKey = 'idDiputado';
    public $timestamps = false;
}
