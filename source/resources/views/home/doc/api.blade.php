<!DOCTYPE HTML><html><head><title>Doc Ws Cligo API documentation</title><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="generator" content="https://github.com/kevinrenskers/raml2html 1.0.4"><link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"><link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.1/styles/default.min.css"><script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script><script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.1/highlight.min.js"></script><script type="text/javascript">
        $(document).ready(function() {
            $('.page-header pre code, .top-resource-description pre code').each(function(i, block) {
                hljs.highlightBlock(block);
            });

            $('[data-toggle]').click(function() {
                var selector = $(this).data('target') + ' pre code';
                $(selector).each(function(i, block) {
                    hljs.highlightBlock(block);
                });
            });
        });
    </script><style>
        .hljs {
            background: transparent;
        }
        .parent {
            color: #999;
        }
        .list-group-item > .badge {
            float: none;
            margin-right: 6px;
        }
        .panel-title > .methods {
            float: right;
        }
        .badge {
            border-radius: 0;
            text-transform: uppercase;
            width: 70px;
            font-weight: normal;
            color: #f3f3f6;
            line-height: normal;
        }
        .badge_get {
            background-color: #63a8e2;
        }
        .badge_post {
            background-color: #6cbd7d;
        }
        .badge_put {
            background-color: #22bac4;
        }
        .badge_delete {
            background-color: #d26460;
        }
        .list-group, .panel-group {
            margin-bottom: 0;
        }
        .panel-group .panel+.panel-white {
            margin-top: 0;
        }
        .panel-group .panel-white {
            border-bottom: 1px solid #F5F5F5;
            border-radius: 0;
        }
        .panel-white:last-child {
            border-bottom-color: white;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .panel-white .panel-heading {
            background: white;
        }
        .tab-pane ul {
            padding-left: 2em;
        }
        .tab-pane h2 {
            font-size: 1.2em;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }
        .tab-pane h3 {
            font-size: 1.1em;
        }
        .tab-content {
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        #sidebar {
            margin-top: 30px;
        }
        .top-resource-description {
            border-bottom: 1px solid #ddd;
            background: #fcfcfc;
            padding: 15px 15px 0 15px;
            margin: -15px -15px 10px -15px;
        }
        .resource-description {
            border-bottom: 1px solid #fcfcfc;
            background: #fcfcfc;
            padding: 15px 15px 0 15px;
            margin: -15px -15px 10px -15px;
        }
        .resource-description p:last-child {
            margin: 0;
        }
        .list-group .badge {
            float: left;
        }
        .method_description {
            margin-left: 85px;
        }
        .method_description p:last-child {
            margin: 0;
        }
        .list-group-item {
            cursor: pointer;
        }
        .list-group-item:hover {
            background-color: #f5f5f5;
        }
    </style></head><body data-spy="scroll" data-target="#sidebar"><div class="container"><div class="row"><div class="col-md-9" role="main"><div class="page-header"><h1>Doc Ws Cligo API documentation <small>version v1</small></h1><p>http://devcligo.osp.pe/wservice/</p><h3 id="Sobre-los-servicios"><a href="#Sobre-los-servicios">Sobre los servicios</a></h3><p>En este documento se encuentra todo los servicios web relacionados al proyecto "Cligo"</p></div><div class="panel panel-default"><div class="panel-heading"><h3 id="_driver" class="panel-title">/driver</h3></div><div class="panel-body"><div class="panel-group"><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" href="#panel__driver_login"><span class="parent">/driver</span>/login</a> <span class="methods"><a href="#" data-toggle="modal" data-target="#_driver_login_post"><span class="badge badge_post">post</span></a></span></h4></div><div id="panel__driver_login" class="panel-collapse collapse"><div class="panel-body"><div class="resource-description"><p>Login de los motorizados</p></div><div class="list-group"><div data-toggle="modal" data-target="#_driver_login_post" class="list-group-item"><span class="badge badge_post">post</span><div class="method_description"><p>Loguearse</p></div><div class="clearfix"></div></div></div></div></div><div class="modal fade" tabindex="0" id="_driver_login_post"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_post">post</span> <span class="parent">/driver</span>/login</h4></div><div class="modal-body"><div class="alert alert-info"><p>Loguearse</p></div><ul class="nav nav-tabs"><li class="active"><a href="#_driver_login_post_request" data-toggle="tab">Request</a></li><li><a href="#_driver_login_post_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="_driver_login_post_request"><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Schema</strong>:</p><pre><code>{
      "$schema": "http://json-schema.org/draft-03/schema",
      "type": "object",
      "properties": {
          "email": {
              "type": "string",
              "required": true
          },
          "password": {
              "type": "string",
              "required": true
          },
          "uuid": {
              "type": "string",
              "required": true
          }
      }
    }
    </code></pre><p><strong>Example</strong>:</p><pre><code>{
      "email":"rolly@osp.pe", 
      "password":"123456", 
      "uuid":"as3dad23asd21321sdfsd3f"
    }
    </code></pre></div><div class="tab-pane" id="_driver_login_post_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><h3>Headers</h3><ul><li><strong>_token</strong>: <em>(string)</em><p>token para los posteriores request</p><p><strong>Example</strong>:</p><pre>dsg5645sfd6gas5dk65hsad6kjh6sak2dhs2akj2dhaks</pre></li></ul><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
      "status": 1,
      "msg": "ok",
      "data": {
          "id": "2",
          "vehicletype_id": "0",
          "uuid": "as3dad23asd21321sdfsd3f",
          "namedriver": "Alfred",
          "lastname": "B",
          "phone": "123456",
          "email": "a@b.com",
          "flagbussy": null,
          "flagactive": "1",
          "datecreate": null,
          "datedelete": null,
          "lastupdate": null
      },
      "data_error": []
    }
    </code></pre></div></div></div></div></div></div></div></div></div></div><div class="panel panel-default"><div class="panel-heading"><h3 id="_delivery" class="panel-title">/delivery</h3></div><div class="panel-body"><div class="panel-group"><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" href="#panel__delivery__status_id___year___month___day_"><span class="parent">/delivery</span>/{status_id}/{year}/{month}/{day}</a> <span class="methods"><a href="#" data-toggle="modal" data-target="#_delivery__status_id___year___month___day__get"><span class="badge badge_get">get</span></a></span></h4></div><div id="panel__delivery__status_id___year___month___day_" class="panel-collapse collapse"><div class="panel-body"><div class="resource-description"><p>Lista de Servicios/Deliveries</p></div><div class="list-group"><div data-toggle="modal" data-target="#_delivery__status_id___year___month___day__get" class="list-group-item"><span class="badge badge_get">get</span><div class="method_description"><p>Lista en formato JSon</p></div><div class="clearfix"></div></div></div></div></div><div class="modal fade" tabindex="0" id="_delivery__status_id___year___month___day__get"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_get">get</span> <span class="parent">/delivery</span>/{status_id}/{year}/{month}/{day}</h4></div><div class="modal-body"><div class="alert alert-info"><p>Lista en formato JSon</p></div><ul class="nav nav-tabs"><li class="active"><a href="#_delivery__status_id___year___month___day__get_request" data-toggle="tab">Request</a></li><li><a href="#_delivery__status_id___year___month___day__get_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="_delivery__status_id___year___month___day__get_request"><h3>URI Parameters</h3><ul><li><strong>status_id</strong>: <em>required (integer)</em><p>Status : 1 2</p><p><strong>Example</strong>:</p><pre><code>1</code></pre></li><li><strong>year</strong>: <em>required (string)</em><p>A_o : 2015 0000 : Todos</p><p><strong>Example</strong>:</p><pre>2015</pre></li><li><strong>month</strong>: <em>required (string)</em><p>Mes : 07 00 : Todos</p><p><strong>Example</strong>:</p><pre>7</pre></li><li><strong>day</strong>: <em>required (string)</em><p>Dia : 05 00 : Todos</p><p><strong>Example</strong>:</p><pre>5</pre></li></ul></div><div class="tab-pane" id="_delivery__status_id___year___month___day__get_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><p>Lista</p><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
      "status": 1,
      "msg": "ok",
      "data": [
        {
          "id": 9,
          "delivery_type_id": 2,
          "delivery_type_name": "Por hora",
          "delivery_state_id": 1,
          "delivery_state_name": "waiting",
          "datestart": "2015-03-03 00:00:00",
          "destination_description": "arequipa",
          "destination_address": "Arequipa, Miraflores, Lima, Peru",
          "publish_date": "2015-03-03",
          "publish_time": "00:00:00",
          "price": 205.25,
          "contact_name": "motor 1",
          "contact_phone": "999"
        },
        {
          "id": 10,
          "delivery_type_id": 2,
          "delivery_type_name": "Por hora",
          "delivery_state_id": 1,
          "delivery_state_name": "waiting",
          "datestart": "2015-09-22 23:29:21",
          "destination_description": "breña",
          "destination_address": "Breña, Lima, Peru",
          "publish_date": "2015-09-22",
          "publish_time": "23:29:21",
          "price": 205.25,
          "contact_name": "motor 1",
          "contact_phone": "999"
        },
        {
          "id": 11,
          "delivery_type_id": 1,
          "delivery_type_name": "Envio inmediato",
          "delivery_state_id": 1,
          "delivery_state_name": "waiting",
          "datestart": "2015-09-23 16:08:56",
          "destination_description": "sadasd",
          "destination_address": "Av. Arequipa, Miraflores, Perú",
          "publish_date": "2015-09-23",
          "publish_time": "16:08:56",
          "price": 205.25,
          "contact_name": "motor 1",
          "contact_phone": "999"
        }
      ],
      "data_error": []
    }
    </code></pre></div></div></div></div></div></div></div><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" href="#panel__delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate_"><span class="parent">/delivery</span>/price/{lat_1}/{lon_1}/{lat_2}/{lon_2}/{zone}/{calculate}</a> <span class="methods"><a href="#" data-toggle="modal" data-target="#_delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate__get"><span class="badge badge_get">get</span></a></span></h4></div><div id="panel__delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate_" class="panel-collapse collapse"><div class="panel-body"><div class="resource-description"><p>Tarifa segun coordenadas</p></div><div class="list-group"><div data-toggle="modal" data-target="#_delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate__get" class="list-group-item"><span class="badge badge_get">get</span><div class="method_description"><p>Informacion en formato JSon</p></div><div class="clearfix"></div></div></div></div></div><div class="modal fade" tabindex="0" id="_delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate__get"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_get">get</span> <span class="parent">/delivery</span>/price/{lat_1}/{lon_1}/{lat_2}/{lon_2}/{zone}/{calculate}</h4></div><div class="modal-body"><div class="alert alert-info"><p>Informacion en formato JSon</p></div><ul class="nav nav-tabs"><li class="active"><a href="#_delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate__get_request" data-toggle="tab">Request</a></li><li><a href="#_delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate__get_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="_delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate__get_request"><h3>URI Parameters</h3><ul><li><strong>lat_1</strong>: <em>required (string)</em><p>Latitud 1</p><p><strong>Example</strong>:</p><pre>-12.08853</pre></li><li><strong>lon_1</strong>: <em>required (string)</em><p>Longitud 1</p><p><strong>Example</strong>:</p><pre>-77.042479</pre></li><li><strong>lat_2</strong>: <em>required (string)</em><p>Latitud 2</p><p><strong>Example</strong>:</p><pre>-12.120684</pre></li><li><strong>lon_2</strong>: <em>required (string)</em><p>Longitud 2</p><p><strong>Example</strong>:</p><pre>-77.029502</pre></li><li><strong>zone</strong>: <em>required (string)</em><p>Codigo Unico de Zona</p><p><strong>Example</strong>:</p><pre>Lima</pre></li><li><strong>calculate</strong>: <em>required (string)</em><p>1 = Calcular la tarifa exactamente por el numero de kilometros 0 = Retornar la tarifa predeterminada para el rango de distancia</p></li></ul></div><div class="tab-pane" id="_delivery_price__lat_1___lon_1___lat_2___lon_2___zone___calculate__get_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><p>Lista</p><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
      "status": 1,
      "msg": "ok",
      "data": [
        {
          "price": 307.07998657227
        }
      ],
      "data_error": []
    }
    </code></pre></div></div></div></div></div></div></div><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" href="#panel__delivery_detail__detail_id_"><span class="parent">/delivery</span>/detail/{detail_id}</a> <span class="methods"><a href="#" data-toggle="modal" data-target="#_delivery_detail__detail_id__get"><span class="badge badge_get">get</span></a></span></h4></div><div id="panel__delivery_detail__detail_id_" class="panel-collapse collapse"><div class="panel-body"><div class="resource-description"><p>Detalles de un delivery</p></div><div class="list-group"><div data-toggle="modal" data-target="#_delivery_detail__detail_id__get" class="list-group-item"><span class="badge badge_get">get</span><div class="method_description"><p>Lista en formato JSon</p></div><div class="clearfix"></div></div></div></div></div><div class="modal fade" tabindex="0" id="_delivery_detail__detail_id__get"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_get">get</span> <span class="parent">/delivery</span>/detail/{detail_id}</h4></div><div class="modal-body"><div class="alert alert-info"><p>Lista en formato JSon</p></div><ul class="nav nav-tabs"><li class="active"><a href="#_delivery_detail__detail_id__get_request" data-toggle="tab">Request</a></li><li><a href="#_delivery_detail__detail_id__get_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="_delivery_detail__detail_id__get_request"><h3>URI Parameters</h3><ul><li><strong>detail_id</strong>: <em>required (integer)</em><p>id del delivery</p><p><strong>Example</strong>:</p><pre><code>22</code></pre></li></ul></div><div class="tab-pane" id="_delivery_detail__detail_id__get_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><p>Lista</p><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
      "status": 1,
      "msg": "ok",
      "data": {
        "id": "22",
        "code": "0D318",
        "customer_id": "1",
        "delivery_state_id": "7",
        "paymenttype_id": "2",
        "category_id": "2",
        "vehicletype_id": "2",
        "driver_id": null,
        "number_points": "2",
        "description": "f",
        "delivery_type_id": "1",
        "datestart": "2015-09-25 21:38:10",
        "datepublish": null,
        "dateseparate": null,
        "price": "389.184",
        "flagservice": "1",
        "flagreturn": "1",
        "flagactive": "1",
        "lastupdate": "2015-09-30 22:27:55",
        "datecreate": "2015-09-25 21:38:10",
        "dataRoute": [
          {
            "id": "32",
            "x(coordenate)": "-12.0968055",
            "y(coordenate)": "-76.989225",
            "order_route": "1",
            "address": "Avenida Boulevard de Surco, San Borja, Lima, Perú",
            "description": "test",
            "contact_name": "motor 1",
            "contact_phone": "999",
            "contact_cellphone": "324",
            "contact_email": "asdas@asd.com",
            "flagactive": "1"
          },
          {
            "id": "33",
            "x(coordenate)": "-12.111062",
            "y(coordenate)": "-77.0315913",
            "order_route": "2",
            "address": "Miraflores, Peru",
            "description": "miora",
            "contact_name": "prueba",
            "contact_phone": "45",
            "contact_cellphone": "345",
            "contact_email": "tes@a.com",
            "flagactive": "1"
          }
        ]
      },
      "data_error": []
    }
    </code></pre></div></div></div></div></div></div></div></div></div></div><div class="panel panel-default"><div class="panel-heading"><h3 id="_state_delivery" class="panel-title">Actualizar Delivery</h3></div><div class="panel-body"><div class="top-resource-description"><p>Actualizar state del delivery</p></div><div class="panel-group"><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" href="#panel__state_delivery"><span class="parent"></span>/state-delivery</a> <span class="methods"><a href="#" data-toggle="modal" data-target="#_state_delivery_post"><span class="badge badge_post">post</span></a></span></h4></div><div id="panel__state_delivery" class="panel-collapse collapse"><div class="panel-body"><div class="list-group"><div data-toggle="modal" data-target="#_state_delivery_post" class="list-group-item"><span class="badge badge_post">post</span><div class="method_description"><p>Actualizar state del delivery</p></div><div class="clearfix"></div></div></div></div></div><div class="modal fade" tabindex="0" id="_state_delivery_post"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_post">post</span> <span class="parent"></span>/state-delivery</h4></div><div class="modal-body"><div class="alert alert-info"><p>Actualizar state del delivery</p></div><ul class="nav nav-tabs"><li class="active"><a href="#_state_delivery_post_request" data-toggle="tab">Request</a></li><li><a href="#_state_delivery_post_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="_state_delivery_post_request"><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
  "event":2,
  "driver":2,
  "id":16  
  }
