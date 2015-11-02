(function() {
  var alpha;

  alpha = window.alpha;

  if (typeof alpha === 'undefined') {
    alpha = {};
  }

  (function() {
    var act, ctrl, mod;
    mod = alpha.module;
    ctrl = alpha.controller;
    act = alpha.action;
    console.log('==> mod: ' + mod + ' - ctrl: ' + ctrl + ' - act: ' + act);
  })();

  require(['schema']);

}).call(this);
