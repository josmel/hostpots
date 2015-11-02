#require(['fullpage'], () ->
	# $('#wrapper').fullpage
	# 	verticalCentered: false
	# 	scrollingSpeed : 1500
	# 	css3: false
#)

require(['libSkrollr'], (skrollr)->
	hSec0 = $(window).height() - $("header").outerHeight()
	$("#section0").css("height", hSec0)
	$("#section2").css("height", hSec0)
	$(".parallax-image").css("height", $(window).height()+200)
	scroll = null
	functions =
		onlyDesktop: ()->
			device = navigator.userAgent.toLowerCase()
			if !(device.search(/iphone|ipod|ipad|android/) > -1)
				functions.initScroll()
				functions.onWindowChange()
				$(window).resize()
				$("body").css("height", "auto")
			return
		initScroll: ()->
			scroll = skrollr.init
						smoothScrolling: true
						smoothScrollingDuration: 0
						forceHeight: false
						scale : 1
			window.scr = scroll
			$("body").css("height", "auto")
			
			return
		onWindowChange: ()->
			$(window).resize ()->
				functions.changeSlider()
				scroll.refresh()
				$("body").css("height", "auto !important");
				return
		changeSlider: ()->

	functions.onlyDesktop()
)