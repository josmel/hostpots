require(['loadmap'], () ->
	console.log "maps..."
	st =
		map : '#map'
	dom = {}
	catchDom = ->		
		return
	catchDom()
	functions =
		marker :(marker,lat,lon)->
			google.maps.event.addListener marker, 'dragend', (event) ->
				$(lat).val @getPosition().lat()
				$(lon).val @getPosition().lng()
			return			
		initMap: () ->
			$('.google-map').lazyLoadGoogleMaps callback: (container, map) ->
				$container = $(container)
				latitud = "#form_perfil input[name=latitude]"
				longitud = "#form_perfil input[name=longitude]"

				if ( $container.attr('data-lat') == ""  )
					maplat= "-12.046374"
					maplng=	"-77.0427934"
				else
					maplat= $container.attr('data-lat')
					maplng=	$container.attr('data-lng')						
				center = new (google.maps.LatLng)(maplat, maplng)
				map.setOptions
					zoom: 15
					center: center
				marker = new (google.maps.Marker)(
					position: center
					map: map
					draggable: true
					animation: google.maps.Animation.DROP
					icon: '../client/img/icon_map.png'
					)			
				google.maps.event.addListenerOnce map, 'idle', ->
					$container.addClass 'is-loaded'
					return
				input = document.getElementById("dir_perfil")
				searchBox = new google.maps.places.SearchBox(input)					
				map.addListener 'bounds_changed', ->
					searchBox.setBounds map.getBounds()
					return
				searchBox.addListener 'places_changed', ->
					places = searchBox.getPlaces()
					if places.length == 0
						return
					bounds = new (google.maps.LatLngBounds)
					places.forEach (place) ->
						marker.setMap null
						marker = new (google.maps.Marker)(
							map: map
							icon : '../client/img/icon_map.png'
							draggable: true
							title: place.name
							position: place.geometry.location)
						$(latitud).val marker.getPosition().lat()
						$(longitud).val marker.getPosition().lng()				
						if place.geometry.viewport
							bounds.union place.geometry.viewport
						else
							bounds.extend place.geometry.location
						return
					map.fitBounds bounds
					functions.marker(marker,latitud,longitud)
					return
				functions.marker(marker,latitud,longitud)
			return
	functions.initMap()
	return
)