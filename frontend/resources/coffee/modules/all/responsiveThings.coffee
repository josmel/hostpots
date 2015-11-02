require([], ()->
	console.log "responsive things"
	st =
		fullHeightCtn: '.fullHeightCtn'
	dom = {}
	catchDom = ->
		dom.fullHeightCtn = $(st.fullHeightCtn)
		return
	catchDom()

	functions =
		changeHeightPages: ($obj, $windowHeight)->
			#Receive jquery obj array for change their height
			$obj.each ()->
				$this = $(this)
				if $this.attr("id") == "section5"
					device = navigator.userAgent.toLowerCase()
					if !(device.search(/iphone|ipod|ipad|android/) > -1)
						#Incident: #section5 have to be a full page with footer included
						$windowHeight = $windowHeight - $("footer").outerHeight() - $("header").height()
					else
						$windowHeight = $this.height()

				if $this.attr("id") == "section-3__us"
					device = navigator.userAgent.toLowerCase()
					if !(device.search(/iphone|ipod|ipad|android/) > -1)
						#Incident: #section-3__us have to be a full page with parcial footer
						console.log $windowHeight
						$windowHeight = $windowHeight - $("header").outerHeight() - $("footer").height()
					else
						$windowHeight = $this.height()
				$this.css "height", $windowHeight
				$this.css "max-height", "none"
				return
		generateFullHeights:()->
			#Calculate the window height and execute fn.changeHeightPages
			$windowHeight = $(window).height() - $("header").height()
			functions.changeHeightPages dom.fullHeightCtn, $windowHeight
			return
		changeOnResize: ()->
			#Execute generate FullHeights when window resizes
			$(window).resize ()->
				functions.generateFullHeights()
				return
			return
		initMenu: ()->
			$(".menu-responsive").on "click", ()->
				$(".menu").parents("section").toggleClass "showMenu"
			return
	functions.initMenu()
	functions.changeOnResize()
	functions.generateFullHeights()
)