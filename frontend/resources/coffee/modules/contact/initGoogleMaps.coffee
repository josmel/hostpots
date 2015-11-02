require(['async!http://maps.google.com/maps/api/js?sensor=false'], () ->
	console.log "maps..."
	styles = [
		{
			stylers: [
				{hue: '#23cefd'}
			]
		}
	]
	st =
		map : '#map'
		footer: 'footer'
		header: 'header'
	dom = {}

	catchDom = ->
		dom.map = $(st.map)
		dom.footer = $(st.footer)
		dom.header = $(st.header)
		return
	catchDom()

	functions =
		setMapHeight: () ->
			hHeader = dom.header.outerHeight()
			hFooter = dom.footer.outerHeight()
			hMap = $(window).height() - hHeader - hFooter
			if hMap < 650
				hMap = 650
			console.log hHeader
			console.log hFooter
			console.log $(window).height()
			dom.map.height(hMap)
			$("#section-1__contact").height(hMap-50)
		initMap: () ->
			if($(window).width() > 550)
				functions.setMapHeight()
			styledMap = new google.maps.StyledMapType(styles)
			map = new google.maps.Map(document.getElementById('map'),
				center:
					lat: -12.1161982
					lng: -76.9852619
				zoom: 15
				mapTypeControlOptions:
					mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
			)
			marker = new google.maps.Marker(
				position:
					lat: -12.1161982
					lng: -76.9852619
				map: map
				animation: google.maps.Animation.DROP
				icon: 'img/pin.png'
			)
			map.mapTypes.set('map_style', styledMap)
			map.setMapTypeId('map_style')
			return

	functions.initMap()
	return
)