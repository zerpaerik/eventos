@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Clientes Llamados</h3>
  

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        {!! Form::open(['method' => 'get', 'route' => ['admin.llamados.index']]) !!}



      <div class="row">
      <div class="col-md-3">
            {!! Form::label('fecha', 'Fecha Inicio', ['class' => 'control-label']) !!}
            {!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('fecha'))
            <p class="help-block">
                {{ $errors->first('fecha') }}
            </p>
            @endif
        </div>
        <div class="col-md-3">
            {!! Form::label('fecha2', 'Fecha Fin', ['class' => 'control-label']) !!}
            {!! Form::date('fecha2', old('fecha2'), ['id'=>'fecha2','class' => 'form-control', 'placeholder' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('fecha2'))
            <p class="help-block">
                {{ $errors->first('fecha2') }}
            </p>
            @endif
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
        </div>
    </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($llamados) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>Cliente</th>
                        <th>Telèfono</th>
                        <th>Evento</th>
                        <th>Respuesta</th>
                        <th>Observaciòn</th>
                        <th>Fecha</th>
                        <th>Registrado Por:</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($llamados) > 0)
                        @foreach ($llamados as $ctr)
                            <tr data-entry-id="{{ $ctr->id }}">
                                <td></td>

                                <td>{{ $ctr->nomcliente }},{{ $ctr->apecliente }}</td>
                                <td>{{ $ctr->telefono }}</td>
                                <td>{{ $ctr->evento }}</td>
                                <td>{{ $ctr->respuesta }}</td>
                                <td>{{ $ctr->observacion }}</td>
                                <td>{{ $ctr->created_at }}</td>
                                <td>{{ $ctr->name }}</td>

                                <td>
                                    <a href="/clientes-rellamar-{{$ctr->id}}" class="btn btn-xs btn-info">Rellamar</a>
                                    
                                </td>

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

