define('parsleyValidator', ['lib_parsleyJs','lib-ext_parsleyEsp'], () ->
	console.log "parsleyValidator..."
	window.ParsleyValidator.addValidator('requiredfile', ((value) ->
		return false
	), 512)
	intervalo = setInterval(()->
		obj = $(".js-uploadInput")
		if obj.is(":visible")
			if !$(".file-preview-thumbnails").is(":visible") and obj.attr("requiredfile") != undefined
				obj.attr("data-parsley-required",true);
				obj.parsley().reset()
				clearInterval(intervalo)
	, 500)
)