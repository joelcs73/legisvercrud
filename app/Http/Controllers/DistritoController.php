<?php

namespace App\Http\Controllers;

use App\Distrito;
use Illuminate\Http\Request;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distritos = Distrito::get();
        echo json_encode($distritos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $distrito = new Distrito();
        $distrito->clave = $request->input('clave');
        $distrito->numero = $request->input('numero');
        $distrito->nombre = $request->input('nombre');
        $distrito->vigente = $request->input('vigente');
        $distrito->save();
        echo json_encode($distrito);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idDistrito)
    {
        $distrito = Distrito::find($idDistrito);
        $distrito->clave = $request->input('clave');
        $distrito->numero = $request->input('numero');
        $distrito->nombre = $request->input('nombre');
        $distrito->vigente = $request->input('vigente');
        $distrito->save();
        echo json_encode($distrito);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distrito  $distrito
     * @return \Illuminate\Http\Response
     */
    public function destroy($idDistrito)
    {
        $distrito = Distrito::find($idDistrito);
        $distrito->delete();    }
}
