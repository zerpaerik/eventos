@extends('layouts.app')

@section('content')
    <h3 class="page-title">Modificar Cliente</h3>
    
    {!! Form::model($clientes, ['method' => 'PUT', 'route' => ['admin.clientes.update', $clientes->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

   <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', 'Nombres*', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => 'Nombres', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
                </div>
                <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('apellido', 'Apellidos', ['class' => 'control-label']) !!}
                    {!! Form::text('apellido', old('apellido'), ['class' => 'form-control', 'placeholder' => ' Apellidos', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('apellido'))
                        <p class="help-block">
                            {{ $errors->first('apellido') }}
                        </p>
                    @endif
                </div>
            </div>

             <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>

          </div>

          <div class="row">

              <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('telefono', 'Telèfono', ['class' => 'control-label']) !!}
                    {!! Form::text('telefono', old('telefono'), ['class' => 'form-control', 'placeholder' => 'Telèfono', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('telefono'))
                        <p class="help-block">
                            {{ $errors->first('telefono') }}
                        </p>
                    @endif
                </div>
            </div>
              

          </div>
     
        
         
        
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

