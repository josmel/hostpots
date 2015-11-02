
<?php
	header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
	header("Content-type:   application/x-msexcel; charset=utf-8");
	$fecha = new DateTime();
	$dato = $fecha->getTimestamp();
	header("Content-Disposition: attachment; filename=$dato.xls");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private", false);
?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>excel</title>
  </head>
  <body>
    <div class="table-responsive-vertical tablas">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Cod</th>
            <th>Tipo</th>
            <th>Destino</th>
            <th>Contacto</th>
            <th>Estado</th>
            <th>TimeStamp</th>
            <th>Fecha</th>
            <th>Reporte</th>
            <th>Tarifa</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($table as $value)
          	<tr>
          	<td style=" padding: 5px 0px 0px 100px;">{{$value->id}}</td>
          	<td style=" padding: 5px 0px 0px 195px;">{{$value->delivery_type_name}}</td>
          	<td style=" padding: 5px 0px 0px 215px;"> {{$value->destination_description}}</td>
          	<td style=" padding: 5px 0px 0px 215px;"> {{$value->contact_name}}</td>
          	<td style=" padding: 5px 0px 0px 215px;"> {{$value->delivery_state_name}}</td>
          	<td style=" padding: 5px 0px 0px 215px;"> {{$value->publish_time}}</td>
          	<td style=" padding: 5px 0px 0px 215px;"> {{$value->publish_date}}</td>
          	<td style=" padding: 5px 0px 0px 215px;"> {{$value->price}}</td>
          	</tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>