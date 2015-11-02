(function() {
  require(['loadmap', 'alert', 'jqutils', 'tooltip'], function() {
    var catchDom, datosJson, dom, events, functions, mapa, reserva, showhoras, st, suscribeEvents;
    st = {
      btn: '.btn_regresar',
      formservicio: '#formServicio',
      formorigen: '#formorigen',
      formdestino: '#formdestino',
      formcargo: '#formcargo',
      formreserva: '#formreserva',
      select: '.combo_personal',
      btnre: '#btn_rein',
      paso1: '#btn_paso1',
      paso2: '#btn_paso2',
      paso3: '#btn_paso3',
      paso4: '#btn_paso4',
      paso5: '#btn_paso5',
      btn_reg1: '#btn_reg1',
      btn_reg2: '#btn_reg2',
      btn_reg3: '#btn_reg3',
      btn_reg4: '#btn_reg4',
      btn_reg5: '#btn_reg5',
      btnreserva: '#btn_reserva'
    };
    dom = {};
    datosJson = {};
    reserva = false;
    showhoras = false;
    mapa = "";
    catchDom = function() {
      dom.btn = $(st.btn);
      dom.btnre = $(st.btnre);
      dom.formorigen = $(st.formorigen);
      dom.formdestino = $(st.formdestino);
      dom.formcargo = $(st.formcargo);
      dom.formreserva = $(st.formreserva);
      dom.formservicio = $(st.formservicio);
      dom.paso1 = $(st.paso1);
      dom.paso2 = $(st.paso2);
      dom.paso3 = $(st.paso3);
      dom.paso4 = $(st.paso4);
      dom.paso5 = $(st.paso5);
      dom.btn_reg1 = $(st.btn_reg1);
      dom.btn_reg2 = $(st.btn_reg2);
      dom.btn_reg3 = $(st.btn_reg3);
      dom.btn_reg4 = $(st.btn_reg4);
      dom.btn_reg5 = $(st.btn_reg5);
      dom.btnreserva = $(st.btnreserva);
      dom.select = $(st.select);
    };
    suscribeEvents = function() {
      dom.btn.on('click', events.opciones);
      dom.paso1.on('click', events.paso1);
      dom.paso2.on('click', events.paso2);
      dom.paso3.on('click', events.paso3);
      dom.paso4.on('click', events.paso4);
      dom.paso5.on('click', events.paso5);
      dom.btn_reg1.on('click', events.reg_pas1);
      dom.btn_reg2.on('click', events.reg_pas2);
      dom.btn_reg3.on('click', events.reg_pas3);
      dom.btn_reg4.on('click', events.reg_pas4);
      dom.btn_reg5.on('click', events.reg_pas5);
      dom.btnreserva.on('click', events.pasoReserva);
      dom.formorigen.on('submit', events.form);
      dom.formdestino.on('submit', events.form);
      dom.formcargo.on('submit', events.form);
      dom.select.on('change', events.cbo);
      $('input:radio[name=paymenttype_id]').on('click', events.showOptionCobro);
      $('input:radio[name=category_id]').on('click', events.showOptionCategoria);
      $('.box_helper>span').on('click', events.showBox);
      $('input:radio[name=vehicletype_id]').on('click', events.showOptionVehicle);
      $('input:radio[name=opcion1]').on('change', events.opciones_radio1);
      return $('input:radio[name=opcion2]').on('change', events.opciones_radio2);
    };
    events = {
      cbo: function() {
        $('#formorigen input[name=phone]').val($(".combo_personal option:selected").attr("data-phone"));
        $('#formorigen input[name=cellphone]').val($(".combo_personal option:selected").attr("data-cellphone"));
        return $('#formorigen input[name=email]').val($(".combo_personal option:selected").attr("data-email"));
      },
      reintentar: function(e) {
        e.preventDefault();
        functions.enviarDatos();
      },
      form: function(e) {
        e.preventDefault();
      },
      opciones: function(e) {
        e.preventDefault();
        functions.back();
      },
      opciones_radio1: function(e) {
        var srv_inmediato;
        srv_inmediato = $("input:radio[name=opcion1]:checked").val();
        $("#servicio01").trigger('click');
        if ($(this).prop("checked") === true) {
          $("input:radio[name=opcion2]").prop("checked", false);
        }
        if (srv_inmediato !== void 0) {
          if (srv_inmediato === "1") {
            $("#servicio_delivery_1").trigger('click');
            functions.pasosInvUnico();
            reserva = false;
            return showhoras = false;
          } else {
            $("#servicio_delivery_2").trigger('click');
            functions.pasosInvHoras();
            reserva = true;
            return showhoras = true;
          }
        }
      },
      opciones_radio2: function(e) {
        var srv_horas;
        srv_horas = $("input:radio[name=opcion2]:checked").val();
        $("#servicio02").trigger('click');
        if ($(this).prop("checked") === true) {
          $("input:radio[name=opcion1]").prop("checked", false);
        }
        if (srv_horas !== void 0) {
          if (srv_horas === "1") {
            $("#servicio_delivery_1").trigger('click');
            functions.pasosProgramadoUnico();
            reserva = true;
            return showhoras = false;
          } else {
            $("#servicio_delivery_2").trigger('click');
            functions.pasosProgramadoHoras();
            reserva = true;
            return showhoras = true;
          }
        }
      },
      showOptionCategoria: function() {
        var cat;
        cat = $("input:radio[name=category_id]:checked").parent().children('span').text();
        if (cat === "Otros") {
          return $('#txt_otros').removeClass('none');
        } else {
          return $('#txt_otros').addClass('none');
        }
      },
      showOptionCobro: function() {
        var data;
        data = parseInt($("input:radio[name=paymenttype_id]:checked").val());
        switch (data) {
          case 1:
            $('#txt_pago,#Efectivo').removeClass('none');
            return $('#Pos').addClass('none');
          case 2:
            $('#txt_pago,#Efectivo').addClass('none');
            return $('#Pos').removeClass('none');
          case 3:
            $('#txt_pago,#Efectivo').addClass('none');
            return $('#Pos').removeClass('none');
          case 4:
            $('#txt_pago,#Efectivo').addClass('none');
            return $('#Pos').addClass('none');
        }
      },
      showBox: function() {
        return $(this).parent().addClass('none');
      },
      showOptionVehicle: function() {
        var box, dato;
        dato = $("input:radio[name=vehicletype_id]:checked").parent().children('span').text();
        box = "#" + dato;
        $('#Moto,#Carro,#Bicicleta').addClass('none');
        return $(box).removeClass('none');
      },
      reg_pas1: function(e) {
        e.preventDefault();
        $('.active').find('a').addClass('disabled');
        $('.service_unico .tipo').addClass('active');
        $('.service_unico .tipo').children('a').removeClass('disabled');
        $('.container_pasos').addClass('none').addClass('animated slideInLeft');
        return $('#paso1').removeClass('none').addClass('animated slideInRight');
      },
      reg_pas2: function(e) {
        e.preventDefault();
        if (reserva === false) {
          $('.active').find('a').addClass('disabled');
          $('.service_unico .tipo').addClass('active');
          $('.service_unico .tipo').children('a').removeClass('disabled');
          $('.container_pasos').addClass('none').addClass('animated slideInLeft');
          return $('#paso1').removeClass('none').addClass('animated slideInRight');
        } else {
          $('.active').find('a').addClass('disabled');
          $('.service_unico .programa_reserva').addClass('active');
          $('.service_unico .programa_reserva').children('a').removeClass('disabled');
          $('.container_pasos').addClass('none').addClass('animated slideInLeft');
          return $('#reserva').removeClass('none').addClass('animated slideInRight');
        }
      },
      reg_pas3: function(e) {
        e.preventDefault();
        $('.active').find('a').addClass('disabled');
        $('.service_unico .origen').addClass('active');
        $('.service_unico .origen').children('a').removeClass('disabled');
        $('.container_pasos').addClass('none').addClass('animated slideInLeft');
        return $('#paso2').removeClass('none').addClass('animated slideInRight');
      },
      reg_pas4: function(e) {
        e.preventDefault();
        if (reserva === false) {
          $('.active').find('a').addClass('disabled');
          $('.service_unico .destino').addClass('active');
          $('.service_unico .destino').children('a').removeClass('disabled');
          $('.container_pasos').addClass('none').addClass('animated slideInLeft');
          return $('#paso3').removeClass('none').addClass('animated slideInRight');
        } else {
          $('.active').find('a').addClass('disabled');
          $('.service_unico .origen').addClass('active');
          $('.service_unico .origen').children('a').removeClass('disabled');
          $('.container_pasos').addClass('none').addClass('animated slideInLeft');
          return $('#paso2').removeClass('none').addClass('animated slideInRight');
        }
      },
      reg_pas5: function(e) {
        e.preventDefault();
        $('.active').find('a').addClass('disabled');
        $('.service_unico .descripcion').addClass('active');
        $('.service_unico .descripcion').children('a').removeClass('disabled');
        $('.container_pasos').addClass('none').addClass('animated slideInLeft');
        return $('#paso4').removeClass('none').addClass('animated slideInRight');
      },
      paso1: function(e) {
        var txt;
        e.preventDefault();
        functions.opciones_pasos();
        functions.showPrograma();
        if (reserva === false) {
          $('.active').children('a').addClass('disabled');
          $('.service_unico .origen').addClass('active');
          $('.service_unico .origen').children('a').removeClass('disabled');
          $('.container_pasos').addClass('none').addClass('animated slideInRight ');
          $('#paso2').removeClass('none slideInRight').addClass('animated slideInLeft');
          txt = $('.active').children('a').find('.txt_pasos').text();
          $('.nombre_paso').text(txt);
          if (mapa === "") {
            return functions.initMap('#map', 'icon1.png', 'dir01', 'formorigen', 'latitude', 'longitude');
          }
        } else {
          $('.active').children('a').addClass('disabled');
          $('.service_unico .programa_reserva').addClass('active');
          $('.service_unico .programa_reserva').children('a').removeClass('disabled');
          $('.container_pasos').addClass('none').addClass('animated slideInRight ');
          $('#reserva').removeClass('none slideInRight').addClass('animated slideInLeft');
          txt = $('.active').children('a').find('.txt_pasos').text();
          return $('.nombre_paso').text(txt);
        }
      },
      pasoReserva: function(e) {
        var txt;
        e.preventDefault();
        if (mapa === "") {
          functions.initMap('#map', 'icon1.png', 'dir01', 'formorigen', 'latitude', 'longitude');
        }
        if (showhoras === true) {
          if ($('input:text[name=numberhour]').val() !== "") {
            $('.active').children('a').addClass('disabled');
            $('.service_unico .origen').addClass('active');
            $('.service_unico .origen').children('a').removeClass('disabled');
            $('.container_pasos').addClass('none').addClass('animated slideInRight ');
            $('#paso2').removeClass('none slideInRight').addClass('animated slideInLeft');
            txt = $('.active').children('a').find('.txt_pasos').text();
            return $('.nombre_paso').text(txt);
          } else {
            return swal({
              title: 'Error',
              text: 'El campo es requerido',
              type: 'error',
              timer: 2000,
              showConfirmButton: false
            });
          }
        } else {
          if ($('input:text[name=datefrom]').val() !== "" || $('input:text[name=dateto]').val() !== "" || $('input:text[name=time]').val() !== "") {
            $('.active').children('a').addClass('disabled');
            $('.service_unico .origen').addClass('active');
            $('.service_unico .origen').children('a').removeClass('disabled');
            $('.container_pasos').addClass('none').addClass('animated slideInRight ');
            $('#paso2').removeClass('none slideInRight').addClass('animated slideInLeft');
            txt = $('.active').children('a').find('.txt_pasos').text();
            return $('.nombre_paso').text(txt);
          } else {
            return swal({
              title: 'Error',
              text: 'Los campos fecha y horas son requeridos',
              type: 'error',
              timer: 2000,
              showConfirmButton: false
            });
          }
        }
      },
      paso2: function(e) {
        var txt, validate;
        e.preventDefault();
        dom.formorigen.submit();
        validate = dom.formorigen.parsley().isValid();
        if (validate === true) {
          if (showhoras === false) {
            $('.active').children('a').addClass('disabled');
            $('.service_unico .destino').addClass('active');
            $('.service_unico .destino').children('a').removeClass('disabled');
            $('.container_pasos').addClass('none').addClass('animated slideInRight ');
            $('#paso3').removeClass('none slideInRight').addClass('animated slideInLeft');
            txt = $('.active').children('a').find('.txt_pasos').text();
            $('.nombre_paso').text(txt);
            return functions.initMap('#map2', 'icon2.png', 'dir02', 'formdestino', 'dest_latitude', 'dest_longitude');
          } else {
            functions.initMap('#map2', 'icon2.png', 'dir02', 'formdestino', 'dest_latitude', 'dest_longitude');
            $('.active').children('a').addClass('disabled');
            $('.service_unico .descripcion').addClass('active');
            $('.service_unico .descripcion').children('a').removeClass('disabled');
            $('.container_pasos').addClass('none').addClass('animated slideInRight ');
            $('#paso4').removeClass('none slideInRight').addClass('animated slideInLeft');
            txt = $('.active').children('a').find('.txt_pasos').text();
            return $('.nombre_paso').text(txt);
          }
        }
      },
      paso3: function(e) {
        var validate;
        e.preventDefault();
        dom.formdestino.submit();
        validate = dom.formdestino.parsley().isValid();
        if (validate === true) {
          return functions.datosTarifa();
        }
      },
      paso4: function(e) {
        var monto, txt, validate;
        e.preventDefault();
        dom.formcargo.submit();
        validate = dom.formcargo.parsley().isValid();
        if (validate === true) {
          if (showhoras === false) {
            if ($("input:radio[name=paymenttype_id]:checked").val() === "1") {
              if ($('input:text[name=pay]').val() !== "") {
                monto = parseFloat($('input:text[name=pay]').val());
                if (monto > 200) {
                  return swal({
                    title: 'Error',
                    text: 'El monto no debe superar S./ 200',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false
                  });
                } else {
                  functions.datosPasos();
                  $('.active').children('a').addClass('disabled');
                  $('.service_unico .resumen').addClass('active');
                  $('.service_unico .resumen').children('a').removeClass('disabled');
                  $('.container_pasos').addClass('none').addClass('animated slideInRight ');
                  $('#paso5').removeClass('none slideInRight').addClass('animated slideInLeft');
                  txt = $('.active').children('a').find('.txt_pasos').text();
                  $('.nombre_paso').text(txt);
                  return functions.MapResumen();
                }
              } else {
                return swal({
                  title: 'Error',
                  text: 'Debe indicar el monto',
                  type: 'error',
                  timer: 2000,
                  showConfirmButton: false
                });
              }
            } else {
              functions.datosPasos();
              $('.active').children('a').addClass('disabled');
              $('.service_unico .resumen').addClass('active');
              $('.service_unico .resumen').children('a').removeClass('disabled');
              $('.container_pasos').addClass('none').addClass('animated slideInRight ');
              $('#paso5').removeClass('none slideInRight').addClass('animated slideInLeft');
              txt = $('.active').children('a').find('.txt_pasos').text();
              $('.nombre_paso').text(txt);
              return functions.MapResumen();
            }
          } else {
            functions.datosPasos();
            $('.active').children('a').addClass('disabled');
            $('.service_unico .resumen').addClass('active');
            $('.service_unico .resumen').children('a').removeClass('disabled');
            $('.container_pasos').addClass('none').addClass('animated slideInRight ');
            $('#paso5').removeClass('none slideInRight').addClass('animated slideInLeft');
            txt = $('.active').children('a').find('.txt_pasos').text();
            $('.nombre_paso').text(txt);
            return functions.MapResumen();
          }
        }
      },
      paso5: function(e) {
        e.preventDefault();
        return functions.enviarDatos();
      }
    };
    functions = {
      datosTarifa: function() {
        var lat_1, lat_2, lon_1, lon_2, url;
        lat_1 = $('#formorigen input[name=latitude]').val();
        lon_1 = $('#formorigen input[name=longitude]').val();
        lat_2 = $('#formdestino input[name=dest_latitude]').val();
        lon_2 = $('#formdestino input[name=dest_longitude]').val();
        url = "/admclient/solicitar/tarifa";
        utils.loader($("body"), true);
        return $.post(url, {
          lat_1: lat_1,
          lon_1: lon_1,
          lat_2: lat_2,
          lon_2: lon_2
        }).done(function(data) {
          var price, txt;
          utils.loader($("body"), false);
          if (data.status === 1) {
            $('.active').children('a').addClass('disabled');
            $('.service_unico .descripcion').addClass('active');
            $('.service_unico .descripcion').children('a').removeClass('disabled');
            $('.container_pasos').addClass('none').addClass('animated slideInRight ');
            $('#paso4').removeClass('none slideInRight').addClass('animated slideInLeft');
            txt = $('.active').children('a').find('.txt_pasos').text();
            $('.nombre_paso').text(txt);
            price = parseFloat(data.data.price).toFixed(2);
            $('.destino_tarifa').text("S./ " + price);
          } else {
            swal({
              title: 'Error',
              text: 'Hubo un error, intentelo de nuevo',
              type: 'error',
              timer: 2000,
              showConfirmButton: false
            });
            return false;
          }
        });
      },
      pasosInvHoras: function() {
        $('.programa_reserva').removeClass('none');
        $('.service_unico .destino').addClass('none');
        $('.service_unico .origen').children('a').children('.btn_num').html('3');
        $('.service_unico .description').children('a').children('.btn_num').html('4');
        return $('.service_unico .resumen').children('a').children('.btn_num').html('5');
      },
      pasosInvUnico: function() {
        $('.programa_reserva').addClass('none');
        $('.service_unico .destino').removeClass('none');
        $('.service_unico .origen').children('a').children('.btn_num').html('2');
        $('.service_unico .destino').children('a').children('.btn_num').html('3');
        $('.service_unico .descripcion').children('a').children('.btn_num').html('4');
        return $('.service_unico .resumen').children('a').children('.btn_num').html('5');
      },
      pasosProgramadoUnico: function() {
        $('.programa_reserva').removeClass('none');
        $('.service_unico .destino').removeClass('none');
        $('.service_unico .origen').children('a').children('.btn_num').html('3');
        $('.service_unico .destino').children('a').children('.btn_num').html('4');
        $('.service_unico .descripcion').children('a').children('.btn_num').html('5');
        return $('.service_unico .resumen').children('a').children('.btn_num').html('6');
      },
      pasosProgramadoHoras: function() {
        $('.programa_reserva').removeClass('none');
        $('.service_unico .destino').addClass('none');
        $('.service_unico .origen').children('a').children('.btn_num').html('3');
        $('.service_unico .descripcion').children('a').children('.btn_num').html('4');
        return $('.service_unico .resumen').children('a').children('.btn_num').html('5');
      },
      datosPasos: function() {
        var ObjCargo, ObjDestino, ObjOrigen, ObjReserva, ObjServicio, fechas, frecuencia, obj1, obj2, obj3, obj4, obj5;
        ObjServicio = JSON.stringify(dom.formservicio.serialize());
        ObjReserva = JSON.stringify(dom.formreserva.serialize());
        ObjOrigen = JSON.stringify(dom.formorigen.serialize());
        ObjDestino = JSON.stringify(dom.formdestino.serialize());
        ObjCargo = JSON.stringify(dom.formcargo.serialize());
        obj1 = ObjOrigen.replace('"', '');
        obj2 = ObjDestino.replace('"', '');
        obj3 = ObjServicio.replace('"', '');
        obj4 = ObjCargo.replace('"', '');
        obj5 = ObjCargo.replace('"', '');
        datosJson = obj1.replace('"', '') + '&' + obj2.replace('"', '') + '&' + obj3.replace('"', '') + '&' + obj4.replace('"', '') + '&' + obj5.replace('"', '');
        $('.destino_direccion_origen').text($('#formorigen input[name=address]').val());
        $('.destino_direccion_destino').text($('#formdestino input[name=dest_address]').val());
        if ($("input:radio[name=category_id]:checked").val() === "4") {
          $('.destino_categoria').text($('#txt_otros').val());
        } else {
          $('.destino_categoria').text($("input:radio[name=category_id]:checked").parent().children('span').text());
        }
        if ($("input:radio[name=paymenttype_id]:checked").val() === "1") {
          $('.destino_cobro').text($('input:text[name=pay]').val());
        } else {
          $('.destino_cobro').text($("input:radio[name=paymenttype_id]:checked").parent().children('span').text());
        }
        $('.destino_tipo').text($("input:radio[name=vehicletype_id]:checked").parent().children('span').text());
        $('.destinoIdaVuelta').text($("input:radio[name=flagreturn]:checked").parent().children('span').text());
        $('.numero_horas').text($('input:text[name=numberhour]').val());
        fechas = $('input:text[name=datefrom]').val() + " hasta " + $('input:text[name=dateto]').val();
        $('.fechas').text(fechas);
        $('.horas').text($('input:text[name=time]').val());
        frecuencia = [];
        $('.check_day:checked').each(function() {
          frecuencia.push($(this).parent().children('label').text());
          return $('.total_frecuencia').text(frecuencia);
        });
      },
      enviarDatos: function() {
        var data, url;
        data = datosJson;
        url = "/admclient/solicitar";
        utils.loader($("body"), true);
        $.post(url, data).done(function(data) {
          var container;
          utils.loader($("body"), false);
          if (data.state === 1) {
            $('#btn_rein').addClass('none');
            $('.active').children('a').addClass('disabled');
            container = "#" + $('.active').children('a').attr("data-nom");
            $('.container_pasos').addClass('none');
            $('#paso6').removeClass('none');
            $('.msg_solicitar').text(data.data.code);
          } else {
            swal({
              title: 'Error',
              text: 'Hubo un error, intentelo de nuevo',
              type: 'error',
              timer: 2000,
              showConfirmButton: false
            });
            return false;
          }
        });
      },
      opciones_pasos: function() {
        var op1, op2;
        op1 = parseInt($("input:radio[name=flagservice]:checked").val());
        op2 = parseInt($("input:radio[name=delivery_type_id]:checked").val());
        if ((op1 === 1) && (op2 === 1)) {
          $('.content_date').hide();
          $('.content_hour,.destino_horas').hide();
          $('.show_frecuencia').hide();
          $('.destinos_fechas,.destino_hour,.destino_frecuencia').hide();
          $('.service_ida_vuelta,.mostrar_direccion_destino').show();
        }
        if ((op1 === 2) && (op2 === 1)) {
          $('.content_date,.contenedor_cobremos,.contenedor_necesitas').show();
          $('.show_frecuencia,.service_ida_vuelta,.destino_frecuencia').show();
          $('.content_hour,.destino_horas').hide();
          $('.destinos_fechas,.destino_hour,.mostrar_direccion_destino').show();
        }
        if ((op1 === 1) && (op2 === 2)) {
          $('.content_date , .contenedor_cobremos,.destino_frecuencia').hide();
          $('.show_frecuencia,.contenedor_necesitas,.service_cobro').hide();
          $('.content_hour,.destino_horas').show();
          $('.destinos_fechas,.destino_hour,.service_ida_vuelta,.mostrar_direccion_destino').hide();
        }
        if ((op1 === 2) && (op2 === 2)) {
          $('.content_date').show();
          $('.show_frecuencia,.destino_frecuencia').show();
          $('.content_hour,.destino_horas').show();
          $('.destinos_fechas,.destino_hour').show();
          return $('.contenedor_cobremos,.contenedor_necesitas,.service_ida_vuelta,.mostrar_direccion_destino,.service_cobro').hide();
        }
      },
      showPrograma: function() {
        $('#datetimepicker1').datetimepicker({
          format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
          format: 'YYYY-MM-DD',
          useCurrent: false
        });
        $('#datetimepicker1').on('dp.change', function(e) {
          $('#datetimepicker2').data('DateTimePicker').minDate(e.date);
        });
        $('#datetimepicker2').on('dp.change', function(e) {
          $('#datetimepicker1').data('DateTimePicker').maxDate(e.date);
        });
        return $('#date_time').datetimepicker({
          format: 'hh:mm:ss'
        });
      },
      back: function() {
        var container;
        $('.active').find('a').addClass('disabled');
        $('.active').prev().addClass("active").siblings().removeClass('active');
        $('.active').children('a').removeClass('disabled');
        container = "#" + $('.active').children('a').attr("data-nom");
        $('.container_pasos').addClass('none').addClass('animated slideInLeft');
        $(container).removeClass('none').addClass('animated slideInRight');
      },
      show: function() {
        var container, txt;
        $('.active').children('a').addClass('disabled');
        $('.active').next().addClass("active").siblings().removeClass('active');
        $('.active').children('a').removeClass('disabled');
        container = "#" + $('.active').children('a').attr("data-nom");
        $('.container_pasos').addClass('none').addClass('animated slideInRight ');
        $(container).removeClass('none slideInRight').addClass('animated slideInLeft');
        txt = $('.active').children('a').find('.txt_pasos').text();
        return $('.nombre_paso').text(txt);
      },
      marker: function(marker, lat, lon) {
        google.maps.event.addListener(marker, 'dragend', function(event) {
          $(lat).val(this.getPosition().lat());
          return $(lon).val(this.getPosition().lng());
        });
      },
      calculateAndDisplayRoute: function(directionsService, directionsDisplay, lat_ori, lon_ori, lat_des, lon_des) {
        var destination, origin;
        origin = lat_ori + "," + lon_ori;
        destination = lat_des + "," + lon_des;
        directionsService.route({
          origin: origin,
          destination: destination,
          optimizeWaypoints: true,
          travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
          if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          } else {
            console.log('Directions request failed due to ' + status);
          }
        });
      },
      MapResumen: function() {
        $('.google-map').lazyLoadGoogleMaps({
          callback: function(container, map) {
            var $container, center, data, directionsDisplay, directionsService, i, infoWindow, lat_des, lat_ori, lon_des, lon_ori, maplat, maplng, marker, markers, myLatlng;
            $container = $(container);
            directionsService = new google.maps.DirectionsService;
            directionsDisplay = new google.maps.DirectionsRenderer({
              suppressMarkers: true
            });
            if ($container.attr('data-lat') === "") {
              maplat = $('input[name=latitude]').val();
              maplng = $('input[name=longitude]').val();
            } else {
              maplat = $container.attr('data-lat');
              maplng = $container.attr('data-lng');
            }
            center = new google.maps.LatLng(maplat, maplng);
            map.setOptions({
              zoom: 12,
              center: center
            });
            directionsDisplay.setMap(map);
            lat_ori = $('input[name=latitude]').val();
            lon_ori = $('input[name=longitude]').val();
            lat_des = $('input[name=dest_latitude]').val();
            lon_des = $('input[name=dest_longitude]').val();
            markers = [
              {
                'title': 'Origen',
                'lat': lat_ori,
                'lng': lon_ori,
                'description': $('#formorigen input[name=address]').val(),
                'icon': '../../../client/img/icon_ruta1.png'
              }, {
                'title': 'Destino',
                'lat': lat_des,
                'lng': lon_des,
                'description': $('#formdestino input[name=dest_address]').val(),
                'icon': '../../../client/img/icon_ruta3.png'
              }
            ];
            infoWindow = new google.maps.InfoWindow;
            i = 0;
            while (i < markers.length) {
              data = markers[i];
              myLatlng = new google.maps.LatLng(data.lat, data.lng);
              marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: data.icon,
                title: data.title
              });
              (function(marker, data) {
                google.maps.event.addListener(marker, 'click', function(e) {
                  infoWindow.setContent('<div style = \'width:200px;min-height:40px\'>' + data.description + '</div>');
                  infoWindow.open(map, marker);
                });
              })(marker, data);
              i++;
            }
            google.maps.event.addListenerOnce(map, 'idle', function() {
              $container.addClass('is-loaded');
            });
            return functions.calculateAndDisplayRoute(directionsService, directionsDisplay, lat_ori, lon_ori, lat_des, lon_des);
          }
        });
      },
      initMap: function(elem, nomicon, id, form, l, t) {
        var icon, latitud, longitud;
        icon = '../client/img/' + nomicon;
        latitud = "#" + form + " input[name=" + l + "]";
        longitud = "#" + form + " input[name=" + t + "]";
        $(elem).lazyLoadGoogleMaps({
          callback: function(container, map) {
            var $container, center, input, marker, searchBox;
            $container = $(container);
            center = new google.maps.LatLng($container.attr('data-lat'), $container.attr('data-lng'));
            map.setOptions({
              zoom: 15,
              center: center
            });
            marker = new google.maps.Marker({
              position: center,
              map: map,
              draggable: true,
              animation: google.maps.Animation.DROP,
              icon: icon
            });
            google.maps.event.addListenerOnce(map, 'idle', function() {
              $container.addClass('is-loaded');
            });
            input = document.getElementById(id);
            searchBox = new google.maps.places.SearchBox(input);
            map.addListener('bounds_changed', function() {
              searchBox.setBounds(map.getBounds());
            });
            mapa = map;
            searchBox.addListener('places_changed', function() {
              var bounds, places;
              places = searchBox.getPlaces();
              bounds = new google.maps.LatLngBounds;
              places.forEach(function(place) {
                marker.setMap(null);
                marker = new google.maps.Marker({
                  map: map,
                  icon: icon,
                  draggable: true,
                  title: place.name,
                  position: place.geometry.location
                });
                $(latitud).val(marker.getPosition().lat());
                $(longitud).val(marker.getPosition().lng());
                if (place.geometry.viewport) {
                  bounds.union(place.geometry.viewport);
                } else {
                  bounds.extend(place.geometry.location);
                }
              });
              map.fitBounds(bounds);
              functions.marker(marker, latitud, longitud);
            });
            functions.marker(marker, latitud, longitud);
          }
        });
      }
    };
    catchDom();
    suscribeEvents();
  });

}).call(this);
