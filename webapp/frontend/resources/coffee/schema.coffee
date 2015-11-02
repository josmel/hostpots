require.config
	baseUrl: '../../../client/js'
	waitSeconds: 5
	urlArgs: 'v=' + (new Date()).getTime()
	paths:
		'libBxSlider': 'vendor/bxslider-4/dist/jquery.bxslider'
		'libParsley': 'libs/parsleyjs/dist/parsley.min'
		'lib_underscore':'libs/underscore/underscore'
		'es': 'libs/parsleyjs/src/i18n/es'
		'async': 'libs/requirejs-plugins/src/async'
		'loadmap' : 'libs/loadmap/loadmap.min'
		'alert' :'libs/sweetalert/dist/sweetalert.min'
		'jqutils' :'libs/jqutils/jq-utils'
		'moment' : 'libs/moment/moment'
		'datetimepicker' :'libs/datetimepicker/build/js/bootstrap-datetimepicker.min'
		'bootstrap' : 'libs/bootstrap/dist/js/bootstrap.min'
		'tooltip' : 'libs/tooltip/jquery.tooltipster.min'
define('jquery', [], () ->
	return jQuery
)

define [], ->
	window.schema = 
		controllers:
			'index':
				actions: 
					index: ->
						require(['modules/index/index'])
				allActions: ->
			'solicitar':
				actions: 
					solicitar: ->
						require(['modules/solicitar/pasos','moment','bootstrap','datetimepicker'])
				allActions: ->
			'activo':
				actions: 
					index: ->
						require(['modules/activos/handleDatatable'])
					detalle: ->
						require(['modules/activos/mapa'])						
				allActions: ->
			'completados':
				actions: 
					index: ->
						require(['modules/completados/handleDatatable'])
					detalle: ->
						require(['modules/completados/mapa'])						
				allActions: ->	
			'perfil':
				actions: 
					index: ->
						require(['modules/perfil/index','modules/perfil/handleDatatable'])
				allActions: ->													
		allControllers: ->
			require(['modules/all/initParsley','modules/all/menu'])
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