<?php

namespace App\Http\Controllers;

use App\Pagos;
use App\Eventos;
use App\Clientes;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class ReportesController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function llamadas()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


        return view('reportes.llamadas');
    }

        public function ingresos()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


        return view('reportes.ingresos');
    }

         public function asistentes()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


        return view('reportes.asistentes');
    }




       public function listado_llamadas_ver(Request $request) 
    {
       
      
       if($request->mes == '01'){
       	$mes='Enero';
       }elseif($request->mes == '02'){
        $mes='Febrero';
        }elseif($request->mes == '03'){
        $mes='Marzo';
        }elseif($request->mes == '04'){
        $mes='Abril';
        }elseif($request->mes == '05'){
        $mes='Mayo';
        }elseif($request->mes == '06'){
        $mes='Junio';
        }elseif($request->mes == '07'){
        $mes='Julio';
        }elseif($request->mes == '08'){
        $mes='Agosto';
        }elseif($request->mes == '09'){
        $mes='Septiembre';
        }elseif($request->mes == '10'){
        $mes='Octubre';
        }elseif($request->mes == '11'){
        $mes='Noviembre';
        }elseif($request->mes == '12'){
        $mes='Diciembre';
        }else{
        	$mes='Ninguno';
        }
     


         $llamados = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','c.telefono')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->whereMonth('a.created_at','=',$request->mes)
        ->get();



         $total = DB::table('llamados as a')
        ->select(DB::raw('COUNT(a.id) as total'))
        ->whereMonth('a.created_at','=',$request->mes)
        ->first();






       
      
       $view = \View::make('reportes.listado_llamadas_ver')->with('llamados', $llamados)->with('mes',$mes)->with('total',$total);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       
        return $pdf->stream('llamadas');

    }


       public function listado_ingresos_ver(Request $request) 
    {
       
      
       if($request->mes == '01'){
       	$mes='Enero';
       }elseif($request->mes == '02'){
        $mes='Febrero';
        }elseif($request->mes == '03'){
        $mes='Marzo';
        }elseif($request->mes == '04'){
        $mes='Abril';
        }elseif($request->mes == '05'){
        $mes='Mayo';
        }elseif($request->mes == '06'){
        $mes='Junio';
        }elseif($request->mes == '07'){
        $mes='Julio';
        }elseif($request->mes == '08'){
        $mes='Agosto';
        }elseif($request->mes == '09'){
        $mes='Septiembre';
        }elseif($request->mes == '10'){
        $mes='Octubre';
        }elseif($request->mes == '11'){
        $mes='Noviembre';
        }elseif($request->mes == '12'){
        $mes='Diciembre';
        }else{
        	$mes='Ninguno';
        }

     


         $pagos = DB::table('pagos as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.monto','a.tipo_pago','a.usuario','b.name','c.nombre as nomcliente','c.apellido','d.nombre','c.telefono','d.nombre as evento','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
         ->whereMonth('a.created_at','=',$request->mes)
        ->get();



         $total = DB::table('pagos as a')
        ->select(DB::raw('SUM(a.monto) as total'))
        ->whereMonth('a.created_at','=',$request->mes)
        ->first();


      
       $view = \View::make('reportes.listado_ingresos_ver')->with('pagos', $pagos)->with('mes',$mes)->with('total',$total);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       
        return $pdf->stream('ingresos');

    }

     public function listado_asistentes_ver(Request $request) 
    {
       
      
       if($request->mes == '01'){
       	$mes='Enero';
       }elseif($request->mes == '02'){
        $mes='Febrero';
        }elseif($request->mes == '03'){
        $mes='Marzo';
        }elseif($request->mes == '04'){
        $mes='Abril';
        }elseif($request->mes == '05'){
        $mes='Mayo';
        }elseif($request->mes == '06'){
        $mes='Junio';
        }elseif($request->mes == '07'){
        $mes='Julio';
        }elseif($request->mes == '08'){
        $mes='Agosto';
        }elseif($request->mes == '09'){
        $mes='Septiembre';
        }elseif($request->mes == '10'){
        $mes='Octubre';
        }elseif($request->mes == '11'){
        $mes='Noviembre';
        }elseif($request->mes == '12'){
        $mes='Diciembre';
        }else{
        	$mes='Ninguno';
        }

     

          $asistencia = DB::table('asistencias as a')
        ->select('a.id','a.usuario','a.id_evento','a.id_cliente','b.name','c.nombre as evento','d.nombre as nomcliente','d.apellido as apecliente','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.id_evento')
        ->join('clientes as d','d.id','a.id_cliente')
        ->whereMonth('a.created_at','=',$request->mes)
        ->get();



         $total = DB::table('asistencias as a')
        ->select(DB::raw('COUNT(a.id) as total'))
        ->whereMonth('a.created_at','=',$request->mes)
        ->first();


      
       $view = \View::make('reportes.listado_asistentes_ver')->with('asistencia', $asistencia)->with('mes',$mes)->with('total',$total);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       
        return $pdf->stream('ingresos');

    }






 

}
