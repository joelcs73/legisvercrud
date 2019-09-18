<?php

namespace App\Http\Controllers;

use App\JuntaTrabajosLegislativos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JuntaTrabajosLegislativosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oLegislatura = new LegislaturaController();
        $oDiputadosLegislatura = new DiputadosLegislaturaController();
        $numleg = $oLegislatura->ultimaLegislatura();
        $condiciones = 'cat_diputados.ordenNivel = 0 or cat_diputados.ordenNivel = 1 or cat_diputados.ordenNivel = 4';
        $oDiputadosLegislatura->setOrderBy('cat_partidospoliticos.orden, cat_diputados.ordenNivel');
        $mesadirectiva=$oDiputadosLegislatura->distritosOcupados($condiciones,$numleg);
        echo json_encode($mesadirectiva);
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
     * @param  \App\JuntaTrabajosLegislativos  $juntaTrabajosLegislativos
     * @return \Illuminate\Http\Response
     */
    public function show(JuntaTrabajosLegislativos $juntaTrabajosLegislativos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JuntaTrabajosLegislativos  $juntaTrabajosLegislativos
     * @return \Illuminate\Http\Response
     */
    public function edit(JuntaTrabajosLegislativos $juntaTrabajosLegislativos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JuntaTrabajosLegislativos  $juntaTrabajosLegislativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JuntaTrabajosLegislativos $juntaTrabajosLegislativos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JuntaTrabajosLegislativos  $juntaTrabajosLegislativos
     * @return \Illuminate\Http\Response
     */
    public function destroy(JuntaTrabajosLegislativos $juntaTrabajosLegislativos)
    {
        //
    }
}
