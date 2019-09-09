<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DiputadosLegislaturaController;
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
        $condiciones = [
            ['diputadoslegislatura.status','=',1],
            ['cat_legislaturas.clave','=',$numleg],
            ['cat_diputados.idDiputado', '=', $idDip]
        ];
        $diputado=$oDl->diputadosLegislaturaJson($condiciones)->first();
        return view('editalegislador')
        ->with('diputado',$diputado);
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
