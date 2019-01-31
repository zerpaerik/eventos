@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
   <div class="row">
	<div id="paginacion">
		<div class="col-md-8 col-sm-8 col-xs-8">
			<div class="card">
				<div class="card-action">
				<div class="col s6">
					<h3>Reporte Mensual de Ingresos</h3>
				</div>	
				 {!! Form::open(['method' => 'GET', 'route' => ['listado_ingresos_ver']]) !!}

				<div class="input-field col s6">
				</div>
				</div>
				<div class="row">
					 <div class="col-xs-6 form-group">
                 {!! Form::label("mes","*Mes a Consultar",["class"=>""]) !!}
			          <div class="input-icon">
			            <div class="input-icon">
			              <i class="icon-eye  font-red"></i>

			              {!! Form::select('mes', ['01' => 'Enero', '02' => 'Febrero','03' => 'Marzo','04' => 'Abril','05' => 'Mayo','06' => 'Junio','07' => 'Julio','08' => 'Agosto','09' => 'Septiembre','10' => 'Octubre','11' => 'Noviembre','12' => 'Diciembre'], null, ['id'=>'mes', 'class'=>'form-control select2']) !!}
			            </div>

			          </div>
            </div>
					
					<div class="col-md-4">
						

					</div>
				</div>
			
			</div>
		</div>
			<div class="col-md-8 col-sm-8 col-xs-8 edit">

			</div>
	</div>

</div>

<!-- Recursos javascript-ajax -->

 {!! Form::submit(trans('global.app_search'), array('class' => 'btn btn-danger')) !!}
 {!! Form::close() !!}
@stop

@section('javascript') 
   
@endsection
