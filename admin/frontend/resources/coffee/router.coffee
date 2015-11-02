define [], ->
	getCtrl = (schema) ->
		schema = window.schema
		console.log schema
		for parents of schema
			parents = parents
			if parents == 'controllers'
				for controller of schema[parents]
					if controller == alpha.controller
						for actions of schema[parents][controller]
							for action of schema[parents][controller][actions]
								if action == alpha.action
									console.log "llega"
									schema[parents][controller][actions][action]()
			if parents == 'allControllers'
				schema[parents]()
				console.log 'allControllers...'
		return
	getCtrl window.schema
	return