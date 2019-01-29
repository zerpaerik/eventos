@extends('layouts.app')

@section('content')
    <h3 class="page-title">Registrar Pago</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.pagos.store']]) !!}
    @include("messages.messages")


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                 <div class="col-xs-12 form-group">
                    {!! Form::label('id_cliente', 'Cliente*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_cliente', $clientes, old('descripcion'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_cliente'))
                        <p class="help-block">
                            {{ $errors->first('id_cliente') }}
                        </p>
                    @endif
                </div>
                </div>
                <div class="col-md-4">
                 <div class="col-xs-12 form-group">
                    {!! Form::label('id_evento', 'Eventos*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_evento', $eventos, old('eventos'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_evento'))
                        <p class="help-block">
                            {{ $errors->first('id_evento') }}
                        </p>
                    @endif

            </div>
             </div>

             <div class="col-md-4">
              <div class="col-xs-12 form-group">
                 {!! Form::label("tipo_pago","*Tipo de Pago",["class"=>"control-label"]) !!}
			          <div class="input-icon">
			            <div class="input-icon">
			              <i class="icon-eye  font-red"></i>
			              {!! Form::select('tipo_pago', ['0' => 'Seleccione una Opciòn','EF' => 'EFECTIVO', 'DEP' => 'DEPOSITO'], null, ['id'=>'tipo_pago', 'class'=>'form-control select2']) !!}
			            </div>

			          </div>
            </div>

            </div>

        </div>


            
             <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('monto', 'Monto a Pagar', ['class' => 'control-label']) !!}
                    {!! Form::text('monto', old('monto'), ['class' => 'form-control', 'placeholder' => 'Monto a Pagar', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('monto'))
                        <p class="help-block">
                            {{ $errors->first('monto') }}
                        </p>
                    @endif
                </div>
            </div>




     
        
         
        
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

