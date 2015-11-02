require(['loadmap'], () ->
	st =
		map : '#map'
	dom = {}
	catchDom = ->		
		return
	catchDom()
	markersp=[]
	markers=[]
	mapGlobal =""
	functions =
		calculateAndDisplayRoute : (directionsService, directionsDisplay) ->
			lat_ori = $('input[name=latitude_origin]').val()
			lon_ori = $('input[name=longitude_origin]').val()
			lat_des = $('input[name=latitude_destination]').val()
			lon_des = $('input[name=longitude_destination]').val()
			origin = lat_ori + "," + lon_ori
			dest = lat_des + "," + lon_des
			directionsService.route {
				origin: origin
				destination: dest
				optimizeWaypoints: true				
				travelMode: google.maps.TravelMode.DRIVING
			}, (response, status) ->
				if status == google.maps.DirectionsStatus.OK
					directionsDisplay.setDirections response
				else
					console.log 'Directions request failed due to ' + status
				return
			return
		calculeLine : ()->
			id = $('input[name=id]').val()
			url = '/admclient/solicitar/tracking-last/' + id
			$.get(url).done (data) ->
				myLatlng = new (google.maps.LatLng)(data.data.latitude,data.data.longitude)
				mark = new (google.maps.Marker)(
					position: myLatlng
					map: mapGlobal
					icon: '../../../client/img/icon_ruta2.png')
				markersp.push(mark)						
				return
		time :() ->
			setInterval (->
				setTimeout (->
					functions.clearMarkers()
					functions.calculeLine()
					return
				), 3000
				return
			), 5000
		setMapOnAll : (map) ->
			console.log markersp
			i = 0
			while i < markersp.length
				markersp[i].setMap map
				i++
			return
		clearMarkers : ->
			functions.setMapOnAll null
			markers = []
			return		
		initMap: () ->
			$('.google-map').lazyLoadGoogleMaps callback: (container, map) ->
				$container = $(container)
				directionsService = new google.maps.DirectionsService;
				directionsDisplay = new google.maps.DirectionsRenderer {suppressMarkers : true} ;
				if ( $container.attr('data-lat') == ""  )
					maplat= $('input[name=latitude_origin]').val()
					maplng=	$('input[name=longitude_origin]').val()
				else
					maplat= $container.attr('data-lat')
					maplng=	$container.attr('data-lng')						
				center = new (google.maps.LatLng)(maplat, maplng)
				map.setOptions
					zoom: 12
					center: center
				directionsDisplay.setMap(map)
				lat_ori = $('input[name=latitude_origin]').val()
				lon_ori = $('input[name=longitude_origin]').val()
				lat_des = $('input[name=latitude_destination]').val()
				lon_des = $('input[name=longitude_destination]').val()

				markers = [
					{
						'title': 'Aksa Beach'
						'lat': lat_ori
						'lng': lon_ori
						'description': 'Aksa Beach is a popular beach and a Mumbai.'
						'icon': '../../../client/img/icon_ruta1.png'
					}
					{
						'title': 'Juhu Beach'
						'lat': lat_des
						'lng': lon_des
						'description': 'Juhu Beach is one of favourite tourist attractions situated in Mumbai.'
						'icon': '../../../client/img/icon_ruta3.png'
					}
				]
				infoWindow = new (google.maps.InfoWindow)
				i = 0
				while i < markers.length					
					data = markers[i]					
					myLatlng = new (google.maps.LatLng)(data.lat, data.lng)
					marker = new (google.maps.Marker)(
							position: myLatlng
							map: map
							icon: data.icon
							title: data.title)
					do (marker, data) ->
						google.maps.event.addListener marker, 'click', (e) ->
							infoWindow.setContent '<div style = \'width:200px;min-height:40px\'>' + data.description + '</div>'
							infoWindow.open map, marker
							return
						return
					i++
				mapGlobal = map	
				window.lineas = functions.calculeLine
				functions.calculeLine()
				google.maps.event.addListenerOnce map, 'idle', ->
					$container.addClass 'is-loaded'
					return
				functions.calculateAndDisplayRoute(directionsService, directionsDisplay)
			return
	functions.initMap()
	functions.time()
	return
)