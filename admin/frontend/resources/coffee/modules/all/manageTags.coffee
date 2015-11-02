define('manageTags',['lib_fancybox','lib_underscore','lib_chosen','lib_jqutils'], ()->
	console.log "manageTags Binded......."
	st =
		tag : '.tag-exercise'
		tagMore : '.more-exercise'
		tplTags : '#addTagsExercise'
		select : '.multiselect-custom'
		tagDelete : '.tag-exercise .icon-remove'
	dom = {}
	catchDom = ->
		dom.tag = $(st.tag)
		dom.tagMore = $(st.tagMore)
		dom.tplTags = _.template $(st.tplTags).html()
		dom.select = $(st.select)
		dom.tagDelete = $(st.tagDelete)
		return
	suscribeEvents = ->
		$("body").on "click", st.tagMore, ()->
			$this = $(this)
			utils.loader $("body"), true
			functions.addExerciseModal($this)
		$("body").on 'click', st.tagDelete, events.deleteTag
		return
	events=
		generateModals : ->
			return
		deleteTag: ()->
			$this = $(this)
			functions.deleteTag($this)
	functions =
		deleteTag: (obj)->
			idTag = obj.parent().data("id")
			idParent = obj.parents("tr").find(".more-exercise").data("id")
			utils.loader($("body"), true)
			$.ajax
				url: "/admpanel/delete-routine-exercise"
				method: "POST"
				data:
					runtime: idParent
					exercise: idTag
				success: (json)->
					console.log json
					window.tables['categoryTable'].fnDraw()
					utils.loader($("body"), false)
					echo "Data have been updated"
				error: ()->
					utils.loader($("body"), false)
					echo "An error has occurred, try again"
			return
		addExerciseModal : (obj)->
			$.ajax
				url: "/admpanel/get-exercise"
				success: (json)->
					html = ""
					data = {}
					excer = obj.data("exercises").split(",")
					console.log excer
					for opt, val of json.data
						if $.inArray(opt,excer) == -1
							html = html + "<option value='"+opt+"''>"+val+"</option>"
					data.options = html
					data.idroutine = obj.data("id")
					tpl = $(dom.tplTags(data))
					$.fancybox
						content: tpl
						padding: 0
						beforeShow: ()->
							utils.loader $("body"), false
						afterShow: ()->
							console.log "todo cargo"
							$(".ctn-addTags .multiselect-custom").chosen()
							$(".ctn-addTags .btn-save").on "click", functions.saveTags
							$(".ctn-addTags .btn-cancel").on "click", $.fancybox.close
			return
		saveTags : ()->
			$.fancybox.close()
			utils.loader $("body"), true
			arr = "["+$(".multiselect-custom").val().toString()+"]"
			$.ajax
				url: "/admpanel/exercise-routine"
				method: "POST"
				data:
					routine_id : $(".idrout").val()
					exercise_id : arr
				success: (json)->
					utils.loader $("body"), false
					window.tables['categoryTable'].fnDraw()
					echo "Data have been updated"
				error: ()->
					utils.loader $("body"), false
					echo "An error has occurred, try again"
	initialize = () ->
		catchDom()
		suscribeEvents()
		return
	return {
		init: initialize()
	}
)