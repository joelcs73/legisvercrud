<?php

namespace App\Http\Controllers;

use App\DiputadosLegislatura;
use App\Diputado;
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
        $leg = $this->ultimaLegislatura();
        return redirect('api/diputadoslegislatura/'.$leg);
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
     * Display the specified resource.
     *
     * @param  \App\prueba  $prueba
     * @return \Illuminate\Http\Response
     */
    public function show($numleg)
    {
        $diputados=$this->diputadosLegislaturaJson($numleg);
        echo json_encode($diputados);
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

    private function ultimaLegislatura(){
        $claveLeg = DB::table('cat_legislaturas')
        ->orderBy('idLegislatura','desc')
        ->first();
        $leg = (string) $claveLeg->clave;
        return $leg;
    }

    private function diputadosLegislaturaJson($numleg){
        $dl = DB::table('diputadoslegislatura')
        ->leftjoin('cat_legislaturas', 'diputadoslegislatura.idLegislatura', '=', 'cat_legislaturas.idLegislatura')
        ->leftjoin('cat_diputados', 'diputadoslegislatura.idDiputado', '=', 'cat_diputados.idDiputado')
        ->leftjoin('cat_partidospoliticos', 'diputadoslegislatura.idPartido', '=', 'cat_partidospoliticos.idPartido')
        ->leftjoin('cat_distritos', 'cat_diputados.idDistrito', '=', 'cat_distritos.idDistrito')
        ->select(
            'cat_legislaturas.idLegislatura',
            'diputadoslegislatura.idDiputado',
            'diputadoslegislatura.idPartido',
            'diputadoslegislatura.status',
            'diputadoslegislatura.permanente',
            'cat_legislaturas.nombre as legislatura', 
            'cat_legislaturas.clave as numeroLegislatura', 
            DB::raw('CONCAT(cat_diputados.nombre," ",cat_diputados.paterno," ",cat_diputados.materno) as nombreDiputado'),
            DB::raw('(
                case
                    when cat_diputados.suplenteDe = 0 then "Propietario"
                    else "Suplente"
                end) as tipoDeCargo'),
            DB::raw('(
                case
                    when cat_distritos.numero = 99 then "Representación proporcional"
                    else "Mayoría relativa"
                end) as tipoDeEleccion'),
            'cat_diputados.cargo',
            'cat_diputados.foto',
            'cat_diputados.extension',
            'cat_diputados.correo',
            'cat_distritos.numero as numeroDistrito',
            DB::raw('CONCAT(cat_distritos.clave," ",cat_distritos.nombre) as nombreDistrito'),
            'cat_partidospoliticos.siglas as siglasPartido',
            'cat_partidospoliticos.nombre as nombrePartido',
            'cat_partidospoliticos.archivoimagen as logoPartido'
            )
        ->where([
            ['diputadoslegislatura.status','=',1],
            ['cat_legislaturas.clave','=',$numleg]
        ])
        ->orderBy('cat_partidospoliticos.orden')
        ->orderBy('cat_diputados.ordenNivel')
        ->orderBy('cat_diputados.paterno')
        ->get();

        return $dl;
    }

    public function nombreDiputadosCombo(){
        $diputados=$this->diputadosLegislaturaJson($this->ultimaLegislatura());

        return view('licencias')
        ->with('diputados',$diputados);
    }

    public function licencia($idDip){
        $diputadoActivo = Diputado::find($idDip);
        $tipoDeCargo="";
        if($diputadoActivo->suplenteDe==0){
            $tipoDeCargo = "Propietario";
        } else {
            $tipoDeCargo = "Suplente";
        }
        
        $diputadoSuplente = DB::table('cat_diputados')->select('cat_diputados.*')->where('suplenteDe','=',$idDip)->get();
        $diputadoSuplenteEnTabla = DiputadosLegislatura::find($idDip);

        $yaExisteSuplente = false;
        if(!empty($diputadoSuplenteEnTabla)){
            $yaExisteSuplente=true;
        }

        $idSup=0;
        $nomSup="";
        if(!empty($diputadoSuplente)){
            foreach($diputadoSuplente as $dipSuplente){
                $idSup = $dipSuplente->idDiputado;
                $nomSup = $dipSuplente->nombre.' '.$dipSuplente->paterno.' '.$dipSuplente->materno;
            }
        }
        echo 'Diputado activo ' .$diputadoActivo->nombre.' '.$diputadoActivo->paterno.' '.$diputadoActivo->materno.' con id ' . $idDip . '</br>';
        if($nomSup!=""){
            echo 'Su suplente es '.$nomSup.' con id ' . $idSup;
        } else {
            $dip1 = Diputado::find($diputadoActivo->suplenteDe);
            $idSup=$diputadoActivo->suplenteDe;
            echo 'Es suplente de '.$dip1->nombre.' '.$dip1->paterno.' '.$dip1->materno.' con id ' . $idSup . '</br>';
        }
        
        // dd(1);
        $this->diputadoLicencia($idDip,$idSup);

        return redirect('legisladores');
    }

    private function diputadoLicencia($idSale,$idEntra){
        $tabDipSaliente = DB::table('diputadoslegislatura')->select('diputadoslegislatura.*')->where('idDiputado','=',$idSale)->get();
        $diplegis = DB::table('diputadoslegislatura')->select('diputadoslegislatura.*')->where('idDiputado','=',$idSale)->get();
        
        $idLegislatura = 0;
        foreach($tabDipSaliente as $dipSal){
            $idLegislatura = $dipSal->idLegislatura;
            $idPartido = $dipSal->idPartido;
            $idRegistro = $dipSal->id;
        }
        foreach($diplegis as $datoDip){
            $idDip = $datoDip->idDiputado;
            $perm = $datoDip->permanente;
        }

        $objDipSaliente = DiputadosLegislatura::find($idRegistro);
        $objDipSaliente->idLegislatura = $idLegislatura;
        $objDipSaliente->idDiputado = $idDip;
        $objDipSaliente->idPartido = $idPartido;
        $objDipSaliente->status = 0;
        $objDipSaliente->permanente = $perm;
        $objDipSaliente->save();

        $objDipSaliente = DiputadosLegislatura::find($idEntra);
        if(!empty($objDipSaliente)){
            // $diplegis = DiputadosLegislatura::find($idEntra);
            $objDipSaliente->idLegislatura = $objDipSaliente->idLegislatura;
            $objDipSaliente->idDiputado = $objDipSaliente->idDiputado;
            $objDipSaliente->idPartido = $objDipSaliente->idPartido;
            $objDipSaliente->status = 1;
            $objDipSaliente->permanente = $objDipSaliente->permanente;
            // $objDipSaliente->save();
        } else {
            $objDipSaliente = new DiputadosLegislatura();
            $objDipSaliente->idLegislatura = $idLegislatura;
            $objDipSaliente->idDiputado = $idEntra;
            $objDipSaliente->idPartido = $idPartido;
            $objDipSaliente->status = 1;
            $objDipSaliente->permanente = 0;
        }
        // dd($objDipSaliente);
        $objDipSaliente->save();
    }
}
