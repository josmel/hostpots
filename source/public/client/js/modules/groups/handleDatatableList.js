(function() {
  require(['lib_underscore', 'alert'], function() {
    var catchDom, dom, events, functions, st, suscribeEvents;
    console.log("show Table perfil");
    st = {
      table: '.table',
      rowTpl: '.row4Table',
      formContact: '#formContact'
    };
    dom = {};
    catchDom = function() {
      dom.table = $(st.table);
      dom.rowTpl = _.template($(st.rowTpl).html());
      dom.formContact = $(st.formContact);
    };
    catchDom();
    suscribeEvents = function() {
      $('body').on('click', '.del_contact', events["delete"]);
      $('body').on('click', '.edit_contact', events.edit);
      return dom.formContact.on('submit', events.form);
    };
    events = {
      form: function(e) {
        var datos, men_description_nuevo, men_titulo_nuevo, url;
        e.preventDefault();
        datos = $(this).serialize();
        url = $(this).attr("action");
        if ($('#formContact input[name=id]').val() === "") {
          men_titulo_nuevo = "Registro Correcto";
          men_description_nuevo = 'Se agrego el Equipo.';
        } else {
          men_titulo_nuevo = "Registro Actualizado";
          men_description_nuevo = 'Se actualizo el equipo.';
        }
        $.post(url, datos, function(data) {
          if (data.state === 1) {
            swal(men_titulo_nuevo, men_description_nuevo, 'success');
            $('#formContact')[0].reset();
            $('#formContact').find('input').removeClass('parsley-success');
            return functions.showInitialTable();
          } else {
            return swal('Error', 'Hubo un error , intentelo de nuevo', 'error');
          }
        });
        return;
      },
      edit: function(e) {
        var  edit, id, name,customer_id;
        e.preventDefault();
        edit = $(this).parent().parent().parent();
        id = edit.attr("data-id");  
        customer_id = edit.attr("data-customer");  
        name = edit.children().eq(1).text().trim();
        $('#formContact input[name=id]').val(id);
         $('#formContact input[name=customer_id]').val(customer_id);
        $('#formContact input[name=name]').val(name);
      },
      "delete": function(e) {
        var name, url;
        e.preventDefault();
        url = $(this).attr("data-url");
        name = $(this).attr("data-nom");
        return swal({
          title: '¿Confirmar para eliminar?',
          text: 'Estas seguro de eliminar a ' + name,
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'ELIMINAR!',
          cancelButtonText: 'CANCELAR',
          closeOnConfirm: false,
          closeOnCancel: false
        }, function(isConfirm) {
          if (isConfirm) {
            $.get(url, function(data) {
              if (data.state === 1) {
                swal('Eliminado', 'Se elimino el equipo.', 'success');
                return functions.showInitialTable();
              } else {
                return swal('Error', 'Hubo un error , intentelo de nuevo', 'error');
              }
            });
            return;
          } else {
            swal('Ops', 'Se cancelo la accion', 'error');
          }
        });
      }
    };
    functions = {
      showInitialTable: function() {
        var html, url;
        html = "";
        url = dom.table.attr("data-url");
        return $.ajax({
          url: url,
          success: function(json) {
            var i, indx, len, ref, val, valor;
            ref = json.data;
            for (indx = i = 0, len = ref.length; i < len; indx = ++i) {
              val = ref[indx];
              valor = dom.rowTpl(val);
              html += valor;
            }
            return $("tbody").html(html);
          }
        });
      }
    };
    functions.showInitialTable();
    suscribeEvents();
  });

}).call(this);
