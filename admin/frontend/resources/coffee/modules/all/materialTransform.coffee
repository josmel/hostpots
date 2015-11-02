define('materialTransform', ['lib_materialDesign','lib-ext_materialAnimations'], () ->
	console.log "Material transform..."
	$.material.init()
	#Sidebar response
	height = $(window).height()
	minusHeight = $("header").outerHeight()
	$(".container-sidebar").css("height",height - minusHeight)
	$(window).on "resize", ()->
		height = $(window).height()
		$(".container-sidebar").css("height",height - minusHeight)
	return
)