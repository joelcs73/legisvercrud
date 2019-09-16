<?php

namespace App\Http\Controllers;

use App\DiputadosLegislatura;
use App\Http\Controllers\LegislaturaController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DiputadosLegislaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oLegislatura = new LegislaturaController();
        $leg = $oLegislatura->ultimaLegislatura();
        return redirect('api/diputadoslegislatura/'.$leg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiputadosLegislatura  $diputadosLegislatura
     * @return \Illuminate\Http\Response
     */
    public function show($numleg)
    {
        $condiciones = [
            ['diputadoslegislatura.id', '!=', null]
        ];
            // $diputados=$this->diputadosLegislaturaJson($condiciones);
            // $condiciones = " diputadoslegislatura.status = 1 and cat_legislaturas.clave = '".$numleg."'";
            $diputados=$this->distritosOcupados($condiciones,$numleg);
            echo json_encode($diputados);
    }

    public function showweb()
    {   
        $oDl = new DiputadosLegislaturaController();
        $claveLeg = DB::table('cat_legislaturas')
        ->orderBy('idLegislatura','desc')
        ->first();
        $numleg = (string) $claveLeg->clave;
            $condiciones = [];
            $dips = $this->distritosOcupados($condiciones,$numleg);
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
        $diplegis = new DiputadosLegislatura();
        $diplegis->idLegislatura = $request->input('idLegislatura');
        $diplegis->idDiputado = $request->input('idDiputado');
        $diplegis->idPartido = $request->input('idPartido');
        $diplegis->status = $request->input('status');
        $diplegis->permanente = $request->input('permanente');
        $diplegis->save();
        echo json_encode($diplegis);
    }

      

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiputadosLegislatura  $diputadosLegislatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $diplegis = DiputadosLegislatura::find($id);
        $diplegis->idLegislatura = $request->input('idLegislatura');
        $diplegis->idDiputado = $request->input('idDiputado');
        $diplegis->idPartido = $request->input('idPartido');
        $diplegis->status = $request->input('status');
        $diplegis->permanente = $request->input('permanente');
        $diplegis->save();
        // echo json_encode($diplegis);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DiputadosLegislatura  $diputadosLegislatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diplegis = DiputadosLegislatura::find($id);
        $diplegis->delete();
    }

    public function distritosOcupados($condiciones,$legislatura,$status=1){
        $dl = DB::table('cat_distritos')
        ->leftjoin(DB::raw("(select diputadoslegislatura.id, diputadoslegislatura.idLegislatura, diputadoslegislatura.idDiputado,
                diputadoslegislatura.idPartido,
                diputadoslegislatura.status,
                diputadoslegislatura.permanente,
                CONCAT(cat_diputados.nombre,' ',cat_diputados.paterno,' ',cat_diputados.materno) AS nombreDiputado,
                cat_diputados.idDistrito
            FROM cat_diputados LEFT JOIN diputadoslegislatura ON cat_diputados.idDiputado = diputadoslegislatura.idDiputado
            LEFT JOIN cat_legislaturas ON cat_legislaturas.idLegislatura = diputadoslegislatura.idLegislatura
            WHERE diputadoslegislatura.status = $status and cat_legislaturas.clave = $legislatura
            ORDER BY cat_diputados.idDistrito) AS diputadoslegislatura"), 'diputadoslegislatura.idDistrito', '=', 'cat_distritos.idDistrito')
        ->leftjoin('cat_legislaturas', 'cat_legislaturas.idLegislatura', '=' ,'diputadoslegislatura.idLegislatura')
        ->leftjoin('cat_diputados','diputadoslegislatura.idDiputado','=','cat_diputados.idDiputado')
        ->leftjoin('cat_partidospoliticos', 'diputadoslegislatura.idPartido', '=', 'cat_partidospoliticos.idPartido')
        ->select(
            'diputadoslegislatura.id',
            'cat_legislaturas.idLegislatura',
            'diputadoslegislatura.idDiputado',
            'diputadoslegislatura.idPartido',
            'diputadoslegislatura.status',
            'diputadoslegislatura.permanente',
            'cat_legislaturas.nombre AS legislatura',
            'cat_legislaturas.clave AS numeroLegislatura',
            'cat_diputados.paterno',
            'cat_diputados.materno',
            'cat_diputados.nombre',
            DB::raw('CONCAT(cat_diputados.paterno," ",cat_diputados.materno," ",cat_diputados.nombre) AS nombreDiputado'),
            DB::raw('(CASE
                WHEN diputadoslegislatura.idDiputado IS NULL THEN "SIN REPRESENTACIÓN"
                WHEN cat_diputados.suplenteDe = 0 THEN "Propietario"
                ELSE "Suplente"
            END) AS tipoDeCargo'),
            DB::raw('(CASE
                WHEN diputadoslegislatura.idDiputado IS NULL THEN "SIN REPRESENTACIÓN"
                WHEN cat_distritos.numero = 99 THEN "Representación proporcional"
                ELSE "Mayoría relativa"
            END) AS tipoDeEleccion'),
            'cat_diputados.cargo',
            'cat_diputados.foto',
            'cat_diputados.extension',
            'cat_diputados.correo',
            'cat_diputados.cvPdf',
            'cat_diputados.idDistrito',
            'cat_diputados.suplenteDe',
            'cat_diputados.ordenNivel',
            'cat_distritos.numero AS numeroDistrito',
            DB::raw('CONCAT(cat_distritos.clave," ",cat_distritos.nombre) AS nombreDistrito'),
            'cat_partidospoliticos.siglas AS siglasPartido',
            'cat_partidospoliticos.nombre AS nombrePartido',
            'cat_partidospoliticos.archivoimagen AS logoPartido'
            )
        ->where($condiciones)
        ->orderBy('cat_distritos.numero')
        ->get();

        return $dl;
    }

    public function licencia($idDip){
        // código para tratar la licencia en una vista

        // Obtenemos de la tabla [diputadoslegislatura] los datos del diputado que se irá de licencia
        $oLegislatura = new LegislaturaController();
        $numleg = $oLegislatura->ultimaLegislatura();
        $condiciondiputado = [['cat_diputados.idDiputado', '=', $idDip]];
        $diputadoSale = $this->distritosOcupados($condiciondiputado,$numleg)->first();
        if(empty($diputadoSale)){ return view('rutainvalida'); }
        if($diputadoSale->status==0){ return view('rutainvalida'); }

        $diputadoEntraYaHaOcupadoCurul = true;
        if($diputadoSale->suplenteDe==0){ 
            // Aquí el diputado saliente es Propietario

            // Obtenemos el diputado que es su suplente
            $condiciondiputado = [['cat_diputados.idDiputado', '=', $diputadoSale->suplenteDe]];
            $diputadoEntra = $this->distritosOcupados($condiciondiputado,$numleg)->first();
            if(empty($diputadoEntra)){
                $diputadoEntraYaHaOcupadoCurul = false;
                $diputadoEntra = DB::table('cat_diputados')->select('cat_diputados.*')->where('suplenteDe','=',$idDip)->get()->first();
            }
        } else { 
            // Aquí el diputado saliente es Suplente
            
            // Obtenemos el diputado que es propietario
            $condiciondiputado = [['cat_diputados.idDiputado', '=', $diputadoSale->suplenteDe]];
            $diputadoEntra = $this->distritosOcupados($condiciondiputado,$numleg,0)->first();
        }
        // dd($diputadoSale,$diputadoEntra,$diputadoEntraYaHaOcupadoCurul);
        return view('legisladores/gestionalicencia',
            [
                'diputadoSale' => $diputadoSale,
                'diputadoEntra' => $diputadoEntra,
                'diputadoEntraYaHaOcupadoCurul' => $diputadoEntraYaHaOcupadoCurul
            ]
        );
    }

    public function guardalicencia(request $request){
        $idSale = $request->input('idSale');
        $idEntra = $request->input('idEntra');
        $esIntercambio = $request->input('esIntercambio');

        // Encontramos el idDiputado del saliente en la tabla diputadoslegislatura para obtener todos los datos
        $tabDipSaliente = DB::table('diputadoslegislatura')->select('diputadoslegislatura.*')->where('idDiputado','=',$idSale)->get();
        $idLegislatura = 0;
        foreach($tabDipSaliente as $dipSaliente){
            $idRegistro = $dipSaliente->id;
            $idLegislatura = $dipSaliente->idLegislatura;
            $idDipSaliente = $idSale;
            $idPartido = $dipSaliente->idPartido;
            $perm = $dipSaliente->permanente;
        }
        
        // Cambiamos el estatus del diputado saliente a 0
        $objDipSaliente = DiputadosLegislatura::find($idRegistro);
        // $objDipSaliente = new DiputadosLegislatura();
        $objDipSaliente->idLegislatura = $idLegislatura;
        $objDipSaliente->idDiputado = $idDipSaliente;
        $objDipSaliente->idPartido = $idPartido;
        $objDipSaliente->status = 0;
        $objDipSaliente->permanente = $perm;
        $objDipSaliente->save();

        if($esIntercambio==null){
            return redirect('legisladores');
        }

        // Buscamos en la tabla diputadoslegislatura el id del diputado que entrará
        $tabDipEntrante = DB::table('diputadoslegislatura')->select('diputadoslegislatura.*')->where('idDiputado','=',$idEntra)->get();
        $idRegistroEntrante=0;
        foreach($tabDipEntrante as $dipEntrante){
            $idRegistroEntrante = $dipEntrante->id;
        }
        // dd($idRegistroEntrante, $idEntra, $tabDipEntrante, empty($tabDipEntrante));
        if($idRegistroEntrante==0){
            $objDipEntrante = new DiputadosLegislatura();
        } else {
            $objDipEntrante = DiputadosLegislatura::find($idRegistroEntrante);
        }
        $objDipEntrante->idLegislatura = $idLegislatura;
        $objDipEntrante->idDiputado = $idEntra;
        $objDipEntrante->idPartido = $idPartido;
        $objDipEntrante->status = 1;
        $objDipEntrante->permanente = 0;
        $objDipEntrante->save();

        return redirect('legisladores');
    }
}
