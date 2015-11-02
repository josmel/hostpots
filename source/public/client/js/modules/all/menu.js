(function() {
  require([], function() {
    var catchDom, dom, events, st, suscribeEvents;
    st = {
      menu: '.menu'
    };
    dom = {};
    catchDom = function() {
      dom.menu = $(st.menu);
    };
    suscribeEvents = function() {
      dom.menu.on('click', events.menu);
    };
    events = {
      menu: function() {
        if ($('.l-site').hasClass('is-open')) {
          $('.menu').removeClass('is-active');
          $('.l-site').removeClass('is-open');
        } else {
          $('.menu').addClass('is-active');
          $('.l-site').addClass('is-open');
          $('.l-nav').css('display', 'block');
        }
      }
    };
    catchDom();
    suscribeEvents();
  });

}).call(this);
