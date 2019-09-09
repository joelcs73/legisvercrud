<?php

namespace App\Http\Controllers;

use App\Comision;
use Illuminate\Http\Request;

class ComisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comisiones = Comision::get();
        echo json_encode($comisiones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comision = new Comision();
        $comision->nombre = $request->input('nombre');
        $comision->tipo = $request->input('tipo');
        $comision->status = $request->input('status');
        $comision->icono = $request->input('icono');
        $comision->correo = $request->input('correo');
        $comision->archivoProgramaAnual = $request->input('archivoProgramaAnual');
        $comision->save();
        echo json_encode($comision);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idComision)
    {
        $comision = Comision::find($idComision);
        $comision->nombre = $request->input('nombre');
        $comision->tipo = $request->input('tipo');
        $comision->status = $request->input('status');
        $comision->icono = $request->input('icono');
        $comision->correo = $request->input('correo');
        $comision->archivoProgramaAnual = $request->input('archivoProgramaAnual');
        $comision->save();
        echo json_encode($comision);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy($idComision)
    {
        $comision = Comision::find($idComision);
        $comision->delete();
    }
}
