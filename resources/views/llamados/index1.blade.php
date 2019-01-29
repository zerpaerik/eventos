@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Listado de Clientes a Llamar</h3>
  

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
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
                                    <a href="/clientes-llamar-{{$ctr->id}}" class="btn btn-xs btn-info">Llamar</a>
                                    
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


