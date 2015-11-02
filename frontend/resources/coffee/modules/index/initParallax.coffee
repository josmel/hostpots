require(['libTweenmax', 'libSuperscrollorama'], () ->
	st =
		body : 'body, html'
		slider : '.slider'

	dom = {}

	catchDom = ->
		dom.body = $(st.body)
		dom.slider = $(st.slider)
		return
	catchDom()

	controller = $.superscrollorama()

	controller
		.addTween('#section2', TweenMax.from($('#section2'), .5, {css: {opacity: .2}}))
		.addTween('#section2', TweenMax.from($('#section2 h2'), .5, {css: {bottom: '450px'}}))
		.addTween('#section3', TweenMax.from($('#section2 h2'), .5, {css: {bottom: '450px'}}))
		.addTween('#section3', TweenMax.from($('.como-funciona > ul > li:nth-child(1)'), .5, {css: {opacity: 0, top: '450px'}}))
		.addTween('#section3', TweenMax.from($('.como-funciona > ul > li:nth-child(2)'), .8, {css: {opacity: 0, top: '450px'}}))
		.addTween('#section3', TweenMax.from($('.como-funciona > ul > li:nth-child(3)'), 1.1, {css: {opacity: 0, top: '450px'}}))
		.addTween('#section4', TweenMax.from($('#section4'), .5, {css: {opacity: 0}}))
		.addTween('#section4', TweenMax.from($('#pager > a:nth-child(1)'), .5, {css: {rotation: 90}}))
		.addTween('#section4', TweenMax.from($('#pager > a:nth-child(2)'), .8, {css: {rotation: 90}}))
		.addTween('#section4', TweenMax.from($('#pager > a:nth-child(3)'), 1.1, {css: {rotation: 90}}))
		.addTween('#section4', TweenMax.from($('#pager > a:nth-child(4)'), 1.4, {css: {rotation: 90}}))
		.addTween('#section5', TweenMax.from($('#section5 h2'), .5, {css: {opacity: 0}}))
		.addTween('#section5', TweenMax.from($('#section5 a'), 1, {css: {opacity: 0}}))
		.addTween('#section5', TweenMax.from($('#section5 img'), 1.5, {css: {opacity: 0}}))

	return
)