require(['loadmap'], () ->
	st =
		map : '#map'
	dom = {}
	markersArray = [];
	catchDom = ->		
		return
	catchDom()
	functions =
		calculateAndDisplayRoute : (directionsService, directionsDisplay,map) ->
			directionsService.route {
				origin: "-12.0968055,-76.989225"
				destination: "-12.0971378,-76.99505569999997"
				travelMode: google.maps.TravelMode.DRIVING
			}, (response, status) ->
				if status == google.maps.DirectionsStatus.OK
					directionsDisplay.setDirections response
				else
					window.alert 'Directions request failed due to ' + status
				return
			return

		deleteMarkers : (markersArray) ->
			i = 0
			while i < markersArray.length
				markersArray[i].setMap null
				i++
			markersArray = []
			return

		addMarker : (latlng, map,icon) ->
			markers.push new (google.maps.Marker)(
					position: latlng
					map: map
					icon: icon)
			return
		initMap: () ->
			$('.google-map').lazyLoadGoogleMaps callback: (container, map) ->
				$container = $(container)
				directionsService = new google.maps.DirectionsService;
				directionsDisplay = new google.maps.DirectionsRenderer;
				if ( $container.attr('data-lat') == ""  )
					maplat= "-12.046374"
					maplng=	"-77.0427934"
				else
					maplat= $container.attr('data-lat')
					maplng=	$container.attr('data-lng')						
				center = new (google.maps.LatLng)(maplat, maplng)
				map.setOptions
					zoom: 7
					center: center
				directionsDisplay.setMap(map)
				google.maps.event.addListenerOnce map, 'idle', ->
					$container.addClass 'is-loaded'
					return
				functions.calculateAndDisplayRoute(directionsService, directionsDisplay,map)
			return
	functions.initMap()
	return
)