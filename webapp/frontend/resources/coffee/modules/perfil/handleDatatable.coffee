require(['lib_underscore','alert' ], () ->
	console.log "show Table perfil"
	st =
		table : 'table'
		rowTpl : '.row4Table'
		formContact : '#formContact'
	dom = {}
	catchDom = ->	
		dom.table = $(st.table)
		dom.rowTpl = _.template $(st.rowTpl).html()
		dom.formContact = $(st.formContact)
		return
	catchDom()
	suscribeEvents = ->
		$('body').on 'click','.del_contact',events.delete
		$('body').on 'click','.edit_contact',events.edit
		dom.formContact.on 'submit' , events.form 
	events =
		form : (e)->
			e.preventDefault()
			datos = $(this).serialize()
			url =$(this).attr "action"			
			if $('#formContact input[name=id]').val() == ""
				men_titulo_nuevo = "Registro Correcto"
				men_description_nuevo = 'Se agrego al contacto.'
			else
				men_titulo_nuevo = "Registro Actualizado"
				men_description_nuevo = 'Se actualizo al contacto.'
			$.post url,datos, (data) ->
				if (data.state == 1)
					swal men_titulo_nuevo, men_description_nuevo, 'success'
					$('#formContact')[0].reset()
					$('#formContact').find('input').removeClass('parsley-success')
					functions.showInitialTable()
				else
					swal 'Error', 'Hubo un error , intentelo de nuevo', 'error'
			return
			return
		edit : (e)->
			e.preventDefault()
			edit = $(this).parent().parent().parent()
			id = edit.attr "data-id"
			name = edit.children().eq(0).text().trim()
			cellphone = edit.children().eq(1).text().trim()
			phone = edit.children().eq(2).text().trim()
			email = edit.children().eq(3).text().trim()
			$('#formContact input[name=id]').val id
			$('#formContact input[name=name]').val name
			$('#formContact input[name=phone]').val phone
			$('#formContact input[name=cellphone]').val cellphone
			$('#formContact input[name=email]').val email
		delete : (e)->
			e.preventDefault()
			url = $(this).attr "data-url"
			name = $(this).attr "data-nom"
			swal {
				title: '¿Confirmar para eliminar?'
				text: 'Estas seguro de eliminar a ' + name
				type: 'warning'
				showCancelButton: true
				confirmButtonColor: '#DD6B55'
				confirmButtonText: 'ELIMINAR!'
				cancelButtonText: 'CANCELAR'
				closeOnConfirm: false
				closeOnCancel: false
			}, (isConfirm) ->
				if isConfirm
					$.get url, (data) ->
						if (data.state == 1)
							swal 'Eliminado', 'Se elimino el contacto.', 'success'
							functions.showInitialTable()
						else
							swal 'Error', 'Hubo un error , intentelo de nuevo', 'error'
					return
					
				else
					swal 'Ops', 'Se cancelo la accion', 'error'
				return
	functions =
		showInitialTable: ()->
			html = ""
			url = dom.table.attr "data-url"
			$.ajax
				url: url
				success: (json)->
					for val, indx in json.data
						valor = dom.rowTpl(val)
						html += valor
					$("tbody").html html
	functions.showInitialTable()
	suscribeEvents()
	return
)