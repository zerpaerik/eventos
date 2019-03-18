@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Clientes</h3>
    <p>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-success" style="background: #DF01A5;">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        {!! Form::open(['method' => 'get', 'route' => ['admin.clientes.index1']]) !!}



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

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($clientes) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Telèfono</th>
                        <th>Evento</th>
                        <th>Registrado Por:</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($clientes) > 0)
                        @foreach ($clientes as $ctr)
                            <tr data-entry-id="{{ $ctr->id }}">
                                <td></td>

                                <td>{{ $ctr->nombre }}</td>
                                <td>{{ $ctr->apellido }}</td>
                                <td>{{ $ctr->email }}</td>
                                <td>{{ $ctr->telefono }}</td>
                                <td>{{ $ctr->evento }}</td>
                                <td>{{ $ctr->name }}</td>

                                <td>
                                    <a href="{{ route('admin.clientes.edit',[$ctr->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @if($ctr->llamado == 'SI')
                                        <a href="/clientes-rellamar-{{$ctr->id}}" class="btn btn-xs btn-info">@lang('global.app_redial')</a>
                                    @else
                                        <a href="/clientes-llamar-{{$ctr->id}}" class="btn btn-xs btn-info">@lang('global.app_called')</a>
                                    @endif
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clientes.destroy', $ctr->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
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

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.clientes.mass_destroy') }}';
    </script>
@endsection
