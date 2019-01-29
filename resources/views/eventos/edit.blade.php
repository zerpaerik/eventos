@extends('layouts.app')

@section('content')
    <h3 class="page-title">Modificar Evento</h3>
    
    {!! Form::model($eventos, ['method' => 'PUT', 'route' => ['admin.eventos.update', $eventos->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>
  <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nombre', 'Nombre de Evento*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('descripcion', 'Descrpciòn', ['class' => 'control-label']) !!}
                    {!! Form::text('descripcion', old('descripcion'), ['class' => 'form-control', 'placeholder' => 'Descripciòn de Evento', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('descripcion'))
                        <p class="help-block">
                            {{ $errors->first('descripcion') }}
                        </p>
                    @endif
                </div>
            </div>

             <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('responsable', 'Responsable', ['class' => 'control-label']) !!}
                    {!! Form::text('responsable', old('responsable'), ['class' => 'form-control', 'placeholder' => 'Responsable de Evento', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('responsable'))
                        <p class="help-block">
                            {{ $errors->first('responsable') }}
                        </p>
                    @endif
                </div>
            </div>

          </div>

          <div class="row">

              <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('fecha', 'Fecha', ['class' => 'control-label']) !!}
                    {!! Form::date('fecha', old('fecha'), ['class' => 'form-control', 'placeholder' => 'Fecha de Evento', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('fecha'))
                        <p class="help-block">
                            {{ $errors->first('fecha') }}
                        </p>
                    @endif
                </div>
            </div>

             <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('capacidad', 'Capacidad', ['class' => 'control-label']) !!}
                    {!! Form::text('capacidad', old('capacidad'), ['class' => 'form-control', 'placeholder' => 'Capacidad de Evento', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('capacidad'))
                        <p class="help-block">
                            {{ $errors->first('capacidad') }}
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