</code></pre></div><div class="tab-pane" id="_state_delivery_post_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><p>Cambio exitoso</p><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
  "status": 1,
  "msg": "ok",
  "data": {
    "oldState": "1",
    "currentState": 2
  },
  "data_error": []
}
</code></pre></div></div></div></div></div></div></div></div></div></div><div class="panel panel-default"><div class="panel-heading"><h3 id="_state_driver" class="panel-title">Actualizar conductor</h3></div><div class="panel-body"><div class="top-resource-description"><p>Actualizar state del conductor</p></div><div class="panel-group"><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" href="#panel__state_driver"><span class="parent"></span>/state-driver</a> <span class="methods"><a href="#" data-toggle="modal" data-target="#_state_driver_post"><span class="badge badge_post">post</span></a></span></h4></div><div id="panel__state_driver" class="panel-collapse collapse"><div class="panel-body"><div class="list-group"><div data-toggle="modal" data-target="#_state_driver_post" class="list-group-item"><span class="badge badge_post">post</span><div class="method_description"><p>Actualizar state del conductor</p></div><div class="clearfix"></div></div></div></div></div><div class="modal fade" tabindex="0" id="_state_driver_post"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_post">post</span> <span class="parent"></span>/state-driver</h4></div><div class="modal-body"><div class="alert alert-info"><p>Actualizar state del conductor</p></div><ul class="nav nav-tabs"><li class="active"><a href="#_state_driver_post_request" data-toggle="tab">Request</a></li><li><a href="#_state_driver_post_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="_state_driver_post_request"><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
  "state":3,
  "id":2
  }
