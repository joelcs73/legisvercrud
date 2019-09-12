<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DiputadosLegislaturaController;
use App\Http\Controllers\LegislaturaController;

class MesadirectivaController extends Controller
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
        $condiciones = [
            ['diputadoslegislatura.status','=',1],
            ['cat_legislaturas.clave','=',$numleg],
            ['cat_diputados.cargo', 'like', '%mesa directiva%']
        ];
        $mesadirectiva=$oDiputadosLegislatura->diputadosLegislaturaJson($condiciones);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
            $oLegislatura = new LegislaturaController();
            $oDiputadosLegislatura = new DiputadosLegislaturaController();
            $numleg = $oLegislatura->ultimaLegislatura();
            $condiciones = [
                ['diputadoslegislatura.status','=',1],
                ['cat_legislaturas.clave','=',$numleg],
                ['cat_diputados.cargo', 'like', '%mesa directiva%']
            ];
            $mesadirectiva=$oDiputadosLegislatura->diputadosLegislaturaJson($condiciones);
            return view('/legisladores/mesadirectiva')
            ->with('diputados',$mesadirectiva);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
