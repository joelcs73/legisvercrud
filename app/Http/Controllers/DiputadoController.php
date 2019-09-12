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

    public function showweb()
    {   
        $oDl = new DiputadosLegislaturaController();
        $claveLeg = DB::table('cat_legislaturas')
        ->orderBy('idLegislatura','desc')
        ->first();
        $numleg = (string) $claveLeg->clave;
        
        $condiciones = [
            ['diputadoslegislatura.status','=',1],
            ['cat_legislaturas.clave','=',$numleg]];
            $dips = $oDl->distritosOcupados($condiciones);
            
            return view('/legisladores/diputadoslegislatura')
            ->with('diputados',$dips);
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
        $condiciondiputado = [['diputadoslegislatura.status','=',1],['cat_legislaturas.clave','=',$numleg],['cat_diputados.idDiputado', '=', $idDip]];
        $condicionPropietarios = [['cat_legislaturas.clave','=',$numleg],['cat_diputados.suplenteDe','=',0]];
        $diputado=$oDiputadosLegislatura->diputadosLegislaturaJson($condiciondiputado)->first();
        $diputadosPropietarios=$oDiputadosLegislatura->diputadosLegislaturaJson($condicionPropietarios);

        if(empty($diputado)){
            return view('rutainvalida');
        }

        $oDist = new DistritoController();
        $distritos = $oDist->index();

        return view('legisladores/editalegislador',
            [
                'diputado' => $diputado,
                'diputados' => $diputadosPropietarios,
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
