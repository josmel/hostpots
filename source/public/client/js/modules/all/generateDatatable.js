(function() {
  define('generateDatatable', ['lib_jqutils', 'datatables', 'lib_underscore', 'lib_fancybox', 'lib_parsleyJs'], function() {
    var catchDom, dom, dtable, events, functions, initialize, st, suscribeEvents;
    console.log("generateDatatables...");
    st = {
      tables: '.tables',
      btneliminar: '.btn-eliminar',
      btnEdit: '.js-edit',
      btnDelete: '.js-delete',
      tplEdit: "#tplEdit",
      tplDelete: "#tplDelete",
      btnVideo: ".exercise-video"
    };
    dom = {};
    dtable = "";
    catchDom = function() {
      dom.tables = $(st.tables);
      dom.btneliminar = $(st.btneliminar);
    };
    suscribeEvents = function() {
      $('body').on('click', '.action_del', events.search);
      dom.btneliminar.on('click', events.btneliminar);
      $('body').on('click', st.btnVideo, events.btnShowVideo);
    };
    events = {
      btnShowVideo: function() {
        var $this;
        $this = $(this);
        return functions.showVideo($this);
      },
      btnEdit: function(e) {
        var $this, id;
        $this = $(this);
        id = $this.data("id");
        return functions.showEdit(id);
      },
      btnDelete: function(e) {
        var $this, data, id;
        $this = $(this);
        id = $this.data("id");
        data = {};
        data.id = id;
        console.log($this.data("other"));
        data.msg = "Delete this record?";
        if ($this.data("other") === 1) {
          data.msg = "This record is related to a routine. Delete this registry anyway?";
        }
        return functions.showDelete(data);
      },
      search: function(e) {
        var url;
        e.preventDefault();
        url = $(this).attr("data-url");
        dom.btneliminar.attr("data-url", url);
      },
      btneliminar: function(e) {
        var url;
        e.preventDefault();
        url = $(this).attr("data-url");
        return functions["delete"](url);
      }
    };
    functions = {
      showVideo: function(obj) {
        var txtVideo, urlVideo;
        urlVideo = obj.data("url");
        txtVideo = "<video controls width=640 height=360><source src='" + urlVideo + "' type='video/mp4'><p>Your browser does not support H.264/MP4.</p></video>";
        return $.fancybox({
          content: txtVideo
        });
      },
      showEdit: function(id) {
        var data, urlEdit;
        data = {};
        urlEdit = $("#tplEdit").data("initial");
        return $.ajax({
          url: urlEdit,
          data: {
            id: id
          },
          method: "GET",
          success: function(json) {
            console.log(json.data);
            data = json.data;
            return $.fancybox({
              content: dom.tplEdit(data),
              padding: 0,
              afterShow: function() {
                $("#editForm").parsley();
                functions.sendForms($("#editForm"));
                return $.material.init();
              }
            });
          }
        });
      },
      showDelete: function(data) {
        return $.fancybox({
          content: dom.tplDelete(data),
          padding: 0,
          afterShow: function() {
            $("#deleteForm").parsley();
            functions.sendForms($("#deleteForm"));
            $.material.init();
            return $(".modal-ctn .btn-danger").on("click", function() {
              return $.fancybox.close();
            });
          }
        });
      },
      sendForms: function(obj) {
        return obj.on("submit", function(e) {
          var $this, data;
          e.preventDefault();
          $this = $(this);
          data = $this.serialize();
          utils.loader($("body"), true);
          return $.ajax({
            url: $this.data("url"),
            data: data,
            method: $this.data("method"),
            success: function(json) {
              window.tables[obj.parents('body').find('table').attr('id')].fnDraw();
              $.fancybox.close();
              utils.loader($("body"), false);
              return echo("Data have been updated");
            },
            error: function() {
              return echo("An error has occurred, try again");
            }
          });
        });
      },
      makeTables: function() {
        return functions.initData(dom.tables);
      },
      "delete": function(url) {
        return $.get(url).done(function(data) {
          dtable.fnDraw();
          $('.md_confirmacion').modal('hide');
        });
      },
      initData: function(idtable) {
        var ft, i, id, obj, url;
        url = idtable.attr('data-url');
        ft = idtable.attr('data-nofilter');
        obj = [];
        i = 0;
        console.log("new");
        id = idtable.attr("id");
        window.tables = [];
        window.tables[id] = idtable.dataTable({
          processing: true,
          serverSide: true,
          ordering: false,
          bLengthChange: false,
          ajax: {
            url: url
          },
          columns: obj,
          columnDefs: [
            {
              'searchable': false,
              'targets': ft
            }
          ],
          fnDrawCallback: function() {
            return $.material.init();
          }
        });
        dtable = window.tables[id];
      }
    };
    initialize = function() {
      catchDom();
      suscribeEvents();
      functions.makeTables();
    };
    return {
      init: initialize()
    };
  });

}).call(this);
