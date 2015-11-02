require(['libBxSlider'], () ->
	st =
		body : 'body, html'
		slider : '.slider'

	dom = {}

	catchDom = ->
		dom.body = $(st.body)
		dom.slider = $(st.slider)
		return
	catchDom()

	functions =
		initBxSlider: () ->	
			$("#section4 .first-parallax").fadeOut()
			$("#section4 .first-parallax").eq(0).fadeIn()
			window.slide = dom.slider.children('ul').bxSlider(
				'controls': true
				'auto': false
				'infiniteLoop': true
				'easing': 'ease-in'
				'speed' : 50
				'pagerCustom': '#pager'
				'mode': 'horizontal'
				'onSlideBefore': (a,b,c,d)->
					switch b
						when 0
							$("#section4 .first-parallax").fadeOut()
							$("#section4 .first-parallax").eq(c).fadeIn()
						when 1
							$("#section4 .first-parallax").fadeOut()
							$("#section4 .first-parallax").eq(c).fadeIn()							
						when 2
							$("#section4 .first-parallax").fadeOut()
							$("#section4 .first-parallax").eq(c).fadeIn()							
						when 3
							$(" #section4 .first-parallax").fadeOut()
							$("#section4 .first-parallax").eq(c).fadeIn()
					return
			)
			return

		onWindowChange: ()->
			$(window).resize ()->
				console.log "reload"
				slide.reloadSlider()
				return			
	functions.initBxSlider()
	functions.onWindowChange()
	return
)