</code></pre></div><div class="tab-pane" id="_state_driver_post_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><p>Cambio exitoso</p><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
  "status": 1,
  "msg": "ok",
  "data": {
    "oldState": "1",
    "currentState": 3
  },
  "data_error": []
}
</code></pre></div></div></div></div></div></div></div><div class="panel panel-white"><div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" href="#panel__state_driver__driver_id_"><span class="parent">/state-driver</span>/{driver_id}</a> <span class="methods"><a href="#" data-toggle="modal" data-target="#_state_driver__driver_id__get"><span class="badge badge_get">get</span></a></span></h4></div><div id="panel__state_driver__driver_id_" class="panel-collapse collapse"><div class="panel-body"><div class="resource-description"><p>Detalles de un conductor</p></div><div class="list-group"><div data-toggle="modal" data-target="#_state_driver__driver_id__get" class="list-group-item"><span class="badge badge_get">get</span><div class="method_description"><p>Lista en formato JSon</p></div><div class="clearfix"></div></div></div></div></div><div class="modal fade" tabindex="0" id="_state_driver__driver_id__get"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" id="myModalLabel"><span class="badge badge_get">get</span> <span class="parent">/state-driver</span>/{driver_id}</h4></div><div class="modal-body"><div class="alert alert-info"><p>Lista en formato JSon</p></div><ul class="nav nav-tabs"><li class="active"><a href="#_state_driver__driver_id__get_request" data-toggle="tab">Request</a></li><li><a href="#_state_driver__driver_id__get_response" data-toggle="tab">Response</a></li></ul><div class="tab-content"><div class="tab-pane active" id="_state_driver__driver_id__get_request"><h3>URI Parameters</h3><ul><li><strong>driver_id</strong>: <em>required (integer)</em><p>id del conductor</p><p><strong>Example</strong>:</p><pre><code>2</code></pre></li></ul></div><div class="tab-pane" id="_state_driver__driver_id__get_response"><h2>HTTP status code <a href="http://httpstatus.es/200" target="_blank">200</a></h2><p>Lista</p><h3>Body</h3><p><strong>Type: application/json</strong></p><p><strong>Example</strong>:</p><pre><code>{
      "status": 1,
      "msg": "ok",
      "data": {
        "id": "2",
        "vehicletype_id": "0",
        "driver_state_id": "1",
        "dni": null,
        "uuid": "APA91bEp4BbVcB_xJRkercxzFoiC0WmWLtteTYPdYvtWrYUMePtsfhiEUFUfTIi0YLZ_O5ZEcxyZuBbt_IxqM4rV1_tRHDIhrxZPJ1zAwcN0RCXr3VFMpAih7VfniJ78b8jQE6tw0A1V",
        "namedriver": "Alfred",
        "lastname": "B",
        "phone": "123456",
        "email": "a@b.com",
        "flagbussy": null,
        "picture": null,
        "flagactive": "1",
        "datecreate": null,
        "datedelete": null,
        "lastupdate": "2015-09-30 20:23:12"
      },
      "data_error": []
    }</code></pre></div></div></div></div></div></div></div></div></div></div></div><div class="col-md-3"><div id="sidebar" class="hidden-print affix" role="complementary"><ul class="nav nav-pills nav-stacked"><li><a href="#_driver">/driver</a></li><li><a href="#_delivery">/delivery</a></li><li><a href="#_state_delivery">Actualizar Delivery</a></li><li><a href="#_state_driver">Actualizar conductor</a></li></ul></div></div></div></div></body></html>