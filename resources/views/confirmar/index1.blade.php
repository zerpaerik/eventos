@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Clientes Confirmados</h3>


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($confirmar) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Telèfono</th>
                        <th>Evento</th>
                        <th>Respuesta</th>
                        <th>Observaciòn</th>
                        <th>Fecha</th>
                        <th>Registrado Por:</th>
                        <th>Estatus:</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($confirmar) > 0)
                        @foreach ($confirmar as $ctr)
                            <tr>

                                <td>{{ $ctr->nomcliente }},{{ $ctr->apecliente }}</td>
                                <td>{{ $ctr->telefono }}</td>
                                <td>{{ $ctr->evento }}</td>
                                <td>{{ $ctr->respuesta }}</td>
                                <td>{{ $ctr->observacion }}</td>
                                <td>{{ $ctr->created_at }}</td>
                                <td>{{ $ctr->name }}</td>
                                <td style="background: #58FA82;">{{ $ctr->estatus }}</td>
                    
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


