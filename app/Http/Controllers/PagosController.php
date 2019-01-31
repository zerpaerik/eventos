<?php

namespace App\Http\Controllers;

use App\Pagos;
use App\Eventos;
use App\Clientes;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class PagosController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


            if((! is_null($request->evento)) && (! is_null($request->fecha)) && (! is_null($request->fecha2)) ) {



         $pagos = DB::table('pagos as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.monto','a.tipo_pago','a.usuario','b.name','c.nombre as nomcliente','c.apellido','d.nombre','c.telefono','d.nombre as evento','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
         ->where('a.id_evento','=',$request->evento)
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();

    } else if((! is_null($request->fecha)) && (! is_null($request->fecha2))) {

           $pagos = DB::table('pagos as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.monto','a.tipo_pago','a.usuario','b.name','c.nombre as nomcliente','c.apellido','d.nombre','c.telefono','d.nombre as evento','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
        ->get();

    } elseif (! is_null($request->evento)) {


         $pagos = DB::table('pagos as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.monto','a.tipo_pago','a.usuario','b.name','c.nombre as nomcliente','c.apellido','d.nombre','c.telefono','d.nombre as evento','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
         ->where('a.id_evento','=',$request->evento)
        ->get();

} else {

      $pagos = DB::table('pagos as a')
        ->select('a.id','a.id_cliente','a.id_evento','a.monto','a.tipo_pago','a.usuario','b.name','c.nombre as nomcliente','c.apellido','d.nombre','c.telefono','d.nombre as evento','a.created_at')
        ->join('users as b','b.id','a.usuario')
        ->join('clientes as c','c.id','a.id_cliente')
        ->join('eventos as d','d.id','a.id_evento')
        ->get();



}




            $eventos =Eventos::all()->pluck('nombre','id');


        return view('pagos.index', compact('pagos','eventos'));
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

         $clientes   = Clientes::select(
             DB::raw("CONCAT(apellido,' ',nombre,' Telef:',telefono) AS descripcion"),'id')                  
                             ->orderby('apellido','ASC')
                             ->get()->pluck('descripcion','id');
    $eventos =Eventos::all()->pluck('nombre','id');

        return view('pagos.create',compact('clientes','eventos'));
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
  
          
        ]);



       $pagos = new Pagos;
       $pagos->id_evento =$request->id_evento;
       $pagos->id_cliente     =$request->id_cliente;
       $pagos->tipo_pago     =$request->tipo_pago;
       $pagos->monto     =$request->monto;
       $pagos->usuario = Auth::id();
       $pagos->save();


        return redirect()->route('admin.pagos.index');
        return redirect()->back()->with("success", "EL PAGO FUE REGISTRADO EXITOSAMENTE");

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

        $pagos = Pagos::findOrFail($id);
        $clientes   = Clientes::select(
             DB::raw("CONCAT(apellido,' ',nombre) AS descripcion"),'id')                  
                             ->orderby('apellido','ASC')
                             ->get()->pluck('descripcion','id');
        $eventos =Eventos::all()->pluck('nombre','id');


        return view('pagos.edit', compact('pagos','clientes','eventos'));
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



        $pagos = Pagos::findOrFail($id);
        $pagos->update($request->all());

   
       
        return redirect()->route('admin.pagos.index');
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
        $pagos = Pagos::findOrFail($id);
        $pagos->delete();

        return redirect()->route('admin.pagos.index');
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
            $entries = Pagos::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
