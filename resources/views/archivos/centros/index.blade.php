@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.centros.title')</h3>
    <p>
        <a href="{{ route('admin.centros.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($centros) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.centros.fields.nombre')</th>
                        <th>@lang('global.centros.fields.direccion')</th>
                        <th>@lang('global.centros.fields.referencia')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($centros) > 0)
                        @foreach ($centros as $ctr)
                            <tr data-entry-id="{{ $ctr->id }}">
                                <td></td>

                                <td>{{ $ctr->name }}</td>
                                <td>{{ $ctr->direccion }}</td>
                                <td>{{ $ctr->referencia }}</td>
                                <td>
                                    <a href="{{ route('admin.centros.edit',[$ctr->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.centros.destroy', $ctr->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.centros.mass_destroy') }}';
    </script>
@endsection
