<?php

namespace App\Http\Controllers;

use App\PartidoPolitico;
use Illuminate\Http\Request;

class PartidoPoliticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partidos = PartidoPolitico::get();
        echo json_encode($partidos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $partido = new PartidoPolitico();
        $partido->siglas = $request->input('siglas');
        $partido->nombre = $request->input('nombre');
        $partido->archivoImagen = $request->input('archivoImagen');
        $partido->orden = $request->input('orden');
        $partido->save();
        echo json_encode($partido);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PartidoPolitico  $partidoPolitico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $idPartidoPolitico)
    {
        $partido = PartidoPolitico::find($idPartidoPolitico);
        $partido->siglas = $request->input('siglas');
        $partido->nombre = $request->input('nombre');
        $partido->archivoImagen = $request->input('archivoImagen');
        $partido->orden = $request->input('orden');
        $partido->save();
        echo json_encode($partido);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PartidoPolitico  $partidoPolitico
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPartidoPolitico)
    {
        $partido = Diputado::find($idPartidoPolitico);
        $partido->delete();
    }
}
