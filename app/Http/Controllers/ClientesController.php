<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Eventos;
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
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
         ->where('a.evento','=',$request->evento)
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();

        } else if((! is_null($request->fecha)) && (! is_null($request->fecha2))) {

             $clientes = DB::table('clientes as a')
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();


        } elseif (! is_null($request->evento)) {

               $clientes = DB::table('clientes as a')
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
                 ->where('a.evento','=',$request->evento)
        ->get();

    } else {


             $clientes = DB::table('clientes as a')
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.created_at','a.usuario','a.evento','b.name','c.nombre as evento','a.llamado')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
        ->where('a.created_at','=',date('Y-m-d'))
        ->get();




    }





    $eventos =Eventos::all()->pluck('nombre','id');

        return view('clientes.index1', compact('clientes','eventos'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $eventos =Eventos::all()->pluck('nombre','id');

    

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

          $validator = \Validator::make($request->all(), [
          'nombre' => 'required|string|max:255',
          'apellido' => 'required|string|max:255',
		   'telefono' => 'required|unique:clientes'
          
        ]);

        if($validator->fails()) {

       return redirect()->back()->with("error", " EL TELEFONO INTRODUCIDO YA ESTA REGISTRADO PARA UN CLIENTE");
        
        } else {


       $clientes = new Clientes;
       $clientes->nombre =$request->nombre;
       $clientes->apellido     =$request->apellido;
       $clientes->telefono     =$request->telefono;
       $clientes->email= $request->email;
       $clientes->evento= $request->evento;
       $clientes->usuario = Auth::id();
       $clientes->save();

       }   


        return redirect()->route('admin.clientes.index1');
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
        

        $clientes = Clientes::findOrFail($id);

                $eventos =Eventos::all()->pluck('nombre','id');


        return view('clientes.edit', compact('clientes','eventos'));
    }

      public function llamar($id)
    {
       

        $clientes = Clientes::findOrFail($id);

                $eventos =Eventos::all()->pluck('nombre','id');


        return view('clientes.llamar', compact('clientes','eventos'));
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
