(function() {
  require(['lib_underscore', 'jqutils'], function() {
    var catchDom, dom, events, functions, st, suscribeEvents;
    console.log("show Table active");
    st = {
      table: 'table',
      rowTpl: '.row4Table'
    };
    dom = {};
    catchDom = function() {
      dom.table = $(st.table);
      dom.rowTpl = _.template($(st.rowTpl).html());
    };
    catchDom();
    suscribeEvents = function() {
      $('.list_anio').on('change', events.cbo);
      $('.list_mes').on('change', events.cbo);
      return $('.list_dia').on('change', events.cbo);
    };
    events = {
      cbo: function() {
        return functions.showInitialTable();
      }
    };
    functions = {
      showInitialTable: function() {
        var day, html, month, year;
        utils.loader($(".table"), true);
        year = $('.list_anio').val();
        month = $('.list_mes').val();
        day = $('.list_dia').val();
        html = "";
        return $.ajax({
          method: "POST",
          url: "/admclient/solicitar/activos",
          data: {
            year: year,
            month: month,
            day: day,
            complet: 1
          },
          success: function(json) {
            var indx, j, len, ref, val, valor;
            console.log(json);
            utils.loader($(".table"), false);
            ref = json.data;
            for (indx = j = 0, len = ref.length; j < len; indx = ++j) {
              val = ref[indx];
              val.css_class = functions.classForState(val.delivery_state_id);
              valor = dom.rowTpl(val);
              html += valor;
            }
            return $("tbody").html(html);
          }
        });
      },
      classForState: function(state) {
        var css;
        css = "";
        switch (state) {
          case 1:
            css = "fondo_celeste";
            break;
          case 2:
            css = "fondo_azul";
            break;
          case 3:
            css = "fondo_verde_claro";
            break;
          case 4:
            css = "fondo_verde";
        }
        return css;
      },
      showdate: function() {
        var a, i, k, results;
        i = 1;
        while (i <= 31) {
          $('.list_dia').append('<option value=' + i + '>' + i + '</option>');
          i++;
        }
        a = 1;
        while (a <= 12) {
          $('.list_mes').append('<option value=' + a + '>' + a + '</option>');
          a++;
        }
        k = 2015;
        results = [];
        while (k <= 2030) {
          $('.list_anio').append('<option value=' + k + '>' + k + '</option>');
          results.push(k++);
        }
        return results;
      }
    };
    suscribeEvents();
    functions.showdate();
    functions.showInitialTable();
  });

}).call(this);
