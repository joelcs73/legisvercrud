<?php

namespace App\Http\Controllers;

use App\Legislatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LegislaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $legislaturas = Legislatura::get();
        echo json_encode($legislaturas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $legislatura = new Legislatura();
        $legislatura->clave = $request->input('clave');
        $legislatura->nombre = $request->input('nombre');
        $legislatura->inicio = $request->input('inicio');
        $legislatura->fin = $request->input('fin');
        $legislatura->no_axos = $request->input('no_axos');
        $legislatura->save();
        echo json_encode($legislatura);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Legislatura  $legislatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idLegislatura)
    {
        $legislatura = Legislatura::find($idLegislatura);
        $legislatura->clave = $request->input('clave');
        $legislatura->nombre = $request->input('nombre');
        $legislatura->inicio = $request->input('inicio');
        $legislatura->fin = $request->input('fin');
        $legislatura->no_axos = $request->input('no_axos');
        $legislatura->save();
        echo json_encode($legislatura);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Legislatura  $legislatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($idLegislatura)
    {
        $legislatura = Legislatura::find($idLegislatura);
        $legislatura->delete();
    }

    public function ultimaLegislatura(){
        $claveLeg = DB::table('cat_legislaturas')
        ->orderBy('idLegislatura','desc')
        ->first();
        $leg = (string) $claveLeg->clave;
        return $leg;
    }
}
