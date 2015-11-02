require.config
  baseUrl: '../../static/js/'
  paths:
    'lib_underscore': 'libs/underscore/underscore'
    'lib_parsleyJs': 'libs/parsleyjs/dist/parsley'
    'lib-ext_parsleyEsp': 'libs/parsleyjs/src/i18n/es'
    'lib_jquery': 'libs/jquery/dist/jquery'
    'lib_jquery-ui': 'libs/jquery-ui/jquery-ui'
    'datatables': 'libs/DataTables/media/js/jquery.dataTables'
    'lib_fancybox': 'libs/fancybox/source/jquery.fancybox'
    'lib_uploadJs': 'libs/bootstrap-fileinput/js/fileinput'
    'lib-ext_spanishUpload': 'libs/bootstrap-fileinput/js/fileinput_locale_es'
    'lib_materialDesign': 'libs/bootstrap-material-design/scripts/material'
    'lib-ext_materialAnimations': 'libs/bootstrap-material-design/scripts/ripples'
    'lib_chosen': 'libs/chosen/chosen.jquery.min'
    'lib_jqutils': 'libs/jqutils/jq-utils'
    'index': 'modules/index/index'
    'parsleyValidator': 'modules/all/parsleyValidator'
    'generateDatatable': 'modules/all/generateDatatable'
    'generateUploads': 'modules/all/generateUploads'
    'generateModals': 'modules/all/generateModals'
    'materialTransform': 'modules/all/materialTransform'
    'bindJqueryUI': 'modules/all/bindJqueryUI'
    'modalsDatatable': 'modules/exercises/modalsDatatable'
    'manageTags': 'modules/all/manageTags'
define('jquery', [], () ->
  return jQuery
)
define [], ->
  window.schema =
    controllers:
      'index':
        actions:
          index: ->
            require(['index'])
        allActions: ->
      'Home':
        actions:
          routineList: ->
            require(['generateDatatable','manageTags'])
          routine: ->
            require(['generateUploads'])
      'Exercise':
        actions:
          exerciseList: ->
            require(['generateDatatable','modalsDatatable'])
          exercise: ->
            require(['generateUploads'])
      'User':
        actions:
          userList: ->
            require(['generateDatatable'])
          exercise: ->
            require(['generateUploads'])
          user: ->
            require(['generateUploads'])
      'Greeting':
        actions:
          greetingList: ->
            require(['generateDatatable'])
          greeting: ->
            require(['generateUploads'])
      'Customer':
        actions:
          getIndex: ->
            require(['generateDatatable'])
      'Delivery':
        actions:
          getIndex: ->
            require(['generateDatatable', 'bindJqueryUI'])
      'Driver':
        actions:
          getIndex: ->
            require(['generateDatatable'])
      'Remenber':
        actions:
          form: ->
            require(['materialTransform', 'parsleyValidator'])
      'upload':
        actions:
          index: ->
            require(['generateUploads', 'generateModals', 'bindJqueryUI'])
        allActions: ->
    allControllers: ->
      require(['materialTransform', 'parsleyValidator'])
      console.log 'run allControllers...'
      return
  ## Warning, processing data. Hadouken alert! Don't touch this (8)
  getCtrl = (schema) ->
    for parents of schema
      parents = parents
      if parents == 'controllers'
        for controller of schema[parents]
          if controller == alpha.controller
            for actions of schema[parents][controller]
              for action of schema[parents][controller][actions]
                if action == alpha.action
                  schema[parents][controller][actions][action]()
      if parents == 'allControllers'
        schema[parents]()
    return
  getCtrl window.schema
  return