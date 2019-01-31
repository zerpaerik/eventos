@extends('layouts.app')

@section('content')
    <h3 class="page-title">Asistente</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.asistencia.store']]) !!}
    @include("messages.messages")


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                 <div class="col-xs-12 form-group">
                    {!! Form::label('cliente', 'Cliente*', ['class' => 'control-label']) !!}
                    {!! Form::select('cliente', $clientes, old('descripcion'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cliente'))
                        <p class="help-block">
                            {{ $errors->first('cliente') }}
                        </p>
                    @endif
                </div>
                </div>
                <div class="col-md-4">
                 <div class="col-xs-12 form-group">
                    {!! Form::label('evento', 'Eventos*', ['class' => 'control-label']) !!}
                    {!! Form::select('evento', $eventos, old('eventos'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('evento'))
                        <p class="help-block">
                            {{ $errors->first('evento') }}
                        </p>
                    @endif

            </div>
             </div>

        </div>


          




     
        
         
        
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

