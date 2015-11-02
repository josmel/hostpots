define('bindJqueryUI',['lib_jquery-ui'], ()->
	console.log "JqueryUI Binded......."
	st =
		datepicker : '.js-datepicker'
		dateFilterCtn : '.js-date-filter-ctn'
		dateFilter : '.js-date-filter'
	dom = {}
	catchDom = ->
		dom.datepicker = $(st.datepicker)
		dom.dateFilter = $(st.dateFilter)
		return
	suscribeEvents = ->
		dom.datepicker.datepicker()
		$(".js-date-filter").datepicker
			dateFormat: "dd/mm/yy"
			onClose: (sDate)->
				$(".js-date-filter2").datepicker "option", "minDate", sDate
				return
		$(".js-date-filter2").datepicker
			dateFormat: "dd/mm/yy"
			onClose: (sDate)->
				$(".js-date-filter").datepicker "option", "maxDate", sDate
				return
		$(".btn-filter").on "click", ()->
			console.log "click"
			if $(".js-date-filter").val() != "" and $(".js-date-filter2").val() != ""
				#window.tables["categoryTable"].fnDraw()
				fnTable = window.tables["categoryTable"].fnDestroy()
				url = "/admpanel/delivery/list?datastart="+$(".js-date-filter").val()+"&dataend="+$(".js-date-filter2").val()
				col = $("#categoryTable").attr('data-col')
				array= col.split(",");
				obj = []
				for key of array
					obj.push data : array[key]
				window.tables["categoryTable"] = $("#categoryTable").dataTable(
					processing: true
					serverSide: true
					ordering: false
					bLengthChange: false
					ajax:
						url: url
					columns: obj
					columnDefs : [
						'searchable': false
					]
					fnDrawCallback: ()->
						$.material.init()
				)
			else
				warn "Se necesitan ambos valores para filtrar"
		return
	events=
		generateModals : ->
			return
		filterDatatable : ->
			console.log "si lo filtra"
			return
	functions =
		generateModals : (obj)->
			return
	initialize = () ->
		catchDom()
		suscribeEvents()
		return
	return {
		init: initialize()
	}
)