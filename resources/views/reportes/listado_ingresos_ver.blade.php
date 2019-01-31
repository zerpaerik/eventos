<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reporte Mensual de Ingresos</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

	<p style="text-align: left;"><center><h1>REPORTE MENSUAL DE INGRESOS</h1></center></p>
	<br>
  <p style="margin-left: 15px;"><strong>MES: {{$mes}}</strong></p>


  
<table>
  <thead>
 <tr>
    <th>CLIENTE</th>
    <th>EVENTO</th>
    <th>FECHA</th>
    <th>MONTO</th>
    <th>TIPO DE PAGO</th>
    <th>REGISTRADO POR:</th>
  </tr>
 
  </thead>
  <tbody>
   @foreach($pagos as $recibo)
  <tr>
    <td>{{ $recibo->nomcliente.' '.$recibo->apellido}} </td>
    <td>{{ $recibo->evento}} </td>
    <td>{{ $recibo->created_at}} </td>
    <td>{{ $recibo->monto}} </td>
        <td>{{ $recibo->tipo_pago}} </td>
        <td>{{ $recibo->name}} </td>
  </tr>
  @endforeach
 </tbody>


<?php 



 ;?>


 <p><strong>TOTAL: {{$total->total}}</strong></p>
 



</table>


</body>
</html>

