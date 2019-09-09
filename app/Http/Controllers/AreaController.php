<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::get();
        echo json_encode($areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = new Area();
        $area->clave = $request->input('clave');
        $area->nombre = $request->input('nombre');
        $area->responsable = $request->input('responsable');
        $area->correo = $request->input('correo');
        $area->extension = $request->input('extension');
        $area->areaPadre = $request->input('areaPadre');
        $area->apareceEnDirectorio = $request->input('apareceEnDirectorio');
        $area->idHijo = $request->input('idHijo');
        $area->archivoCurriculo = $request->input('archivoCurriculo');
        $area->orden = $request->input('orden');
        $area->save();
        echo json_encode($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idArea)
    {
        $area = Area::find($idArea);
        $area->clave = $request->input('clave');
        $area->nombre = $request->input('nombre');
        $area->responsable = $request->input('responsable');
        $area->correo = $request->input('correo');
        $area->extension = $request->input('extension');
        $area->areaPadre = $request->input('areaPadre');
        $area->apareceEnDirectorio = $request->input('apareceEnDirectorio');
        $area->idHijo = $request->input('idHijo');
        $area->archivoCurriculo = $request->input('archivoCurriculo');
        $area->orden = $request->input('orden');
        $area->save();
        echo json_encode($area);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($idArea)
    {
        $area = Area::find($idArea);
        $area->delete();
    }
}
