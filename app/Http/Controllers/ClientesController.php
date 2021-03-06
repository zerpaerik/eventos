<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Eventos;
use App\Llamados;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class ClientesController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = DB::table('clientes as a')
            ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.usuario','a.evento','b.name','c.nombre as evento')
            ->join('users as b','b.id','a.usuario')
            ->join('eventos as c','c.id','a.evento')
            ->get();
        return view('clientes.index', compact('clientes'));
    }

    public function index1(Request $request)
    {
        if((! is_null($request->evento)) && (! is_null($request->fecha)) && (! is_null($request->fecha2)) ) {

            $clientes = DB::table('clientes as a')
                ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado', 'l.estatus','l.respuesta')
                ->join('users as b','b.id','a.usuario')
                ->join('eventos as c','c.id','a.evento')
                ->where('a.evento','=',$request->evento)
                ->leftjoin('llamados as l', 'l.id_cliente', 'a.id')
                ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
                ->get();

        } else if((! is_null($request->fecha)) && (! is_null($request->fecha2))) {

            $clientes = DB::table('clientes as a')
                ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado', 'l.estatus','l.respuesta')
                ->join('users as b','b.id','a.usuario')
                ->join('eventos as c','c.id','a.evento')
                ->leftjoin('llamados as l', 'l.id_cliente', 'a.id')
                ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
                ->get();


        } elseif (! is_null($request->evento)) {

            $clientes = DB::table('clientes as a')
                ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado', 'l.estatus','l.respuesta')
                ->join('users as b','b.id','a.usuario')
                ->join('eventos as c','c.id','a.evento')
                ->leftjoin('llamados as l', 'l.id_cliente', 'a.id')
                ->where('a.evento','=',$request->evento)
                ->get();
        } else {
            $clientes = DB::table('clientes as a')
                ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado', 'l.estatus','l.respuesta')
                ->join('users as b','b.id','a.usuario')
                ->join('eventos as c','c.id','a.evento')
                ->leftjoin('llamados as l', 'l.id_cliente', 'a.id')
                //->where('a.created_at','=',date('Y-m-d'))
                ->get();
        }

        $eventos =Eventos::whereBetween('fecha', [date("Y-m-d"), date("Y")."-12-31"])
                        ->pluck('nombre','id');
       
        return view('clientes.index1', compact('clientes','eventos'));
    }

    public function indexRellamados()
    {
        $clientes = DB::table('clientes as a')
                ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado', 'l.estatus','l.respuesta')
                ->join('users as b','b.id','a.usuario')
                ->join('eventos as c','c.id','a.evento')
                ->join('llamados as l', 'l.id_cliente', 'a.id')
                //->where('l.estatus','=','Rellamado')
                ->get();

        return view('clientes.indexR', compact('clientes'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventos =Eventos::whereBetween('fecha', [date("Y-m-d"), date("Y")."-12-31"])
                        ->pluck('nombre','id');
        
        return view('clientes.create',compact('eventos'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_usuario = Auth::id();

        /*$validator = \Validator::make($request->all(), [
          'nombre' => 'required|string|max:255',
          'apellido' => 'required|string|max:255',
          
        ]);

        if($validator->fails()) {
            return redirect()->back()->with("error", "VERIFIQUE LOS DATOS");
        } else {*/
            $clientes = new Clientes;
            $clientes->nombre =$request->nombre;
            $clientes->apellido     =$request->apellido;
            $clientes->telefono     =$request->telefono;
            $clientes->email= $request->email;
            $clientes->evento= $request->evento;
            $clientes->usuario = Auth::id();
            if($clientes->save()){
                return 1;
            } else {
                return 0;
            }
        //}   

        //return redirect()->route('admin.clientes.index1');
        //return redirect()->back()->with("success", "EL CLIENTE FUE REGISTRADO EXITOSAMENTE");

    }

    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = Clientes::findOrFail($id);
        $eventos =Eventos::whereBetween('fecha', [date("Y-m-d"), date("Y")."-12-31"])
                        ->pluck('nombre','id');
        return view('clientes.edit', compact('clientes','eventos'));
    }

    public function llamar($id)
    {
        $clientes = Clientes::findOrFail($id);
        $eventos =Eventos::whereBetween('fecha', [date("Y-m-d"), date("Y")."-12-31"])
                        ->pluck('nombre','id');
        //$eventos =Eventos::all()->pluck('nombre','id');
        return view('clientes.llamar', compact('clientes','eventos'));
    }


    public function rellamar($id)
    {
        $clientes = Llamados::where('id_cliente', $id)->first();
        $eventos =Eventos::whereBetween('fecha', [date("Y-m-d"), date("Y")."-12-31"])
                        ->pluck('nombre','id');
        //$eventos =Eventos::all()->pluck('nombre','id');
       
        return view('clientes.rellamar', compact('clientes','eventos'));
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
        $centros = Clientes::findOrFail($id);
        $centros->update($request->all());
        return redirect()->route('admin.clientes.index1');
    }

    public function rellamarpost(Request $request)
    {
        $data = Llamados::findOrFail($request->input('id'));
        $newD = new Llamados;
        $newD->id_evento = $data->id_evento; 
        $newD->id_cliente = $data->id_cliente; 
        $newD->respuesta = $request->input('respuesta');
        $newD->observacion = $request->input('observacion');
        $newD->usuario = Auth::user()->id; 
        $newD->estatus = 'Rellamado';

        $newD->save();
        //Llamados::create($data);
       //$centros->update($request->all());
        return redirect()->route('admin.clientes.index1');
        //return redirect()->route('admin.llamados.index');
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $centros = Clientes::findOrFail($id);
        $centros->delete();

        return redirect()->route('admin.clientes.index1');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Clientes::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
