<?php

namespace App\Http\Controllers;

use App\Diputado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiputadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diputados = Diputado::get();

        // $diputados = DB::table('admmenu')
        // ->leftJoin('admusuariomenu', 'admmenu.idMenu', '=', 'admusuariomenu.idMenu')
        // ->select('admmenu.idDiv', 'admmenu.paginaHref', 'admmenu.tituloMenu','admmenu.iconoDelMenu')
        // ->get();

        echo json_encode($diputados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diputado = new Diputado();
        $diputado->nombre = $request->input('nombre');
        $diputado->paterno = $request->input('paterno');
        $diputado->materno = $request->input('materno');
        $diputado->extension = $request->input('extension');
        $diputado->cargo = $request->input('cargo');
        $diputado->correo = $request->input('correo');
        $diputado->foto = $request->input('foto');
        $diputado->cvPdf = $request->input('cvPdf');
        $diputado->idDistrito = $request->input('idDistrito');
        $diputado->suplenteDe = $request->input('suplenteDe');
        $diputado->save();
        echo json_encode($diputado);
    }

    public function show($idDiputado){
        $diputado = Diputado::find($idDiputado);
        return $diputado;
        // echo json_encode($diputado);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diputado  $diputado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idDiputado)
    {
        $diputado = Diputado::find($idDiputado);
        $diputado->nombre = $request->input('nombre');
        $diputado->paterno = $request->input('paterno');
        $diputado->materno = $request->input('materno');
        $diputado->extension = $request->input('extension');
        $diputado->cargo = $request->input('cargo');
        $diputado->correo = $request->input('correo');
        $diputado->foto = $request->input('foto');
        $diputado->cvPdf = $request->input('cvPdf');
        $diputado->idDistrito = $request->input('idDistrito');
        $diputado->suplenteDe = $request->input('suplenteDe');
        $diputado->save();
        // echo json_encode($diputado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diputado  $diputado
     * @return \Illuminate\Http\Response
     */
    public function destroy($idDiputado)
    {
        $diputado = Diputado::find($idDiputado);
        $diputado->delete();
    }

    public function edita($idDip){
        $oLegislatura = new LegislaturaController();
        $oDiputadosLegislatura = new DiputadosLegislaturaController();
        $numleg = $oLegislatura->ultimaLegislatura();
        $condiciondiputado = [['cat_diputados.idDiputado', '=', $idDip]];
        $condicionPropietarios = [['cat_diputados.suplenteDe','=',0]];

        $diputado=$oDiputadosLegislatura->distritosOcupados($condiciondiputado,$numleg)->first();
        $diputadosPropietarios=$oDiputadosLegislatura->distritosOcupados($condicionPropietarios,$numleg,0);

        if(empty($diputado)){
            return view('rutainvalida');
        }

        $oDist = new DistritoController();
        $distritos = $oDist->index();
        
        // dd($diputado);
        return view('legisladores/editalegislador',
            [
                'diputado' => $diputado,
                'diputadosPropietarios' => $diputadosPropietarios,
                'distritos' => $distritos
            ]
        );
    }

    public function actualiza(Request $request, $idDiputado)
    {
        $this->update($request,$idDiputado);
        return redirect('legisladores');
    }
}
