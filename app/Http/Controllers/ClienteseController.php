<?php

namespace App\Http\Controllers;

use App\Clientes;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class ClienteseController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


         $clientes = DB::table('clientes as a')
        ->select('a.id','a.nombre','a.apellido','a.telefono','a.email','a.usuario','a.evento','b.name')
        ->join('users as b','b.id','a.usuario')
        ->join('eventos as c','c.id','a.evento')
        ->get();

        return view('clientese.index', compact('clientes'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return view('clientes.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

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
       $clientes->usuario = Auth::id();
       $clientes->save();

       }   


        return redirect()->route('admin.clientes.index');
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
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $clientes = Clientes::findOrFail($id);

        return view('clientes.edit', compact('clientes'));
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
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }



        $centros = Clientes::findOrFail($id);
        $centros->update($request->all());

   
       
        return redirect()->route('admin.clientes.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $centros = Clientes::findOrFail($id);
        $centros->delete();

        return redirect()->route('admin.clientes.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Clientes::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
