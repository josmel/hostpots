require(['lib_underscore','jqutils' ], () ->
	console.log "show Table active"
	st =
		table : 'table'
		rowTpl : '.row4Table'
	dom = {}
	catchDom = ->	
		dom.table = $(st.table)
		dom.rowTpl = _.template $(st.rowTpl).html()
		return
	catchDom()
	suscribeEvents = ->
		$('.list_anio').on 'change' , events.cbo
		$('.list_mes').on 'change' , events.cbo
		$('.list_dia').on 'change' , events.cbo
	events =
		cbo : ()->
			functions.showInitialTable()
	functions =
		showInitialTable: ()->
			utils.loader($(".table"),true)
			year = $('.list_anio').val()
			month = $('.list_mes').val()
			day = $('.list_dia').val()
			html = ""
			$.ajax
				method: "POST",
				url: "/admclient/solicitar/activos"
				data: { year: year, month: month ,day : day,complet:1}
				success: (json)->
					console.log json
					utils.loader($(".table"),false)
					for val, indx in json.data
						val.css_class = functions.classForState(val.delivery_state_id) #change @ replace dummy
						valor = dom.rowTpl(val)
						html += valor
					$("tbody").html html
		classForState: (state)->
			css = ""
			switch state
				when 1
					css = "fondo_celeste"
				when 2
					css = "fondo_azul"
				when 3
					css = "fondo_verde_claro"
				when 4
					css = "fondo_verde"
			return css
		showdate:()->
			i = 1
			while i <= 31
				$('.list_dia').append '<option value=' + i + '>' + i + '</option>'
				i++
			a = 1	
			while a <= 12
				$('.list_mes').append '<option value=' + a + '>' + a + '</option>'
				a++
			k = 2015
			while k <= 2030
				$('.list_anio').append '<option value=' + k + '>' + k + '</option>'
				k++	
	suscribeEvents()							
	functions.showdate()
	functions.showInitialTable()
	return
)