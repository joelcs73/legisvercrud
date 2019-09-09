<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /*Por default Laravel llamaría a esta tabla areas,
    a la llave primaria la llamaría id,
    y espera tener los campos de creación y modificación de registro.
    Con estas sentencias personalizamos.*/
    protected $table = 'cat_areas';
    protected $primaryKey = 'idArea';
    public $timestamps = false;
}
