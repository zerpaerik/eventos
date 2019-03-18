@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Clientes</h3>
    <p>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" style="background: #DF01A5;" data-toggle="modal" data-target="#myModal">
            @lang('global.app_add_new')
        </button>
        <!--a href="{{ route('admin.clientes.create') }}" class="btn btn-success" style="background: #DF01A5;">@lang('global.app_add_new')</a-->
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="create">
                        <div class="col-xs-12 text-red help-error-g" style="display:none">
                            Verifique la información suminstrada
                        </div>
                        <div class="col-xs-12 text-success help-error-s" style="display:none">
                            El cliente ha sido registrado, por favor espere. 
                        </div>
                        <div class="col-xs-12 text-red help-error-e" style="display:none">
                            El cliente no ha sido registrado.
                        </div>

                        <div class="col-xs-12 form-group">
                            {!! Form::label('nombre', 'Nombre', ['class' => 'control-label']) !!}
                            {!! Form::text('nombre', '', ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                            <p class="col-xs-12 help-block help-error-n text-red"></p>
                        </div>
                        <div class="col-xs-12 form-group">
                            {!! Form::label('apellido', 'Apellidos', ['class' => 'control-label']) !!}
                            {!! Form::text('apellido', '', ['class' => 'form-control', 'placeholder' => ' Apellidos']) !!}
                            <p class="col-xs-12 help-block help-error-a text-red"></p>
                        </div>
                        <div class="col-xs-12 form-group">
                            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                            {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                            <p class="col-xs-12 help-block help-error-e text-red"></p>
                        </div>
                        <div class="col-xs-12 form-group">
                            {!! Form::label('telefono', 'Teléfono', ['class' => 'control-label']) !!}
                            {!! Form::text('telefono', '', ['class' => 'form-control', 'placeholder' => 'Número']) !!}
                            <p class="col-xs-12 help-block help-error-nu text-red"></p>
                        </div>
                        <div class="col-xs-12 form-group">
                            {!! Form::label('evento', 'Eventos', ['class' => 'control-label']) !!}
                            <br>
                            {!! Form::select('evento', $eventos, '', ['class' => 'form-control select2', 'style' => 'width: 100%']) !!}
                        </div>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary save">@lang('global.app_save')</button>
            </div>
            </div>
        </div>
    </div>
@stop

@section('javascript') 

    <script>
        $(document).ready(function(){
            $.mask.definitions['h'] = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}";
            $('#telefono').mask('(+51) 999999999');
            $('#email').blur(function(){
                $('.help-error-g, .help-error-eg').hide();
                var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                let d = $(this).val();
                if(d.trim() == ''){
                    $('.help-error-e').html('El campo es requerido');
                } else if(!regex.test($('#email').val().trim())){
                    $('.help-error-e').html('El Email no es valido.');
                } else {
                    $('.help-error-e').html('');
                }
            });

            $('#nombre, #apellido, #telefono').blur(function(){
                $('.help-error-g, .help-error-eg').hide();
                let d = $(this).val();
                let c = $(this).attr('id');
                c = c.charAt(0);
                if(d.trim() == ''){
                    $('.help-error-'+c).html('El campo es requerido');
                } else if(d.length <= 2){
                    $('.help-error-'+c).html('El valor del campo es muy corto');
                } else {
                    $('.help-error-'+c).html('');
                }
            });

            $('#telefono').blur(function(){
                $('.help-error-g, .help-error-eg').hide();
                let d = $(this).val();
                let c = $(this).attr('id');
                c = c.charAt(0);
                if(d.trim() == ''){
                    $('.help-error-nu').html('El campo es requerido');
                } else {
                    $('.help-error-nu').html('');
                }
            });
        });

        $(document).on('click', '.save', function (e) {
            e.preventDefault();
            var nom = $("#nombre").val();
            var ape = $("#apellidos").val();
            var email = $("#email").val();
            var tel = $("#telefono").val();
            var event = $("#evento").val();
        
            if(nom == '' || ape == '' || email == '' || tel == ''){
                $('.help-error-g').show();
            }else {
                $.ajax({                        
                    type: "POST",                 
                    url: "{{ route('admin.clientes.store') }}",                    
                    data: $("form.create").serialize(),
                    success: function(data)            
                    {
                        if (data == 1) {
                            $('.help-error-s').show();
                            setTimeout(() => {
                                window.location = "./index1";
                            }, 3000); 
                        } else {
                            $('.help-error-eg').show();
                        }       
                    }
                });
            }
        });

    

        window.route_mass_crud_entries_destroy = '{{ route('admin.clientes.mass_destroy') }}';
    </script>
@endsection
