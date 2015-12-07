(function() {
  define('modalsDatatable', ['lib_fancybox'], function() {
    var catchDom, dom, events, functions, initialize, st, suscribeEvents;
    console.log("Modals Datatable Binded.......");
    st = {
      img: '.image-datatable',
      vid: 'video',
      table: '#categoryTable'
    };
    dom = {};
    catchDom = function() {
      dom.img = $(st.img);
      dom.table = $(st.table);
    };
    suscribeEvents = function() {
      $("body").on('click', '.image-datatable', function() {
        var $this;
        $this = $(this);
        events.clickImg($this);
      });
    };
    events = {
      clickImg: function(obj) {
        functions.showModal(obj);
      }
    };
    functions = {
      showModal: function(obj) {
        var ctn, img;
        ctn = obj.attr("src");
        img = "<img src='" + ctn + "'>";
        $.fancybox({
          content: img
        });
      }
    };
    initialize = function() {
      catchDom();
      suscribeEvents();
    };
    return {
      init: initialize()
    };
  });

}).call(this);
