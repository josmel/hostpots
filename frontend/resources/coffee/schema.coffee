require.config
	baseUrl: 'js/'
	waitSeconds: 5
	urlArgs: 'v=' + (new Date()).getTime()
	paths:
		'libSkrollr': 'vendor/skrollr/dist/skrollr.min'
		'libPlax': 'vendor/plax/js/plax'
		'libBxSlider': 'vendor/bxslider-4/dist/jquery.bxslider'
		'libParsley': 'vendor/parsleyjs/dist/parsley.min'
		'libMalihu': 'vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min'
		'libParallax': 'vendor/Parallax-ImageScroll/jquery.imageScroll'
		'es': 'vendor/parsleyjs/src/i18n/es'
		'libSuperscrollorama': 'vendor/SuperScrollorama/js/jquery.superscrollorama'
		'libTweenmax': 'vendor/SuperScrollorama/js/greensock/TweenMax.min'
		'libFancybox': 'vendor/fancybox/source/jquery.fancybox'
		'fullpage' : 'vendor/fullpage.js/jquery.fullPage.min'
		'slimscroll':'vendor/fullpage.js/vendors/jquery.slimscroll.min'
		'async': 'vendor/requirejs-plugins/src/async'
		'domReady' :'vendor/domready/ready.min'
		'alert' :'vendor/sweetalert/dist/sweetalert.min'
		'jqutils' :'vendor/jqutils/jq-utils' 
define('jquery', [], () ->
	return jQuery
)
define [], ->
	window.schema = 
		controllers:
			'index':
				actions:
					index: ->
						require(['modules/all/fullpage','modules/index/initBxSlider','modules/all/initFancybox','modules/index/index','modules/index/login','modules/all/initMalihu'])
					registrate: ->
						require(['modules/all/initMalihu'])	
				allActions: ->
					return
			'faq':
				actions:
					index: ->
						require(['modules/all/tabs','modules/all/initFancybox','modules/index/login'])
					registrate: ->
						require(['modules/all/initMalihu'])		
				allActions: ->
					return
			'terms':
				actions:
					index: ->
						require(['modules/all/initFancybox', 'modules/all/fullpage','modules/index/login'])
					registrate: ->
						require(['modules/all/initMalihu'])		
				allActions: ->
					return					
			'work':
				actions:
					index: ->
						require(['modules/all/file','modules/all/initFancybox','modules/all/fullpage','modules/index/login'])
					registrate: ->
						require(['modules/all/initMalihu'])							
				allActions: ->
					return
			'us':
				actions:
					index: ->
						require(['modules/all/file','modules/all/initFancybox','modules/all/fullpage','modules/index/login'])
					registrate: ->
						require(['modules/all/initMalihu'])							
				allActions: ->
					return					
			'comunity':
				actions:
					index: ->
						require(['modules/all/initFancybox','modules/all/fullpage','modules/index/login'])
					unete: ->
						require(['modules/all/initMalihu'])
					registrate: ->
						require(['modules/all/initMalihu'])							
				allActions: ->
					return
			'contact':
				actions:
					index: ->
						require(['modules/contact/initGoogleMaps','modules/all/initFancybox','modules/index/login'])
					registrate: ->
						require(['modules/all/initMalihu'])					
				allActions: ->
					return
		allControllers: ->
			require(['modules/all/initParsley','modules/all/responsiveThings'])
			return
	getCtrl = (schema) ->
		for parents of schema
			parents = parents
			if parents == 'controllers'
				for controller of schema[parents]
					if controller == alpha.controller
						for actions of schema[parents][controller]
							for action of schema[parents][controller][actions]
								if action == alpha.action
									schema[parents][controller][actions][action]()
			if parents == 'allControllers'
				schema[parents]()
		return
	getCtrl window.schema
	return