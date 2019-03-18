<?php

namespace App\Http\Controllers;

use App\Eventos;
use App\Llamados;
use App\Clientes;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class LlamadosController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       

       if((! is_null($request->evento)) && (! is_null($request->fecha)) && (! is_null($request->fecha2)) ) {



         $llamados = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','c.telefono')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
         ->where('a.id_evento','=',$request->evento)
                 ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();

    } else if((! is_null($request->fecha)) && (! is_null($request->fecha2))) {


         $llamados = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','c.telefono')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();



    } elseif (! is_null($request->evento)) {

          $llamados = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','c.telefono')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
         ->where('a.id_evento','=',$request->evento)
        ->get();

    } else {

        $llamados = DB::table('llamados as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.respuesta','a.observacion','a.usuario','b.name','c.nombre as nomcliente','c.apellido as apecliente','d.nombre as evento','a.created_at','c.telefono')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->get();


    }



     $eventos =Eventos::all()->pluck('nombre','id');

        return view('llamados.index', compact('llamados','eventos'));
    }
    
    public function index1(Request $request)
    {
        

       if((! is_null($request->evento)) && (! is_null($request->fecha)) && (! is_null($request->fecha2)) ) {


         $clientes = DB::table('clientes as a')
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.usuario','a.evento','a.llamado','b.name','c.nombre as evento','a.llamado','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
        ->where('a.evento','=',$request->evento)
                         ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->where('a.llamado','=',NULL)
        ->get();

    } else if((! is_null($request->fecha)) && (! is_null($request->fecha2))) {

          $clientes = DB::table('clientes as a')
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.usuario','a.evento','a.llamado','b.name','c.nombre as evento','a.llamado')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
        ->where('a.llamado','=',NULL)
                                 ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();


        } elseif (! is_null($request->evento)) {


         $clientes = DB::table('clientes as a')
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.usuario','a.evento','a.llamado','b.name','c.nombre as evento','a.llamado','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
        ->where('a.evento','=',$request->evento)
        ->where('a.llamado','=',NULL)
        ->get();

    } else {

         $clientes = DB::table('clientes as a')
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.usuario','a.evento','a.llamado','b.name','c.nombre as evento','a.llamado','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
        ->where('a.llamado','=',NULL)
        ->get();



    }


            $eventos =Eventos::all()->pluck('nombre','id');


        return view('llamados.index1', compact('clientes','eventos'));
    }


    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        


    $clientes   = Clientes::select(
             DB::raw("CONCAT(apellido,' ',nombre,' Telef:',telefono) AS descripcion"),'id')                  
                             ->orderby('apellido','ASC')
                             ->get()->pluck('descripcion','id');
	$eventos =Eventos::all()->pluck('nombre','id');

        return view('llamados.create',compact('clientes','eventos'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
       

         $id_usuario = Auth::id();


         dd($id);
         die();

             $serachcliente = DB::table('clientes')
                    ->select('*')
                    ->where('id','=', $id)
                    ->first();   

        

       $llamados = new Llamados;
       $llamados->id_cliente =$request->cliente;
       $llamados->id_evento     =$request->evento;
       $llamados->respuesta     =$request->respuesta;
       $llamados->observacion     =$request->observacion;
       $llamados->estatus     ='No Confirmado';
       $llamados->usuario = Auth::id();
       $llamados->save();


        return redirect()->route('admin.llamados.index');
        return redirect()->back()->with("success", "EL EVENTO FUE REGISTRADO EXITOSAMENTE");

    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

        $llamados = Llamados::findOrFail($id);
       $clientes   = Clientes::select(
             DB::raw("CONCAT(apellido,' ',nombre) AS descripcion"),'id')                  
                             ->orderby('apellido','ASC')
                             ->get()->pluck('descripcion','id');
	    $eventos =Eventos::all()->pluck('nombre','id');


        return view('llamados.edit', compact('llamados','clientes','eventos'));
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
       
        

       
             $serachcliente = DB::table('clientes')
                    ->select('*')
                    ->where('id','=', $id)
                    ->first();  

              $evento= $serachcliente->evento;
              
        $cliente = Clientes::findOrFail($id);
        $cliente->llamado= 'SI';
        $cliente->update();


       $llamados = new Llamados;
       $llamados->id_cliente =$id;
       $llamados->id_evento     =$evento;
       $llamados->respuesta     =$request->respuesta;
       $llamados->observacion     =$request->observacion;
       $llamados->estatus     ='No Confirmado';
       $llamados->usuario = Auth::id();
       $llamados->save();           

       
        return redirect()->route('admin.llamados.index1');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $llamados = Llamados::findOrFail($id);
        $llamados->delete();

        return redirect()->route('admin.llamados.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        
        if ($request->input('ids')) {
            $entries = Llamados::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
