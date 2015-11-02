require([],() ->
	console.log "vendeindeopd vneidnienveo"
	st =
		body : 'body, html'
		scroll : '.scroll'
		nav : '#nav_linea >li >a'
		bottom : '.scroll_section1'
		top : '.arrow_top'
	dom = {}
	catchDom = ->
		dom.body = $(st.body)
		dom.nav = $(st.nav)
		dom.bottom = $(st.bottom)
		dom.top = $(st.top)
		dom.scroll = $(st.scroll)
		return
	suscribeEvents = ->
		dom.scroll.on 'click', events.scrollTop
		dom.nav.on 'click',events.scrollPosition
		dom.bottom.on 'click',events.volver
		dom.top.on 'click',events.scrollTop
		return

	events =
		volver :(e)->
			e.preventDefault()
			$('html, body').animate { scrollTop: $('#section1').position().top - 60 }, '2000', 'swing'
			return	
		scrollPosition :(e)->
			e.preventDefault()
			$this = $(this)
			position = $this.attr "data-section"
			$('html, body').animate { scrollTop: $(position).position().top - 60 }, '2000', 'swing'
		scrollTop : (e)->
			e.preventDefault()
			$('html, body').animate { scrollTop: $('#section0').position().top - 50 }, '2000', 'swing'	
			return
	$(window).scroll ->
		scrollTop = $(window).scrollTop()
		$("body").css("height", "auto")
		if scrollTop > $('#section0').offset().top 
			$('#nav_linea >li ').removeClass('active_nav')
			$('#nav_1').addClass('active_nav')
			$('#nav_1').parent().removeClass('change_color')
		if scrollTop > ($('#section1').offset().top - 80)
			$('#nav_linea >li ').removeClass('active_nav')
			$('#nav_2').addClass('active_nav')
			$('#nav_2').parent().addClass('change_color')
		if scrollTop > ($('#section2').offset().top-80)
			$('#nav_linea >li ').removeClass('active_nav')
			$('#nav_6').addClass('active_nav')
			$('#nav_3').parent().removeClass('change_color')	
		if scrollTop > ($('#section3').offset().top - 140)
			$('#nav_linea >li ').removeClass('active_nav')
			$('#nav_3').addClass('active_nav')
			$('#nav_3').parent().addClass('change_color')
		if scrollTop > ($('#section4').offset().top-80)
			$('#nav_linea >li ').removeClass('active_nav')
			$('#nav_4').addClass('active_nav')
			$('#nav_4').parent().removeClass('change_color')
		if scrollTop > ($('#section5').offset().top-180)
			$('#nav_linea >li ').removeClass('active_nav')
			$('#nav_5').addClass('active_nav')
			$('#nav_5').parent().addClass('change_color')						
		return
	catchDom()
	suscribeEvents()
	return
)