(function() {
  require.config({
    baseUrl: '../../../client/js',
    waitSeconds: 5,
    urlArgs: 'v=' + (new Date()).getTime(),
    paths: {
      'libBxSlider': 'vendor/bxslider-4/dist/jquery.bxslider',
      'libParsley': 'libs/parsleyjs/dist/parsley.min',
      'lib_underscore': 'libs/underscore/underscore',
      'es': 'libs/parsleyjs/src/i18n/es',
      'async': 'libs/requirejs-plugins/src/async',
      'loadmap': 'libs/loadmap/loadmap.min',
      'alert': 'libs/sweetalert/dist/sweetalert.min',
      'jqutils': 'libs/jqutils/jq-utils',
      'moment': 'libs/moment/moment',
      'datetimepicker': 'libs/datetimepicker/build/js/bootstrap-datetimepicker.min',
      'bootstrap': 'libs/bootstrap/dist/js/bootstrap.min',
      'tooltip': 'libs/tooltip/jquery.tooltipster.min',
          'textarea': 'libs/textarea/trumbowyg.min'
    }
  });

  define('jquery', [], function() {
    return jQuery;
  });

  define([], function() {
    var getCtrl;
    window.schema = {
      controllers: {
        'index': {
          actions: {
            index: function() {
              return require(['modules/index/index']);
            }
          },
          allActions: function() {}
        },
        'solicitar': {
          actions: {
            solicitar: function() {
              return require(['modules/solicitar/pasos', 'moment', 'bootstrap', 'datetimepicker']);
            }
          },
          allActions: function() {}
        },
        'activo': {
          actions: {
            index: function() {
              return require(['modules/activos/handleDatatable']);
            },
            detalle: function() {
              return require(['modules/activos/mapa']);
            }
          },
          allActions: function() {}
        },
        'completados': {
          actions: {
            index: function() {
              return require(['modules/completados/handleDatatable']);
            },
            detalle: function() {
              return require(['modules/completados/mapa']);
            }
          },
          allActions: function() {}
        },
        'Profile': {
          actions: {
            getIndex: function() {
              return require(['modules/perfil/index', 'modules/perfil/handleDatatable']);
            }
          },
          allActions: function() {}
        },
         'Client': {
          actions: {
            getIndex: function() {
              return require(['modules/client/index', 'modules/client/handleDatatable']);
            }
          },
          allActions: function() {}
        },
         'Campanias': {
          actions: {
            getIndex: function() {
              return require(['modules/campanias/handleDatatable']);
            },
            getForm: function() {
              return require(['modules/campanias/index']);
            }
          },
          allActions: function() {}
        }
      },
      allControllers: function() {
        require(['modules/all/initParsley', 'modules/all/menu']);
      }
    };
    getCtrl = function(schema) {
      var action, actions, controller, parents;
      for (parents in schema) {
        parents = parents;
        if (parents === 'controllers') {
          for (controller in schema[parents]) {
            if (controller === alpha.controller) {
              for (actions in schema[parents][controller]) {
                for (action in schema[parents][controller][actions]) {
                  if (action === alpha.action) {
                    schema[parents][controller][actions][action]();
                  }
                }
              }
            }
          }
        }
        if (parents === 'allControllers') {
          schema[parents]();
        }
      }
    };
    getCtrl(window.schema);
  });

}).call(this);
