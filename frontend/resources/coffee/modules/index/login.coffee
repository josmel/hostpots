require(['alert','jqutils'], () ->
	st =
		form : '#form_login'
	dom = {}
	catchDom = ->
		dom.form = $(st.form)
		return
	suscribeEvents = ->
		dom.form.on 'submit' , events.form 
		return
	events =
		form : (e)->
			e.preventDefault()
			data = dom.form.serialize()
			url = "/login"
			utils.loader($("body"),true)
			$.post(url, data).done (data) ->
				utils.loader($("body"),false)
				if ( data.state == 1)
					location.href = data.dataredirect
					$.fancybox.close()
				else
					swal
						title : 'Error'
						text: 'Estas credenciales no coinciden con nuestros registros'
						type: 'error',
						timer: 2000
						showConfirmButton: false
				return
			return
	catchDom()
	suscribeEvents()
	return
)