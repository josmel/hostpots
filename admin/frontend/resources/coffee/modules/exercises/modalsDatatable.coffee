define('modalsDatatable',['lib_fancybox'], ()->
	console.log "Modals Datatable Binded......."
	st =
		img : '.image-datatable'
		vid : 'video'
		table : '#categoryTable'
	dom = {}
	catchDom = ->
		dom.img = $(st.img)
		dom.table = $(st.table)
		return
	suscribeEvents = ->
		$("body").on 'click', '.image-datatable', ()->
			$this = $(this)
			events.clickImg($this)
			return
		# $("body").on 'click', 'video', ()->
		# 	console.log "click video"
		# 	$this = $(this)
		# 	video = $this.parent().html()
		# 	ctn = "<video width='500' height='400'><source src='http://local.ibody/dinamic/video/tino.mp4' type='video/mp4'></source> Tu navegador no soporta video</video>"
		# 	$.fancybox
		# 		content: ctn
		# 	return
		return
	events =
		clickImg : (obj)->
			functions.showModal(obj)
			return
	functions =
		showModal : (obj)->
			ctn = obj.attr("src")
			img = "<img src='"+ctn+"'>"
			$.fancybox
				content: img
			return
	initialize = () ->
		catchDom()
		suscribeEvents()
		return
	return {
		init: initialize()
	}
)