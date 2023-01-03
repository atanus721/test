<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Tienda;
use Illuminate\Http\Request;

use App\Models\Precio;
use App\Models\Traspaso;
use App\Models\Embarquemateriale;
use App\Models\Embarquemercancia;
use App\Models\Devolucione;
use App\Models\Preciosdam;
use App\Models\Preciostienda;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\While_;
use ZipArchive;

/**
 * Class TiendaController
 * @package App\Http\Controllers
 */
class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $tiendas = Tienda::all();

        //$comparativos = DB::select('CALL sp_difsucursal(?)', array($tienda->id_sap));
        //$cntdiferen = count($comparativos);
        //print_r($tiendas[1]->id_sap);
        
        return view('tienda.paginado', compact('tiendas'))->with('i', $tiendas);        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tienda = new Tienda();
        return view('tienda.create', compact('tienda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tienda::$rules);

        $tienda = Tienda::create($request->all());

        return redirect()->route('tiendas.index')
            ->with('success', 'Tienda created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tienda = Tienda::find($id);
        
        //$diffechas = DB::select('CALL sp_diffechas(?)', array($tienda->id_sap));
        //return view('tienda.show', compact('tienda'))->with('diffechas',$diffechas);
        return view('tienda.show', compact('tienda'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function detalle($id)
    {
        $tienda = Tienda::find($id);
        
        $comparativos = DB::select('CALL sp_allsuc(?)', array($tienda->id_sap));
        //$cntdiferen = count($comparativos);

        return view('tienda.difprecios', compact('tienda'))->with('compara',$comparativos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tienda = Tienda::find($id);

        return view('tienda.edit', compact('tienda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tienda $tienda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tienda $tienda)
    {
        request()->validate(Tienda::$rules);

        $tienda->update($request->all());

        return redirect()->route('tiendas.index')
            ->with('success', 'Tienda updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tienda = Tienda::find($id)->delete();

        return redirect()->route('tiendas.index')
            ->with('success', 'Tienda deleted successfully');
    }
        /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function paginar($id)
    {
        $tienda = Tienda::find($id);
        
        $comparativos = DB::select('CALL sp_difsucursal(?)', array($tienda->id_sap));
        //$cntdiferen = count($comparativos);

        return view('tienda.difprecios', compact('tienda'))->with('compara',$comparativos);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function cruceprecios($id)
    {
        $tienda = Tienda::find($id);
        
        //$pretien = Preciostienda::find($tienda->id_sap);
        //DB::table('preciostiendas')->where('id_sap', $tienda->id_sap)->delete();
        //DB::table('preciostiendas')->truncate();
        //Preciostienda::delete($tienda->id_sap);

/*         $ftpConn = ftp_connect("ftp.mrtienda.com") or die("ERROR DE FTP.");
        if(@ftp_login($ftpConn,$tienda->usuarioftp,$tienda->passwdftp)){
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
            }else if(($tienda->id_sap > 9) && ($tienda->id_sap < 99)){
                $sap = '0' . $tienda->id_sap;
            }else{
                $sap = $tienda->id_sap;
            }

            $mesactual = date('m');
            $anioctual = date('y');
            $proceso_id = 'C' . $diaConCeros.$mesactual.$anioctual.'.'. $sap;
            $key = array_search($proceso_id, $contents);
            $ftp_file = $contents[$key];
            $local_file = 'R' . $diaConCeros.$mesactual.$anioctual.$sap . '.000';
            $result = explode('.',$local_file);
            $new_file = $result[0] . '.ZIP';                        
            $ruta = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $tienda->id_sap . DIRECTORY_SEPARATOR;
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
                            foreach($lineas as $row) {
                                $separada[$i][$j]= explode("\t", $row);
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
                        return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE CARPETA INEXISTENTE.']);
                    }                                        
                } else {
                    return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE DESCARGA ZIP.']);
                }
            } else {
                return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE LOGIN EN FTP.']);                
            }          
        } else {
            return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE LOGIN EN FTP.']);
        }
 */
        //$comparativos = DB::select('CALL sp_difsucursal(?)', array($tienda->id_sap));
        //$cntdiferen = count($comparativos);

/*         if($request->$request->ajax()){}
            $data = DB::select('CALL sp_comparativoprecios(?,?,?)', array($inicio,$fin,$id)); */
        
        //return view('tienda.difprecios', compact('tienda'))->with('compara',$comparativos);
        return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'TIENDA '.$tienda->nombre.' ACTUALIZADA']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function actualizarfinal($id)
    {
        $tienda = Tienda::find($id);
        $ftpConn = ftp_connect("ftp.mrtienda.com") or die("ERROR DE FTP.");
        if(@ftp_login($ftpConn,$tienda->usuarioftp,$tienda->passwdftp)){
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
            }else if(($tienda->id_sap > 9) && ($tienda->id_sap < 99)){
                $sap = '0' . $tienda->id_sap;
            }else{
                $sap = $tienda->id_sap;
            }

            $mesactual = date('m');
            $anioctual = date('y');
            $proceso_id = 'C' . $diaConCeros.$mesactual.$anioctual.'.'. $sap;
            $key = array_search($proceso_id, $contents);
            $ftp_file = $contents[$key];
            $local_file = 'R' . $diaConCeros.$mesactual.$anioctual.$sap . '.000';
            $result = explode('.',$local_file);
            $new_file = $result[0] . '.ZIP';                        
            $ruta = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $tienda->id_sap . DIRECTORY_SEPARATOR;
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
                            foreach($lineas as $row) {
                                $separada[$i][$j]= explode("\t", $row);
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
                        return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE CARPETA INEXISTENTE.']);
                    }                                        
                } else {
                    return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE DESCARGA ZIP.']);
                }
            } else {
                return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE LOGIN EN FTP.']);                
            }          
        } else {
            return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE LOGIN EN FTP.']);
        }
        return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'TIENDA '.$tienda->nombre.' ACTUALIZADA']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar($id)
    {
        /*
         * Inicia actualizaci�n
         */
        $tienda = Tienda::find($id);
        $ftpConn = ftp_connect("ftp.mrtienda.com") or die("ERROR DE FTP.");
        if(@ftp_login($ftpConn,$tienda->usuarioftp,$tienda->passwdftp)){
            $contents = ftp_nlist($ftpConn, ".");          
            
            $precios_pendientes = $tienda->precios()->get();
            $traspasos_pendientes = $tienda->traspasosdestino()->get();
            $mercancias_pendientes = $tienda->embarquemercancias()->get();
            $materiales_pendientes = $tienda->embarquemateriales()->get();
            $devoluciones_pendientes = $tienda->devoluciones()->get();
            
            foreach ($contents as $archivo){
                switch ($archivo){
                    case (str_starts_with($archivo, 'P'.str_pad($tienda->id_sap, 3, "0", STR_PAD_LEFT)) && str_ends_with($archivo, ".txt")):
                        $precio = new Precio();
                        $precio->id_tienda = $tienda->id;
                        $precio->fecha = "20".substr($archivo, 4, 2)."-".substr($archivo, 6, 2)."-".substr($archivo, 8, 2)." ".substr($archivo, 10, 2).":".substr($archivo, 12, 2).":00";
                        $precio->archivo = $archivo;
                        
                        if (($precios_pendientes->isNotEmpty())) {
                            if ($key = $precios_pendientes->firstWhere('archivo',$precio->archivo)) {
                                $precios_pendientes = $precios_pendientes->except($key->id);
                            }
                        }
                        
                        if (Precio::where('archivo',$precio->archivo)->doesntExist()){
                            $precio->save();
                        }
                        unset($key);
                        break;
                    case (str_starts_with($archivo, 'T') && str_ends_with($archivo, str_pad($tienda->id_sap, 3, "0", STR_PAD_LEFT))):
                        $traspaso = new Traspaso();
                        
                        $archivo_separado = explode(".",$archivo);
                        
                        if ($tiendaorigen = Tienda::where('id_sap',intval(substr($archivo_separado[0], 9, 3)))->first()) {
                            $traspaso->id_tienda_origen = $tiendaorigen->id;
                        }
                        if ($tiendadestino = Tienda::where('id_sap',intval($archivo_separado[1]))->first()) {
                            $traspaso->id_tienda_destino = $tiendadestino->id;
                        }
                        
                        $traspaso->fecha = substr($archivo, 1, 4)."-".substr($archivo, 5, 2)."-".substr($archivo, 7, 2)." 00:00:00";
                        $traspaso->folio = substr($archivo_separado[0], 12);
                        $traspaso->archivo = $archivo;
                        
                        if (($traspasos_pendientes->isNotEmpty())) {
                            if($key = $traspasos_pendientes->firstWhere('archivo',$traspaso->archivo)){
                                $traspasos_pendientes = $traspasos_pendientes->except($key->id);
                            }
                        }
                        
                        if (Traspaso::where('archivo',$traspaso->archivo)->doesntExist()){
                            $traspaso->save();
                        }
                        unset($key);
                        break;

                    case (str_starts_with($archivo, 'O_STR') && str_contains($archivo, 'RM') && (str_ends_with($archivo, ".txt") || str_ends_with($archivo, ".TXT")) && (substr($archivo, 16, 2) == '22')):
                        $materiales = new Embarquemateriale();

                        if ($tiendadestino = Tienda::where('id_sap',intval(substr($archivo, 6, 3)))->first()) {
                            $materiales->id_tienda = $tiendadestino->id;
                        }
                        
                        $materiales->fecha = "20".substr($archivo, 16, 2)."-".substr($archivo, 14, 2)."-".substr($archivo, 12, 2)." ".substr($archivo, 18, 2).":".substr($archivo, 16, 2).":00";
                        $materiales->archivo = $archivo;
                        
                        if (($materiales_pendientes->isNotEmpty())) {
                            if($key = $materiales_pendientes->firstWhere('archivo',$materiales->archivo)){
                                $materiales_pendientes = $materiales_pendientes->except($key->id);
                            }
                        }
                        
                        if (Embarquemateriale::where('archivo',$materiales->archivo)->doesntExist()){
                            $materiales->save();
                        }
                        unset($key);
                        break;

                    case (str_starts_with($archivo, 'O_STR') && str_contains($archivo, 'RM') && (str_ends_with($archivo, ".txt") || str_ends_with($archivo, ".TXT")) && (substr($archivo, 12, 4) == '2022')):
                        $materiales = new Embarquemateriale();
                        
                        if ($tiendadestino = Tienda::where('id_sap',intval(substr($archivo, 6, 3)))->first()) {
                            $materiales->id_tienda = $tiendadestino->id;
                        }
                        
                        $materiales->fecha = substr($archivo, 12, 4)."-".substr($archivo, 16, 2)."-".substr($archivo, 18, 2)." 00:00:00";
                        $materiales->archivo = $archivo;
                        
                        if (($materiales_pendientes->isNotEmpty())) {
                            if($key = $materiales_pendientes->firstWhere('archivo',$materiales->archivo)){
                                $materiales_pendientes = $materiales_pendientes->except($key->id);
                            }
                        }
                        
                        if (Embarquemateriale::where('archivo',$materiales->archivo)->doesntExist()){
                            $materiales->save();
                        }
                        unset($key);
                        break;

                    case (str_starts_with($archivo, 'O_STR') && !str_contains($archivo, 'RM') && (str_ends_with($archivo, ".txt") || str_ends_with($archivo, ".TXT"))):
                        $mercancia = new Embarquemercancia();
                        
                        if ($tiendadestino = Tienda::where('id_sap',intval(substr($archivo, 6, 3)))->first()) {
                            $mercancia->id_tienda = $tiendadestino->id;
                        }
                        
                        $mercancia->tipo = substr($archivo, 10, 2);
                        $mercancia->consecutivo = substr($archivo, 20, 5);
                        $mercancia->fecha = substr($archivo, 12, 4)."-".substr($archivo, 16, 2)."-".substr($archivo, 18, 2)." 00:00:00";
                        $mercancia->archivo = $archivo;
                        
                        if (($mercancias_pendientes->isNotEmpty())) {
                            if($key = $mercancias_pendientes->firstWhere('archivo',$mercancia->archivo)){
                                $mercancias_pendientes = $mercancias_pendientes->except($key->id);
                            }
                        }
                        
                        if (Embarquemercancia::where('archivo',$mercancia->archivo)->doesntExist()){
                            $mercancia->save();
                        }
                        unset($key);
                        break;
                    case (str_starts_with($archivo, 'O_DEV_'.str_pad($tienda->id_sap, 3, "0", STR_PAD_LEFT)) && (str_ends_with($archivo, ".txt") || str_ends_with($archivo, ".TXT"))):
                        $devolucion = new Devolucione();
                        
                        $devolucion->id_tienda = $tienda->id;
                        
                        $archivo_separado = explode("_",$archivo);
                        
                        $devolucion->documento_sap = $archivo_separado[3];
                        $devolucion->fecha = substr($archivo_separado[4], 0, 4)."-".substr($archivo_separado[4], 4, 2)."-".substr($archivo_separado[4], 6, 2)." 00:00:00";
                        $devolucion->archivo = $archivo;
                        
                        if (($devoluciones_pendientes->isNotEmpty())) {
                            if($key = $devoluciones_pendientes->firstWhere('archivo',$devolucion->archivo)){
                                $devoluciones_pendientes = $devoluciones_pendientes->except($key->id);
                            }
                        }
                        
                        if (Devolucione::where('archivo',$devolucion->archivo)->doesntExist()){
                            $devolucion->save();
                        }
                        unset($key);
                        break;
                }
            }
            unset($archivo);
            
            $precios_pendientes->map->delete();
            $traspasos_pendientes->map->delete();
            $mercancias_pendientes->map->delete();
            $materiales_pendientes->map->delete();
            $devoluciones_pendientes->map->delete();
            
            $tienda->updated_at = date("Y-m-d H:i:s");
            $tienda->update(); 
            
            /*
             * Termina actualizaci�n
             */
        }
        else{
            return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'ERROR DE LOGIN EN FTP.']);
        }
        return redirect()->action([TiendaController::class, 'index'])->withErrors(['msg' => 'TIENDA '.$tienda->nombre.' ACTUALIZADA']);
    }
}