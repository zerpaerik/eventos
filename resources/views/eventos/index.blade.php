@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Eventos</h3>
    <p>
        <a href="{{ route('admin.eventos.create') }}" class="btn btn-success" style="background: #DF01A5;">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($eventos) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>Nombre del Evento</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Capacidad</th>
                        <th>Responsable</th>
                        <th>Registrado Por:</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($eventos) > 0)
                        @foreach ($eventos as $ctr)
                            <tr data-entry-id="{{ $ctr->id }}">
                                <td></td>

                                <td>{{ $ctr->nombre }}</td>
                                <td>{{ $ctr->descripcion }}</td>
                                <td>{{ $ctr->fecha }}</td>
                                <td>{{ $ctr->capacidad }}</td>
                                <td>{{ $ctr->responsable }}</td>
                                <td>{{ $ctr->name }}</td>

                                <td>
                                    <a href="{{ route('admin.eventos.edit',[$ctr->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.eventos.destroy', $ctr->id])) !!}
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
