<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiputadosLegislatura extends Model
{
    /*Por default Laravel llamaría a esta tabla diputadoslegislaturas
    y espera tener los campos de creación y modificación de registro.
    Con estas sentencias personalizamos.*/
    protected $table = 'diputadoslegislatura';
    protected $primaryKey = 'idDiputado';
    public $timestamps = false;
}
