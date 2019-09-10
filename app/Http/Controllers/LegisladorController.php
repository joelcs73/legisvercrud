<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DiputadosLegislaturaController;
use App\Http\Controllers\DiputadoController;
use App\Http\Controllers\DistritoController;
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
        $oDl = new DiputadosLegislaturaController();
        $claveLeg = DB::table('cat_legislaturas')
        ->orderBy('idLegislatura','desc')
        ->first();
        $numleg = (string) $claveLeg->clave;
        
        $condiciones = [
            ['diputadoslegislatura.status','=',1],
            ['cat_legislaturas.clave','=',$numleg]];
            $dips = $oDl->diputadosLegislaturaJson($condiciones);
            
            return view('legisladores')
            ->with('diputados',$dips);
        }
        
        public function mesaDirectiva(){
            $oDl = new DiputadosLegislaturaController();
            $numleg = $oDl->ultimaLegislatura();
            $condiciones = [
                ['diputadoslegislatura.status','=',1],
                ['cat_legislaturas.clave','=',$numleg],
                ['cat_diputados.cargo', 'like', '%mesa directiva%']
            ];
            $mesadirectiva=$oDl->diputadosLegislaturaJson($condiciones);
            return view('mesadirectiva')
            ->with('diputados',$mesadirectiva);
    }

    public function edita($idDip){
        $oDl = new DiputadosLegislaturaController();
        $numleg = $oDl->ultimaLegislatura();
        $condiciondiputado = [['diputadoslegislatura.status','=',1],['cat_legislaturas.clave','=',$numleg],['cat_diputados.idDiputado', '=', $idDip]];
        $condicionPropietarios = [['cat_legislaturas.clave','=',$numleg],['cat_diputados.suplenteDe','=',0]];
        $diputado=$oDl->diputadosLegislaturaJson($condiciondiputado)->first();
        $diputadosPropietarios=$oDl->diputadosLegislaturaJson($condicionPropietarios);

        if(empty($diputado)){
            return view('rutainvalida');
        }

        $oDist = new DistritoController();
        $distritos = $oDist->index();

        return view('editalegislador',
            [
                'diputado' => $diputado,
                'diputados' => $diputadosPropietarios,
                'distritos' => $distritos
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Legislador  $legislador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idDiputado)
    {
        $diputado = new DiputadoController();
        $diputado->update($request,$idDiputado);
        return redirect('legisladores');
    }


}
