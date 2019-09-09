<?php

namespace App\Http\Controllers;

use App\Legislador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LegisladorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claveLeg = DB::table('cat_legislaturas')
        ->orderBy('idLegislatura','desc')
        ->first();
        $numleg = (string) $claveLeg->clave;
        

        $diputados = DB::table('diputadoslegislatura')
        ->leftjoin('cat_legislaturas', 'diputadoslegislatura.idLegislatura', '=', 'cat_legislaturas.idLegislatura')
        ->leftjoin('cat_diputados', 'diputadoslegislatura.idDiputado', '=', 'cat_diputados.idDiputado')
        ->leftjoin('cat_partidospoliticos', 'diputadoslegislatura.idPartido', '=', 'cat_partidospoliticos.idPartido')
        ->leftjoin('cat_distritos', 'cat_diputados.idDistrito', '=', 'cat_distritos.idDistrito')
        ->select(
            'diputadoslegislatura.idDiputado',
            'cat_legislaturas.nombre as legislatura', 
            'cat_legislaturas.clave as numeroLegislatura', 
            DB::raw('CONCAT(cat_diputados.nombre," ",cat_diputados.paterno," ",cat_diputados.materno) as nombreDiputado'),
            DB::raw('(
                case
                    when cat_diputados.suplenteDe = 0 then "Propietario"
                    else "Suplente"
                end) as tipoDeCargo'),
            DB::raw('(
                case
                    when cat_distritos.numero = 99 then "Representación proporcional"
                    else "Mayoría relativa"
                end) as tipoDeEleccion'),
            'cat_diputados.cargo',
            'cat_diputados.foto',
            'cat_diputados.extension',
            'cat_diputados.correo',
            'cat_distritos.numero as numeroDistrito',
            DB::raw('CONCAT(cat_distritos.clave," ",cat_distritos.nombre) as nombreDistrito'),
            'cat_partidospoliticos.siglas as siglasPartido',
            'cat_partidospoliticos.nombre as nombrePartido',
            'cat_partidospoliticos.archivoimagen as logoPartido',
            )
        ->where([
            ['diputadoslegislatura.status','=',1],
            ['cat_legislaturas.clave','=',$numleg]
        ])
        ->orderBy('cat_partidospoliticos.orden')
        ->orderBy('cat_diputados.ordenNivel')
        ->orderBy('cat_diputados.paterno')
        ->get();

         return view('legisladores')
         ->with('diputados',$diputados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Legislador  $legislador
     * @return \Illuminate\Http\Response
     */
    public function show(Legislador $legislador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Legislador  $legislador
     * @return \Illuminate\Http\Response
     */
    public function edit(Legislador $legislador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Legislador  $legislador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Legislador $legislador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Legislador  $legislador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Legislador $legislador)
    {
        //
    }
}
