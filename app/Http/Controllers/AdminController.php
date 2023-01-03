<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Tienda;
use App\Models\Preciosdam;
use App\Models\Preciostienda;
use Illuminate\Http\Request;
use ZipArchive;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiendas = Tienda::all();

        //$diftodas = DB::select('CALL sp_todassuc');
        //print_r($diftodas);
        //return view('tienda.show', compact('tiendas'))->with('diffechas',$diftodas);

        return view('admin.index', compact('tiendas'))->with('i', $tiendas);
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function diferencias($id)
    {
        $tiendas = Tienda::all();
        
        foreach($tiendas as $row) {
            //if($row->id_sap == 2){
            //if(($row->id_sap >= 3) && ($row->id_sap <= 7)){    
                $comparativos = DB::select('CALL sp_difsucursal(?)', array($row->id_sap));
                if($comparativos){
                    DB::table('tiendas')->where('id_sap', $row->id_sap)->update(['diftotal' => $comparativos[0]->diftotal, 'created_at' => date("Y-m-d H:i:s")]);
                } else {
                    DB::table('tiendas')->where('id_sap', $row->id_sap)->update(['diftotal' => 0, 'created_at' => date("Y-m-d H:i:s")]);
                }
            //}
        }  

        return redirect()->action([AdminController::class, 'index']);
    }

    public function diferenciasid($id)
    {        
        $tienda = Tienda::find($id);
        //echo $tienda->id_sap;
        $comparativos = DB::select('CALL sp_difsucursal(?)', array($tienda->id_sap));
        //print_r($comparativos);
        if($comparativos){
            DB::table('tiendas')->where('id_sap', $tienda->id_sap)->update(['diftotal' => $comparativos[0]->diftotal, 'created_at' => date("Y-m-d H:i:s")]);
        } else {
            DB::table('tiendas')->where('id_sap', $tienda->id_sap)->update(['diftotal' => 0, 'created_at' => date("Y-m-d H:i:s")]);
        }

        return redirect()->action([AdminController::class, 'index']);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tiendas = Tienda::all();
        DB::table('preciostiendas')->delete();

        foreach($tiendas as $row) {

        if(($row->activo=='S')){
            $ftpConn = ftp_connect("ftp.mrtienda.com") or die("ERROR DE FTP.");
            $conexion =@ftp_login($ftpConn,$row->usuarioftp,$row->passwdftp);

            //if(@ftp_login($ftpConn,$row->usuarioftp,$row->passwdftp)){
            if($conexion == 1){    

                $contents = ftp_nlist($ftpConn, "");
                $diaactual = date('d')-1;
                if($diaactual<10){
                    $diaConCeros = str_pad($diaactual, 2, "0", STR_PAD_LEFT);
                }else{
                    $diaConCeros = date('d');
                    $diaConCeros = $diaConCeros - 1;
                }
                if($row->id_sap < 10){
                    $sap = '00' . $row->id_sap;
                }else if(($row->id_sap > 9) && ($row->id_sap < 99)){
                    $sap = '0' . $row->id_sap;
                }else{
                    $sap = $row->id_sap;
                }
    
                $mesactual = date('m');
                $anioctual = date('y');
                $proceso_id = 'C' . $diaConCeros.$mesactual.$anioctual.'.'. $sap;
                $key = array_search($proceso_id, $contents);
                $ftp_file = $contents[$key];
                $local_file = 'R' . $diaConCeros.$mesactual.$anioctual.$sap . '.000';
                //$local_file = 'R' . $diaConCeros.$mesactual.$anioctual . '.000';
                $result = explode('.',$local_file);
                $new_file = $result[0] . '.ZIP';                        
                $ruta = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $zip = new ZipArchive();
                if (ftp_get($ftpConn, $new_file, $ftp_file, FTP_BINARY)) {
                    $respuesta = $zip->open($new_file, ZipArchive::RDONLY);
                    if($respuesta){
                        if( $zip->extractTo( $ruta ) )
                        {
                            $rutatxt = $ruta . 'LPRECIOS.TXT';
                            $file = fopen($rutatxt, "r");
                            while(!feof($file)){
                                $archivo = fgets($file);
                                $lineas = explode(PHP_EOL, $archivo);
                                $precios = new Preciostienda();
                                $separada = array();
                                $i=0;
                                $j=0;
                                foreach($lineas as $fila) {
                                    $separada[$i][$j]= explode("\t", $fila);
                                    $precios->id_sap = $row->id_sap;
                                    $precios->sku = $separada[0][0][0];
                                    $precios->precioa = $separada[0][0][1];
                                    $precios->preciob = $separada[0][0][2];
                                    $precios->precioc = $separada[0][0][3];
                                    $precios->preciod = $separada[0][0][4];
                                    $precios->save(); 
                                    $i++;
                                    $j++;
                                }  
                            }
                        } else {
                            return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE CARPETA INEXISTENTE. EN LA TIENDA: '.$row->nombre]);
                        }                                        
                    } else {
                        return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE DESCARGA ZIP. EN LA TIENDA: '.$row->nombre]);
                    }
                } else {
                    return redirect()->action([AdminController::class, 'index'])->withErrors(['msg' => 'ERROR DE ARCHIVO TXT EN LA TIENDA: '.$row->nombre]);                
                }                
            } /* else {
                return redirect()->action([AdminController::class, 'index'])->withErrors(['msg' => 'ERROR DE LOGIN EN FTP CON: '.$row->id_sap.'-'.$row->nombre]);
            }   */              
        }
        }
        return redirect()->action([AdminController::class, 'index'])->withErrors(['msg' => 'PRECIOS ACTUALIZADOS']);    
    }

    public function tiendasid($id)
    {
        $tienda = Tienda::find($id);

        //Preciostienda::where('id_sap', $tienda->id_sap)->delete();
        if(Preciostienda::where('id_sap', $tienda->id_sap)->delete()){
        }

        if($tienda->activo=='S'){ 
            $ftpConn = ftp_connect("ftp.mrtienda.com") or die("ERROR DE FTP.");
            $conexion =@ftp_login($ftpConn,$tienda->usuarioftp,$tienda->passwdftp);

            //if(@ftp_login($ftpConn,$row->usuarioftp,$row->passwdftp)){
            if($conexion == 1){    

                $contents = ftp_nlist($ftpConn, "");
                $diaactual = date('d')-1;

                 if($diaactual<10){
                    $diaConCeros = str_pad($diaactual, 2, "0", STR_PAD_LEFT);
                }else{
                    $diaConCeros = date('d');
                    $diaConCeros = $diaConCeros - 1;
                }
                if($tienda->id_sap < 10){
                    $sap = '00' . $tienda->id_sap;
                }else if(($tienda->id_sap >= 10) && ($tienda->id_sap <= 99)){
                    $sap = '0' . $tienda->id_sap;
                }else{
                    $sap = $tienda->id_sap;
                } 
                //echo ' - ' . $diaConCeros . ' - ' . $sap . ' - ';
                $mesactual = date('m');
                $anioctual = date('y');
                $proceso_id = 'C' . $diaConCeros.$mesactual.$anioctual.'.'.$sap;
                //echo ' - ' . $proceso_id;
                $key = array_search($proceso_id, $contents);
                $ftp_file = $contents[$key];
                echo ' - '. $key;
                $local_file = 'R' . $diaConCeros.$mesactual.$anioctual.$sap . '.000';
                //$local_file = 'R' . $diaConCeros.$mesactual.$anioctual . '.000';
                $result = explode('.',$local_file);
                $new_file = $result[0] . '.ZIP';  
                //$ftp_file = 'C310122.002';  
                $ruta = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $tienda->id_sap . DIRECTORY_SEPARATOR;
                //$ruta = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $zip = new ZipArchive();
                //echo $ftp_file .' - '. $new_file;
                if (ftp_get($ftpConn, $new_file, $ftp_file, FTP_BINARY)) {
                    $respuesta = $zip->open($new_file, ZipArchive::RDONLY);
                    if($respuesta){
                        if( $zip->extractTo( $ruta ) )
                        {
                            $rutatxt = $ruta . 'LPRECIOS.TXT';
                            $file = fopen($rutatxt, "r");
                            while(!feof($file)){
                                $archivo = fgets($file);
                                $lineas = explode(PHP_EOL, $archivo);
                                $precios = new Preciostienda();
                                $separada = array();
                                $i=0;
                                $j=0;
                                foreach($lineas as $fila) {
                                    $separada[$i][$j]= explode("\t", $fila);
                                    $precios->id_sap = $tienda->id_sap;
                                    $precios->sku = $separada[0][0][0];
                                    $precios->precioa = $separada[0][0][1];
                                    $precios->preciob = $separada[0][0][2];
                                    $precios->precioc = $separada[0][0][3];
                                    $precios->preciod = $separada[0][0][4];
                                    $precios->save(); 
                                    $i++;
                                    $j++;
                                }  
                            }
                        } else {
                            return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE CARPETA INEXISTENTE. EN LA TIENDA: '.$tienda->nombre]);
                        }                                        
                    } else {
                        return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE DESCARGA ZIP. EN LA TIENDA: '.$tienda->nombre]);
                    }
                } else {
                    return redirect()->action([AdminController::class, 'index'])->withErrors(['msg' => 'ERROR DE ARCHIVO TXT EN LA TIENDA: '.$tienda->nombre]);                
                }                
            }              
        }  

        return redirect()->action([AdminController::class, 'index'])->withErrors(['msg' => 'PRECIOS ACTUALIZADOS']);    
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dam($id)
    {
        $tiendas = Tienda::all();
        DB::table('preciosdams')->delete();
        //$pretien = Preciostienda::find($tienda->id_sap);

        foreach($tiendas as $tienda) {
            //if(($tienda->id_sap) >= 7 && ($tienda->id_sap <= 11)){
        //if($tienda->id_sap < 8){
        //if(($tienda->id_sap >= 51) && ($tienda->id_sap <= 99)){
            $fp = fopen(public_path("preciosDAM.csv"),"r");
            while(!feof($fp)){
                $archivo = fgets($fp);
                $lineas = explode(PHP_EOL, $archivo);
                $precios = new Preciosdam();
                $separada = array();
                $i=0;
                $j=0;
                foreach($lineas as $row) {
                    $separada[$i][$j]= explode(",", $row);
                    if($separada[0][0][0] == $tienda->id_sap){
                        $precios->id_sap = (int)$separada[0][0][0];
                        $precios->sku = $separada[0][0][1];
                        $precios->precioa = $separada[0][0][2];
                        $precios->preciob = $separada[0][0][3];
                        $precios->precioc = $separada[0][0][4];
                        $precios->preciod = $separada[0][0][5];
                        $precios->fecha = $separada[0][0][6];
                        $precios->save();
                    }
                    $i++;
                    $j++;
                }
            }
            fclose($fp);
        //}
        }
        return redirect()->action([AdminController::class, 'index'])->withErrors(['msg' => 'PRECIOS ACTUALIZADOS']);
    }

    public function tiendasdamid($id)
    {
        $tienda = Tienda::find($id);
        
        if(Preciosdam::where('id_sap', $tienda->id_sap)->delete()){
        }

        if($tienda->activo=='S'){     
            $fp = fopen(public_path("preciosDAM.csv"),"r");
            while(!feof($fp)){
                $archivo = fgets($fp);
                $lineas = explode(PHP_EOL, $archivo);
                $precios = new Preciosdam();
                $separada = array();
                $i=0;
                $j=0;
                foreach($lineas as $row) {
                    $separada[$i][$j]= explode(",", $row);
                    if($separada[0][0][0] == $tienda->id_sap){
                        $precios->id_sap = (int)$separada[0][0][0];
                        $precios->sku = $separada[0][0][1];
                        $precios->precioa = $separada[0][0][2];
                        $precios->preciob = $separada[0][0][3];
                        $precios->precioc = $separada[0][0][4];
                        $precios->preciod = $separada[0][0][5];
                        $precios->fecha = $separada[0][0][6];
                        $precios->save();
                    }
                    $i++;
                    $j++;
                }
            }
            fclose($fp);
        }        

        return redirect()->action([AdminController::class, 'index'])->withErrors(['msg' => 'PRECIOS ACTUALIZADOS']);
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
