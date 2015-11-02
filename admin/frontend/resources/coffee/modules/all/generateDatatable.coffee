define('generateDatatable', ['lib_jqutils','datatables','lib_underscore','lib_fancybox','lib_parsleyJs'], () ->
	console.log "generateDatatables..."
	st =
		tables : '.tables'
		btneliminar : '.btn-eliminar'
		btnEdit : '.js-edit'
		btnDelete : '.js-delete'
		tplEdit: "#tplEdit"
		tplDelete: "#tplDelete"
		btnVideo : ".exercise-video"
	dom = {}
	dtable= ""
	catchDom = ->
		dom.tables = $(st.tables)
		dom.btneliminar = $(st.btneliminar)
		dom.tplEdit = _.template $(tplEdit).html()
		dom.tplDelete = _.template $(tplDelete).html()
		return
	suscribeEvents = ->
		$('body').on 'click' ,'.action_del' , events.search
		dom.btneliminar.on 'click' , events.btneliminar
		$('body').on 'click', st.btnEdit, events.btnEdit
		$('body').on 'click', st.btnDelete, events.btnDelete
		$('body').on 'click', st.btnVideo, events.btnShowVideo
		return
	events =
		btnShowVideo: ()->
			$this = $(this)
			functions.showVideo($this)
		btnEdit: (e)->
			$this = $(this)
			id = $this.data "id"
			functions.showEdit(id)
		btnDelete: (e)->
			$this = $(this)
			id = $this.data "id"
			data = {}
			data.id = id
			console.log $this.data("other")
			data.msg = "Delete this record?"
			if $this.data("other") == 1
				data.msg = "This record is related to a routine. Delete this registry anyway?"
			functions.showDelete(data)
		search : (e) ->
			e.preventDefault()
			url = $(this).attr("data-url")
			dom.btneliminar.attr("data-url",url)
			return
		btneliminar : (e) ->
			e.preventDefault()
			url = $(this).attr("data-url")
			functions.delete(url)
	functions =
		showVideo : (obj)->
			urlVideo = obj.data("url")
			txtVideo = "<video controls width=640 height=360><source src='"+urlVideo+"' type='video/mp4'><p>Your browser does not support H.264/MP4.</p></video>"
			$.fancybox
				content: txtVideo
		showEdit: (id)->
			data = {}
			urlEdit = $("#tplEdit").data "initial"
			$.ajax
				url: urlEdit
				data:
					id: id
				method: "GET"
				success: (json)->
					console.log json.data
					data = json.data
					$.fancybox
						content: dom.tplEdit(data)
						padding: 0
						afterShow: ()->
							$("#editForm").parsley()
							functions.sendForms $("#editForm")
							$.material.init()
		showDelete: (data)->
			$.fancybox
				content: dom.tplDelete(data)
				padding: 0
				afterShow: ()->
					$("#deleteForm").parsley()
					functions.sendForms $("#deleteForm")
					$.material.init()
					$(".modal-ctn .btn-danger").on "click", ()->
						$.fancybox.close()
		sendForms: (obj)->
			obj.on "submit", (e)->
				e.preventDefault()
				$this = $(this)
				data = $this.serialize()
				utils.loader($("body"), true)
				$.ajax
					url: $this.data("url")
					data: data
					method: $this.data("method")
					success: (json)->
						window.tables[obj.parents('body').find('table').attr('id')].fnDraw()
						$.fancybox.close()
						utils.loader($("body"), false)
						echo "Data have been updated"
					error: ()->
						echo "An error has occurred, try again"
		makeTables: () ->
			functions.initData(dom.tables)
		delete: (url)->
			$.get(url).done (data) ->
				dtable.fnDraw()
				$('.md_confirmacion').modal('hide')
				return
		initData :(idtable)->
			col = idtable.attr('data-col')
			url = idtable.attr('data-url')
			ft = idtable.attr('data-nofilter')
			array= col.split(",");
			obj = []
			i = 0
			for key of array
				obj.push data : array[key]
			console.log "new"
			id = idtable.attr("id")
			window.tables = []
			window.tables[id] = idtable.dataTable(
				processing: true
				serverSide: true
				ordering: false
				bLengthChange: false
				ajax:
					url: url
				columns: obj
				columnDefs : [
					'searchable': false
					'targets':ft
				]
				fnDrawCallback: ()->
					$.material.init()
			)
			dtable = window.tables[id]
			return
	initialize = ->
		catchDom()
		suscribeEvents()
		functions.makeTables()
		return
	return {
		init: initialize()
	}
)