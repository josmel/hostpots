define('bindJqueryUI',['lib_fancybox','lib_underscore'], ()->
	console.log "generateModals Binded......."
	st =
		btnLauncher : '.js-modal'
	dom = {}
	catchDom = ->
		dom.btnLauncher = $(st.btnLauncher)
		return
	suscribeEvents = ->
		dom.btnLauncher.on "click", events.generateModals
		return
	events=
		generateModals : ->
			$this = $(this)
			functions.generateModals $this
			return
	functions =
		generateModals : (obj)->
			$this = obj
			tpl = $this.data("template")
			if($($this.data("template")).length > 0)
				dom.template = _.template $($this.data("template")).html()
				$.fancybox
					content: dom.template()
			else
				alert "undefined template " + tpl
			return
	initialize = () ->
		catchDom()
		suscribeEvents()
		return
	return {
		init: initialize()
	}
)