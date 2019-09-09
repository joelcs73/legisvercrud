<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legislatura extends Model
{
    /*Por default Laravel llamaría a esta tabla legislaturas,
    a la llave primaria la llamaría id,
    y espera tener los campos de creación y modificación de registro.
    Con estas sentencias personalizamos.*/
    protected $table = 'cat_legislaturas';
    protected $primaryKey = 'idLegislatura';
    public $timestamps = false;
}
