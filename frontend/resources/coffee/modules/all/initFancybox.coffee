require(['libFancybox'], () ->
	st =
		popup : '.popup'
		login : '.login_popup'
		unete : '.popup_unete'
		cancelar : '.close_cancelar'
	dom = {}

	catchDom = ->
		dom.popup = $(st.popup)
		dom.login = $(st.login)
		dom.unete = $(st.unete)
		dom.cancelar = $(st.cancelar)
		return
	catchDom()

	functions =
		initFancybox: () ->
			dom.popup.fancybox(
				width: 468
				fitToView : 'false'
				scrolling: 'no'
				padding : 0
				autoSize : 'false'
			)

			dom.unete.fancybox(
				width: 468
				padding : 0		
				fitToView: 'true'
				scrolling: 'no'
				afterShow: ()->
				 	$('.fancybox-close').css('top','60px')
					$(window).on 'resize.fancybox': ->
						$.fancybox.update()
						return
			)
			dom.login.fancybox(
				width: 468
				padding : 0		
				fitToView: 'true'
				scrolling: 'no'
				afterShow: ()->
				 	#$('.fancybox-close').css('top','15px')
					$(window).on 'resize.fancybox': ->
						$.fancybox.update()
						return
			)
			return
	$(window).scroll ->
		$("body").css("height", "auto")
	functions.initFancybox()
	return
)