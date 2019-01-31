<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Eventos;
use App\Asistencia;
use App\Llamados;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class AsistenciaController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

       if((! is_null($request->evento)) && (! is_null($request->fecha)) && (! is_null($request->fecha2)) ) {

         $asistencia = DB::table('asistencias as a')
        ->select('a.id','a.usuario','a.id_evento','a.id_cliente','b.name','c.nombre as evento','d.nombre as cliente','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.id_evento')
        ->join('clientes as d','d.id','a.id_cliente')
        ->where('a.id_evento','=',$request->evento)
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();

    } else if((! is_null($request->fecha)) && (! is_null($request->fecha2))) {



         $asistencia = DB::table('asistencias as a')
        ->select('a.id','a.usuario','a.id_evento','a.id_cliente','b.name','c.nombre as evento','d.nombre as cliente','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.id_evento')
        ->join('clientes as d','d.id','a.id_cliente')
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();


    } else if (! is_null($request->evento)){


         $asistencia = DB::table('asistencias as a')
        ->select('a.id','a.usuario','a.id_evento','a.id_cliente','b.name','c.nombre as evento','d.nombre as cliente','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.id_evento')
        ->join('clientes as d','d.id','a.id_cliente')
        ->where('a.id_evento','=',$request->evento)
        ->get();

    }else {

    	  $asistencia = DB::table('asistencias as a')
        ->select('a.id','a.usuario','a.id_evento','a.id_cliente','b.name','c.nombre as evento','d.nombre as cliente','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.id_evento')
        ->join('clientes as d','d.id','a.id_cliente')
        ->get();

    }



                        $eventos =Eventos::all()->pluck('nombre','id');


        return view('asistencia.index', compact('asistencia','eventos'));
    }

      public function index1(Request $request)
    {
       


       if((! is_null($request->evento)) && (! is_null($request->fecha)) && (! is_null($request->fecha2)) ) {

        $confirmar = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','d.fecha','c.telefono','a.estatus')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->where('a.respuesta','=','Asiste')
        ->where('a.estatus','=','Confirmado')
        ->where('a.id_evento','=',$request->evento)
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();

    } else if((! is_null($request->fecha)) && (! is_null($request->fecha2))) {

    	 $confirmar = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','d.fecha','c.telefono','a.estatus')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->where('a.respuesta','=','Asiste')
        ->where('a.estatus','=','Confirmado')
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();




    } elseif (! is_null($request->evento)) {


        $confirmar = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','d.fecha','c.telefono','a.estatus')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->where('a.respuesta','=','Asiste')
        ->where('a.estatus','=','Confirmado')
        ->where('a.id_evento','=',$request->evento)
        ->get();




    } else {


        $confirmar = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','d.fecha','c.telefono','a.estatus')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->where('a.respuesta','=','Asiste')
        ->where('a.estatus','=','Confirmado') 
        ->get();

    }

                $eventos =Eventos::all()->pluck('nombre','id');


        return view('asistencia.index1', compact('confirmar','eventos'));
    }

  
    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

         $confirmados = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','d.fecha','c.telefono','a.estatus')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->where('a.respuesta','=','Asiste')
        ->where('a.estatus','=','Confirmado')
        ->get();


        
         $clientes   = Clientes::select(
             DB::raw("CONCAT(apellido,' ',nombre,' Telef:',telefono) AS descripcion"),'id')                  
                             ->orderby('apellido','ASC')
                             ->get()->pluck('descripcion','id');


        return view('asistencia.create',compact('eventos'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

       

       $asistencia = new Asistencia;
       $asistencia->id_cliente =$request->cliente;
       $asistencia->id_evento     =$request->evento;
       $asistencia->usuario = Auth::id();
       $asistencia->save();

   


        return redirect()->route('admin.asistencia.index');
        return redirect()->back()->with("success", "EL CLIENTE FUE REGISTRADO EXITOSAMENTE");

    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        $asistencia = Asistencia::findOrFail($id);

        $eventos =Eventos::all()->pluck('nombre','id');

         $clientes   = Clientes::select(
             DB::raw("CONCAT(apellido,' ',nombre,' Telef:',telefono) AS descripcion"),'id')                  
                             ->orderby('apellido','ASC')
                             ->get()->pluck('descripcion','id');


        return view('asistencia.edit', compact('clientes','eventos'));
    }

    

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
     
   
       
        return redirect()->route('admin.asistencia.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
             $serachdata = DB::table('llamados')
                    ->select('*')
                    ->where('id','=', $id)
                    ->first();  

              $evento= $serachdata->id_evento;
              $cliente= $serachdata->id_cliente;

        $llamados = Llamados::findOrFail($id);
        $llamados->estatus= 'Asiste';
        $llamados->update();       


        $asistencia = new Asistencia;
       $asistencia->id_cliente =$cliente;
       $asistencia->id_evento =$evento;
       $asistencia->usuario = Auth::id();
       $asistencia->save();


        return redirect()->route('admin.asistencia.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        
        if ($request->input('ids')) {
            $entries = Asistencia::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
