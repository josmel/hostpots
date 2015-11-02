(function() {
  define([], function() {
    var getCtrl;
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
