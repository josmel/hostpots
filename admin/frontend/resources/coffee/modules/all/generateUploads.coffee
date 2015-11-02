define('generateUploads', ['lib_uploadJs', 'lib-ext_spanishUpload'], ()->
	console.log "generateUploads......."
	st =
		input: '.js-uploadInput'
		video : '.js-uploadInputVideo'
		videoFemale: '.js-uploadInputVideoFemale'
	dom = {}
	catchDom = ->
		dom.input = $(st.input)
		dom.video = $(st.video)
		dom.videoFemale = $(st.videoFemale)
		return
	suscribeEvents = ->
		image = ''
		video = ''
		videoFemale = ''
		if($('#image-rountine').val() != '')
			image =  "<img src='"+ $('#image-rountine').val()+"' class='file-preview-image' alt='Desert' title='Desert'>"
		if($('#video-rountine').val() != '')
			video = "<video width='213px' height='160px' controls class='file-preview-image'><source src='"+$('#video-rountine').val()+"' type='video/mp4'><div class='file-preview-other'><i class='glyphicon glyphicon-file'></i></div></video>"
		if($('#video-rountine-female').val() != '')
			videoFemale = "<video width='213px' height='160px' controls class='file-preview-image'><source src='"+$('#video-rountine-female').val()+"' type='video/mp4'><div class='file-preview-other'><i class='glyphicon glyphicon-file'></i></div></video>"
		dom.input.on "fileclear", ()->
			$this = $this
			dom.input.attr "required", ""
		dom.video.on "fileclear", ()->
			$this = $this
			dom.video.attr "required", ""
		dom.videoFemale.on "fileclear", ()->
			$this = $this
			dom.videoFemale.attr "required", ""

		dom.input.fileinput
			allowedFileExtensions: ["jpg", "png"]
			uploadAsync: true
			maxFileCount: 5
			initialPreview: image
		dom.video.fileinput
			allowedFileExtensions: ["mp4","ogg","webm","mov"]
			uploadAsync: true
			maxFileCount: 1
			initialPreview: video
		dom.videoFemale.fileinput
			allowedFileExtensions: ["mp4","ogg","webm","mov"]
			uploadAsync: true
			maxFileCount: 1
			initialPreview: videoFemale
		#uploadUrl: dom.input.data("url")
		dom.input.on "fileuploaded", (e, data, previewId, index)->
			console.log data
			console.log e
			console.log previewId
			console.log index
		return
	events =
		recargarTable: ->
			console.log 'Redraw occurred at: ' + (new Date).getTime()
			return
	functions =
		datatable: ->
			return
	initialize = () ->
		catchDom()
		suscribeEvents()
		return
	return {
	init: initialize()
	}
)