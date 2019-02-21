@extends('layouts.app')

@section('content')
    <h3 class="page-title">Rellamada a Cliente</h3>
    
    {!! Form::model($clientes, ['method' => 'PUT', 'route' => ['admin.rellamar.update', $clientes->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

   <div class="panel-body">
          
       						<input type="hidden" name="id" value="{{$clientes->id}}">

          <div class="row">
             <div class="col-md-4">
              <div class="col-xs-12 form-group">
                 {!! Form::label("respuesta","*Respuesta",["class"=>""]) !!}
			          <div class="input-icon">
			            <div class="input-icon">
			              <i class="icon-eye  font-red"></i>

			              {!! Form::select('respuesta', ['0' => 'Seleccione una Opciòn','Asiste' => 'Asiste', 'No Asiste' => 'No Asiste','SMS' => 'SMS','Por Confirmar' => 'Por Confirmar','Equivocado' => 'Equivocado'], null, ['id'=>'respuesta', 'class'=>'form-control select2']) !!}
			            </div>

			          </div>
            </div>

            </div>


             <div class="col-md-4">
                <div class="col-xs-12 form-group">
                    {!! Form::label('observacion', 'Observacion', ['class' => 'control-label']) !!}
                    {!! Form::text('observacion', old('observacion'), ['class' => 'form-control', 'placeholder' => 'Observaciòn', 'required' => 'false']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('observacion'))
                        <p class="help-block">
                            {{ $errors->first('observacion') }}
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

