<!DOCTYPE html><!--[if IE 7]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie7"></html><![endif]--><!--[if IE 8]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie8"></html><![endif]--><!--[if IE 9]>
<html lang="es" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" class="ie9"></html><![endif]-->
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="language" content="es">
    <title>Cligo</title>
    <meta name="title" content="Cligo">
    <meta name="description" content="Cligo">
    <meta name="author" content="@paulrrdiaz, @jeanpaul1304, @jonico22">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Keywords">
    <meta property="og:description" content="Cligo">
    <meta property="og:image" content="{{ URL::asset('/') }}/img/logo.png">
    <meta property="og:site_name" content="empty">
    <meta property="og:title" content="Cligo">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ URL::asset('/') }}">
    <link href="{{ URL::asset('/') }}/img/logo.png" rel="icon"><!--[if lte IE 9]>
    <link href="{{ asset('client/') }}/css/modules/all/ie.css" media="all" rel="stylesheet" type="text/css">
    <script src="{{ asset('client/') }}/js/dist/libs/selectivizr/selectivizr.js"></script>
    <script src="{{ asset('client/') }}/js/dist/libs/html5shiv/dist/html5shiv.js"></script><![endif]-->
    <link href="{{ asset('client/') }}/js/libs/datetimepicker/build/css/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="{{ asset('client/') }}/js/libs/datetimepicker/build/css/bootstrap-datetimepicker-standalone.css" media="all" rel="stylesheet" type="text/css">
    <link href="{{ asset('client/') }}/css/all.css" media="all" rel="stylesheet" type="text/css">
  </head>
  <body class="l-site">
    <aside class="l-nav">
      <nav class="nav">
        <ul>
          <li><i class="icon icon-perfil_off i-person"></i><span>{{Auth::customer()->user()->name_customer}}		</span></li>
          <li class="{{ Request::is('admclient/solicitar') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/solicitar') }}">
              <div class="bg_icon"><i class="icon icon-solicitar_servicio_off i-servicio"></i></div><span>Solicitar servicio</span></a></li>
          <li class="{{ Request::is('admclient/activos') ? 'activo' : '' }}"><a href="{{ action('Client\RequestController@getActivos') }}">
              <div class="bg_icon"><i class="icon icon-servicios_activos_off i-activos"></i></div><span>Servicios activos</span></a></li>
          <li class="{{ Request::is('admclient/completados') ? 'activo' : '' }}"><a href="{{ action('Client\RequestController@getCompletados') }}">
              <div class="bg_icon"><i class="icon icon-servicios_completados_off i-completados"></i></div><span>Servicios completados</span></a></li>
          <li class="{{ Request::is('admclient/perfil') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/perfil') }}">
              <div class="bg_icon"><i class="icon icon-perfil_off i-person"></i></div><span>Perfil</span></a></li>
          <li class="{{ Request::is('admclient/analytics') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/analytics') }}">
              <div class="bg_icon"><i class="icon icon-analytics_off i-analytics"></i></div><span>Analytics</span></a></li>
          <li class="{{ Request::is('admclient/soporte') ? 'activo' : '' }}"><a href="{{ URL::asset('admclient/soporte') }}">
              <div class="bg_icon"><i class="icon icon-soporte_off i-soporte"></i></div><span>Soporte</span></a></li>
        </ul>
      </nav>
    </aside>
    <div class="l-page">
      <header class="row">
        <div class="menu">
          <div class="menu-hamburger"></div>
        </div>
        <h1><a href="{{ URL::asset('admclient') }}"><img src="{{ asset('client/img/cligo.png') }}" alt=""></a></h1>
        <div class="credito"><a href="#"><i class="icon icon-dolar"></i></a>
          <p><span>CRÉDITO DISPONIBLE</span><br><strong>S./ {{Auth::customer()->user()->credit}}</strong></p>
        </div>
        <div class="logout"><a href="{{url('logout')}}"><span class="user">{{Auth::customer()->user()->name_customer}} -  &nbsp;&nbsp;</span><span class="off">DESLOGUEARSE</span><img src="{{ asset('client/img/salir.png') }}" alt=""></a></div>
      </header>
      <div id="wrapper">
        <div class="pasos">
          <ul class="service_unico row">
            <li class="active tipo"><a href="#" data-nom="paso1" class="btn_paso"><span class="btn_num num1">1</span><span class="txt_pasos">Tipo de envío</span></a></li>
            <li class="programa_reserva none"><a href="#" data-nom="reserva" class="disabled btn_paso"><span class="btn_num">2</span><span class="txt_pasos">Reserva						 						</span></a></li>
            <li class="origen"><a href="#" data-nom="paso2" class="disabled btn_paso"><span class="btn_num">2</span><span class="txt_pasos">Origen</span></a></li>
            <li class="destino"><a href="#" data-nom="paso3" class="disabled btn_paso"><span class="btn_num">3</span><span class="txt_pasos">Destino</span></a></li>
            <li class="descripcion"><a href="#" data-nom="paso4" class="disabled btn_paso"><span class="btn_num">4</span><span class="txt_pasos">Descripción</span></a></li>
            <li class="resumen"><a href="#" data-nom="paso5" class="disabled btn_paso"><span class="btn_num">5</span><span class="txt_pasos">Resumen</span></a></li>
            <p class="nombre_paso">Tipo de servicio	</p>
          </ul>
        </div>
        <div id="paso1" class="container_pasos">
          <div class="container">{!! Form::open(array('id'=>'formServicio','data-parsley-validate')) !!}
            <div class="opcion1">
              <div class="servicio1">
                {!! Form::radio('flagservice',1,true,array('id'=>'servicio01')) !!}
                {!! Form::label('servicio01','Servicio Normal') !!}
                <div class="txt_servicio row"><img src="{{asset('client/img/moto.png')}}" alt="">
                  <p>Solicita un repartidor para realizar un envío único. El repatidor llegará en 15 minutos .  </p>
                </div>
              </div>
              <div class="servicio2">
                {!! Form::radio('flagservice',2,false,array('id'=>'servicio02')) !!}
                {!! Form::label('servicio02','Servicio Por Hora') !!}
                <div class="txt_servicio row"><img src="{{asset('client/img/calendar.png')}}" alt="">
                  <p>Solicita un repatidor para realizar un servicio por horas. El repatidor llegará en 15 minutos para atenderte las horas que necesites.</p>
                </div>
              </div>
            </div>
            <div class="opcion2">
              {{--*/ $c = 1; /*--}}
              @foreach($deliveryType as $dt)
              <div class="{{'servicio'.$dt->id}}">
                {{--*/ $true = false; /*--}}
                @if($c == 1) {{--*/ $true = true; /*--}} @endif	
                {!! Form::radio('delivery_type_id',$dt->id,$true,array('id'=>"servicio_delivery_{$dt->id}")) !!}
                {!! Form::label("servicio_delivery_{$dt->id}",$dt->name) !!}
                <div class="txt_servicio row">
                  <p>{{$dt->description}}</p>
                </div>
              </div>{{--*/ $c += 1; /*--}}
              @endforeach
            </div>{!! Form::close() !!}
            <div class="new_design">
              <div class="opcion_columna1">
                <label style="margin-left: 64px;">Servicio inmediato</label>
                <div class="cat_input">
                  <input type="radio" name="opcion1" value="1" checked="checked">
                  <label>Envío único</label>
                  <div class="txt_servicio txt_servicio_new">
                    <p>Solicita un repartidor para realizar un envío único. El repartidor llegará en menos de 15 minutos.</p>
                  </div>
                </div>
                <div class="cat_input">
                  <input type="radio" name="opcion1" value="2">
                  <label>Por horas</label>
                  <div class="txt_servicio txt_servicio_new">
                    <p>Solicita un repartidor para realizar un servicio por horas. El repartidor llegará en menos de 15 minutos para atenderte las horas que necesites.</p>
                  </div>
                </div>
              </div>
              <div class="opcion_columna2">
                <label style="margin-left: 64px;">Servicio programado</label>
                <div class="cat_input">
                  <input type="radio" name="opcion2" value="1">
                  <label>Envío único</label>
                  <div class="txt_servicio txt_servicio_new">
                    <p>Programa un servicio para realizar un envío único. El repartidor llegará en la fecha y hora que tú elijas.</p>
                  </div>
                </div>
                <div class="cat_input">
                  <input type="radio" name="opcion2" value="2">
                  <label>Por horas</label>
                  <div class="txt_servicio txt_servicio_new">
                    <p>Programa un servicio para realizar un servicio por horas. El repartidor llegará en la fecha y hora que tú elijas para atenderte las horas que necesites.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="operacion_pasos"><a href="#" id="btn_paso1" class="btn">SIGUIENTE</a></div>
          </div>
        </div>
        <div id="reserva" class="none container_pasos">
          <div class="container">{!! Form::open(array('id'=>'formreserva','data-parsley-validate')) !!}
            <legend>Reserva</legend><br>
            <div class="programa">
              <div class="content_date">
                <label> <span>Desde</span><i class="icon icon-calendar"></i>
                  <input type="text" name="datefrom" id="datetimepicker1">
                </label>
                <label> <span>Hasta</span><i class="icon icon-calendar"></i>
                  <input type="text" name="dateto" id="datetimepicker2">
                </label>
                <label> <span>Hora</span><i class="icon icon-clock"></i>
                  <input type="text" name="time" id="date_time">
                </label><br><br>
              </div>
              <label class="content_hour"><span>Cantidad de horas</span>
                <input type="text" name="numberhour" required>
              </label><br><br>
              <div class="show_frecuencia">
                <legend>Repetir</legend>
                <div class="columna1">
                  <div class="box_helper"><span>x</span>
                    <p>Si eliges Repetir, tu servicio se quedará agendado y se repetirá automáticamente en las fechas y horas que escojas.</p>
                  </div>
                </div><br><br>
                <div class="content_day">
                  <div class="form-check">
                    <label>lunes</label>
                    <input type="checkbox" name="day[]" value="1" class="check_day">
                  </div>
                  <div class="form-check">
                    <label>Martes</label>
                    <input type="checkbox" name="day[]" value="2" class="check_day">
                  </div>
                  <div class="form-check">
                    <label>Miércoles</label>
                    <input type="checkbox" name="day[]" value="3" class="check_day">
                  </div>
                  <div class="form-check">
                    <label>Jueves</label>
                    <input type="checkbox" name="day[]" value="4" class="check_day">
                  </div>
                  <div class="form-check">
                    <label>Viernes</label>
                    <input type="checkbox" name="day[]" value="5" class="check_day">
                  </div>
                  <div class="form-check">
                    <label>Sábado</label>
                    <input type="checkbox" name="day[]" value="6" class="check_day">
                  </div>
                  <div class="form-check">
                    <label>Domingo</label>
                    <input type="checkbox" name="day[]" value="0" class="check_day">
                  </div>
                </div>
              </div>
            </div>{!! Form::close() !!}				
            <div class="operacion_pasos"><a href="#" id="btn_reg1" class="btn btn_regresar">REGRESAR</a><a href="#" id="btn_reserva" class="btn">SIGUIENTE							</a></div>
          </div>
        </div>
        <div id="paso2" class="none container_pasos">
          <div class="container">{!! Form::model($table,array('id'=>'formorigen','data-parsley-validate')) !!}
            <legend>Origen</legend><br>
            <div class="form-control">
              {!! Form::label(null,'Dirección de recojo (Ej. Calle Mozart 456, San Borja)') !!}
              {!! Form::text('address',old('address'),array('required','id'=>'dir01')) !!}
              {!! Form::hidden('latitude') !!}
              {!! Form::hidden('longitude') !!}
            </div><br>
            <div class="form-control">
              {!! Form::label(null,'Referencia') !!}
              {!! Form::textarea('description',old('description'),array('required','cols'=>'5', 'rows'=>'5')) !!}
            </div><br>
            <p>Persona de contacto</p><br>
            <div class="form-control">{!! Form::label(null,'Nombre y apellido') !!}
              <select name="contact_id" required class="combo_personal">
                <option value="">Seleccione</option>@foreach($contacts as $val)
                <option data-phone="{{$val->phone}}" data-cellphone="{{$val->cellphone}}" data-email="{{$val->email}}" value="{{$val->id}}">{{$val->name}}</option>@endforeach
              </select>
            </div><br>
            <div class="form-input">
              <label>Teléfono</label>
              <input type="number" name="phone" maxlength="9" data-parsley-type="digits" disabled class="disabled">
            </div>
            <div class="form-input form-email">
              <label>Email</label>
              <input type="text" name="email" data-parsley-type="email" disabled class="disabled">
            </div>{!! Form::close() !!}	
            <div class="map">
              <div id="map" data-lat="{{$table->latitude}}" data-lng="{{$table->longitude}}" class="google-map">		</div>
            </div>
            <div class="operacion_pasos"><a href="#" id="btn_reg2" class="btn btn_regresar">REGRESAR</a><a href="#" id="btn_paso2" class="btn">SIGUIENTE</a></div>
          </div>
        </div>
        <div id="paso3" class="none container_pasos">
          <div class="container">{!! Form::open(array('id'=>'formdestino','data-parsley-validate')) !!}
            <legend>Destino</legend><br>
            <div class="form-control">
              {!! Form::label('dest_address','Dirección de destino (Ej. Calle Mozart 456, San Borja)') !!}
              {!! Form::text('dest_address',old('dest_address'),array('required','id'=>'dir02')) !!}
              {!! Form::hidden('dest_latitude') !!}
              {!! Form::hidden('dest_longitude') !!}
            </div><br>
            <div class="form-control">
              {!! Form::label('dest_description','Referencia') !!}
              {!! Form::textarea('dest_description',old('dest_description'),array('required','cols'=>'5', 'rows'=>'5')) !!}
            </div><br>
            <p>Persona de contacto</p><br>
            <div class="form-control">
              {!! Form::label('contact_name','Nombre y apellido') !!}
              {!! Form::text('contact_name') !!}
            </div><br>
            <div class="form-input">
              {!! Form::label('contact_cellphone','Teléfono') !!}
              {!! Form::text('contact_cellphone',old('contact_cellphone'),array('required','type'=>'number','maxlength'=>'9','data-parsley-type'=>'digits')) !!}
            </div>
            <div class="form-input form-email">
              {!! Form::label('contact_email','Email') !!}
              {!! Form::text('contact_email',old('contact_email'),array('required','data-parsley-type'=>'email')) !!}
            </div>{!! Form::close() !!}	
            <div class="map">
              <div id="map2" data-lat="-12.0907838" data-lng="-77.0386785"></div>
            </div>
            <div class="operacion_pasos"><a href="#" id="btn_reg3" class="btn btn_regresar">REGRESAR					</a><a href="#" id="btn_paso3" class="btn">SIGUIENTE</a></div>
          </div>
        </div>
        <div id="paso4" class="none container_pasos">
          <div class="container">
            				
            {!! Form::open(array('id'=>'formcargo','data-parsley-validate')) !!}
            <legend>Descripción</legend><br>
            <div class="columna1"><span>- Descripción del pedido</span>
              <div class="form-control">
                {{--*/ $c = 1; /*--}}
                @foreach($category as $ca)
                {{--*/ $true = false; /*--}}
                @if($c == 1) {{--*/ $true = true; /*--}} @endif
                <label>{!! Form::radio('category_id',$ca->id,$true) !!}<span>{{$ca->name}}</span></label>{{--*/ $c += 1; /*--}}
                @endforeach
                <input type="text" name="category_other" id="txt_otros" class="none">
              </div><br><span>-Tipo de vehículo </span>
              <div class="form-control">
                {{--*/ $c = 1; /*--}}
                @foreach($vehicletype as $vt)
                {{--*/ $true = false; /*--}}
                @if($c == 1) {{--*/ $true = true; /*--}} @endif	
                <label>{!! Form::radio('vehicletype_id',$vt->id,$true) !!}<span>{{$vt->name}}</span></label>{{--*/ $c += 1; /*--}}
                @endforeach
              </div><br><br>
              <div class="contenedor_cobremos"><span>- ¿Necesitas que cobremos por ti?</span>
                <div class="form-control form-radio">
                  {{--*/ $c = 1; /*--}}
                  @foreach($paymenttype as $pt)
                  {{--*/ $true = false; /*--}}
                  @if($c == 1) {{--*/ $true = true; /*--}} @endif	
                  <label>{!! Form::radio('paymenttype_id',$pt->id,$true) !!}<span>{{$pt->name}}</span></label>{{--*/ $c += 1; /*--}}
                  @endforeach
                  <label id="txt_pago"><span>- ¿Con cuánto pagará tu cliente?</span><br>
                    <input type="text" name="pay" data-parsley-type="digits">
                  </label>
                </div>
              </div><br>
              <div class="contenedor_necesitas"><span>- ¿Necesitas un viaje de ida y vuelta?</span><br><br>
                <div class="form-control">
                  <label>{!! Form::radio('flagreturn',1,true) !!}<span>Sí</span></label>
                  <label>{!! Form::radio('flagreturn',0,false) !!}<span>No	</span></label>
                </div>
              </div>
            </div>
            <div class="columna2"><span>- Tarifa : </span>
              <div class="contenedor_tarifa"><span class="destino_tarifa"></span></div>
              <div class="form-control">
                <div id="Moto" class="box_helper"><span>x</span>
                  <p>Ten en cuenta que las motos pueden transportar hasta 10 kg y tu pedido deberá  entrar en la caja de la moto.</p>
                </div>
                <div id="Carro" class="box_helper none"><span>x</span>
                  <p>Ten en cuenta que tu pedido deberá entrar en la maletera del carro</p>
                </div>
                <div id="Bicicleta" class="box_helper none"><span>x</span>
                  <p>Ten en cuenta que tu pedido deberá entrar en la mochila del repartidor</p>
                </div>
              </div>
              <div class="contenedor_cobremos">
                <div class="form-control form-radio">
                  <div id="Efectivo" class="box_helper"><span>x</span>
                    <p>El repartidor llegará a tu local y pagará el pedido con el mismo monto que indicas. Deberás entregarle el pedido y el vuelto exacto solicitado por tu cliente. Monto máximo de S/. 200.00</p>
                  </div>
                  <div id="Pos" class="box_helper none"><span>x</span>
                    <p>El repartidor recogerá tu equipo POS inalámbrico, cobrará por ti y traerá de vuelta el equipo a tu local, con el recibo correspondiente.Todos los repartidores están capacitados en el uso del sistema POS Visa y Mastercard.</p>
                  </div>
                </div>
              </div>
              <div class="contenedor_necesitas">
                <div class="form-control">
                  <div id="ServiceSi" class="box_helper"><span>x</span>
                    <p>El repartidor recogerá tu equipo POS inalámbrico, cobrará por ti y traerá de vuelta el equipo a tu local.</p>
                  </div>
                </div>
              </div>
            </div><br><br>{!! Form::close() !!}
            <div class="operacion_pasos"><a href="#" id="btn_reg4" class="btn btn_regresar">REGRESAR			</a><a href="#" id="btn_paso4" class="btn">SIGUIENTE</a></div>
          </div>
        </div>
        <div id="paso5" class="none container_pasos">
          <div class="container">
            <div class="columna1">
              <div data-lat="" data-lng="" class="google-map"></div><br><br>
              <ul>
                <li>
                  <label>Dirección de origen</label><br><span class="destino_direccion_origen"> </span>
                </li>
                <li class="mostrar_direccion_destino">
                  <label>Dirección de destino</label><br><span class="destino_direccion_destino"></span>
                </li>
                <li class="service_ida_vuelta">
                  <label>Ida y vuelta</label><br><span class="destinoIdaVuelta">	 </span>
                </li>
                <li>
                  <label>Tipo de vehículo</label><br><span class="destino_tipo">Moto							</span>
                </li>
              </ul>
            </div>
            <div class="columna2">
              <ul>
                <li>
                  <label>Tarifa</label><br><span style="font-size:50px;" class="destino_tarifa"></span>
                </li>
                <li class="destinos_fechas">
                  <label>Fecha</label><br><span class="fechas"></span>
                </li>
                <li class="destino_hour">
                  <label>Hora</label><br><span class="horas"></span>
                </li>
                <li class="destino_horas">
                  <label>Número de horas</label><br><span class="numero_horas">2</span>
                </li>
                <li class="destino_frecuencia">
                  <label>Repetición</label><br><span class="total_frecuencia">No hay repetición				</span>
                </li>
                <li>
                  <label>Descripción del pedido</label><br><span class="destino_categoria">Comida</span>
                </li>
                <li class="service_cobro">
                  <label>Cobro de servicio</label><br><span class="destino_cobro">Cash</span>
                </li>
              </ul>
            </div>
            <div class="operacion_pasos"><a href="#" id="btn_reg5" class="btn btn_regresar">REGRESAR</a><a href="#" id="btn_paso5" class="btn btn-verde">ENVIAR</a></div>
          </div>
        </div>
        <div id="paso6" class="none container_pasos">
          <div class="container">
            <p>“Tu servicio ha sido registrado y puedes hacerle<br>seguimiento en “Pedidos Activos”.<br><br>El código de tu servicio es <span class="msg_solicitar">XXXXX</span></p>
          </div>
          <div class="operacion_pasos"><a href="#" id="btn_rein" class="btn ">REINTENTAR					</a><a href="{{ URL::asset('admclient/solicitar') }}" id="btn_otro" class="btn btn-verde">HACER OTRO PEDIDO							</a></div>
        </div>
      </div>
    </div>
    <script>
      window.alpha = {
      	module : 'index',
      	controller : 'solicitar',
      	action: 'solicitar'
      };
    </script>
    <script src="{{ asset('client/') }}/js/libs/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script data-main="{{ asset('client/') }}/js/main" src="{{ asset('client/') }}/js/libs/requirejs/require.js">			</script>
  </body>
</html>