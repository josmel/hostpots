(function() {
  require(['loadmap'], function() {
    var catchDom, dom, functions, st;
    console.log("maps...");
    st = {
      map: '#map'
    };
    dom = {};
    catchDom = function() {};
    catchDom();
    functions = {
      initMap: function() {
        $('.google-map').lazyLoadGoogleMaps({
          callback: function(container, map) {
            var $container, center;
            $container = $(container);
            center = new google.maps.LatLng($container.attr('data-lat'), $container.attr('data-lng'));
            map.setOptions({
              zoom: 15,
              center: center
            });
            new google.maps.Marker({
              position: center,
              map: map,
              animation: google.maps.Animation.DROP,
              icon: '../client/img/icon_map.png'
            });
            google.maps.event.addListenerOnce(map, 'idle', function() {
              $container.addClass('is-loaded');
            });
          }
        });
      }
    };
    functions.initMap();
  });

}).call(this);
