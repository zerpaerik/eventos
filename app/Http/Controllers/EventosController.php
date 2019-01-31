<?php

namespace App\Http\Controllers;

use App\Eventos;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class EventosController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

         $eventos = DB::table('eventos as a')
        ->select('a.id','a.nombre','a.responsable','a.fecha','a.descripcion','a.capacidad','a.usuario','b.name')
        ->join('users as b','b.id','a.usuario')
        ->get();

        return view('eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        return view('eventos.create');
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
  
          
        ]);

    
       $eventos = new Eventos;
       $eventos->nombre =$request->nombre;
       $eventos->descripcion     =$request->descripcion;
       $eventos->capacidad     =$request->capacidad;
       $eventos->fecha     =$request->fecha;
       $eventos->responsable     =$request->responsable;
       $eventos->usuario = Auth::id();
       $eventos->save();


        return redirect()->route('admin.eventos.index');
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
        

        $eventos = Eventos::findOrFail($id);

        return view('eventos.edit', compact('eventos'));
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
        


        $eventos = Eventos::findOrFail($id);
        $eventos->update($request->all());

   
       
        return redirect()->route('admin.eventos.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $eventos = Eventos::findOrFail($id);
        $eventos->delete();

        return redirect()->route('admin.eventos.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        
        if ($request->input('ids')) {
            $entries = Eventos::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
