@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Ingresos Mensuales</h3>
   

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

         {!! Form::open(['method' => 'get', 'route' => ['index.ingresos']]) !!}



      <div class="row">
     
 <div class="col-md-3">
            {!! Form::label("mes","*Mes a Consultar",["class"=>""]) !!}
			          <div class="input-icon">
			            <div class="input-icon">
			              <i class="icon-eye  font-red"></i>

			              {!! Form::select('mes', ['01' => 'Enero', '02' => 'Febrero','03' => 'Marzo','04' => 'Abril','05' => 'Mayo','06' => 'Junio','07' => 'Julio','08' => 'Agosto','09' => 'Septiembre','10' => 'Octubre','11' => 'Noviembre','12' => 'Diciembre'], null, ['id'=>'mes', 'class'=>'form-control select2']) !!}
			            </div>

			          </div>
        </div>

        
         <div class="col-md-3">
             {!! Form::label('evento', 'Eventos*', ['class' => 'control-label']) !!}
                    {!! Form::select('evento', $eventos, old('eventos'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('evento'))
                        <p class="help-block">
                            {{ $errors->first('evento') }}
                        </p>
                    @endif
        </div>
      
     
        <div class="col-md-2">
            {!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
            {!! Form::close() !!}

        </div>
         <div class="col-md-2">
                     <p><strong>Mes Consultado: </strong>{{$mes}}</p>
                     <p><strong>Total Ingresos: </strong>{{$total->total}}</p>
            
        </div>
    </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($pagos) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>Cliente</th>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Tipo de Pago</th>
                        <th>Registrado Por:</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($pagos) > 0)
                        @foreach ($pagos as $ctr)
                            <tr data-entry-id="{{ $ctr->id }}">
                                <td></td>

                                <td>{{ $ctr->nomcliente }},{{ $ctr->apellido }}</td>
                                <td>{{ $ctr->evento }}</td>
                                <td>{{ $ctr->created_at }}</td>
                                <td>{{ $ctr->monto }}</td>
                                <td>{{ $ctr->tipo_pago }}</td>
                                <td>{{ $ctr->name }}</td>

                               
                                  

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop



