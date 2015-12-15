
(function () {
    define('manageTags5', ['lib_fancybox', 'lib_underscore', 'lib_chosen', 'lib_jqutils', 'alert'], function () {
        var catchDom, dom, events, functions, initialize, st, suscribeEvents;
        console.log("manageTags Binded.......");
        st = {
            table: '.table',
            rowTpl: '.row4Table',
            tag: '.tag-exercise',
            tagMore: '.more-exercise',
            tplTags: '#addTagsExercise',
            select: '.multiselect-custom',
            tagDelete: '.tag-exercise .icon-remove'
        };
        dom = {};
        catchDom = function () {
            dom.table = $(st.table);
            dom.rowTpl = _.template($(st.rowTpl).html());
            dom.tag = $(st.tag);
            dom.tagMore = $(st.tagMore);
            dom.tplTags = _.template($(st.tplTags).html());
            dom.select = $(st.select);
            dom.tagDelete = $(st.tagDelete);
        };
        catchDom();
        suscribeEvents = function () {
            $("body").on("click", st.tagMore, function () {
                var $this;
                $this = $(this);
                utils.loader($("body"), true);
                return functions.addExerciseModal($this);
            });
            $("body").on('click', st.tagDelete, events.deleteTag);
        };
        events = {
            generateModals: function () {
            },
            deleteTag: function () {
                var $this;
                $this = $(this);
                return functions.deleteTag($this);
            }
        };
        functions = {
            showInitialTable: function () {
                var html, url;
                html = "";
                url = dom.table.attr("data-url");
                return $.ajax({
                    url: url,
                    success: function (json) {
                        var i, indx, len, ref, val, valor;
                        ref = json.data;
                        for (indx = i = 0, len = ref.length; i < len; indx = ++i) {
                            val = ref[indx];
                            valor = dom.rowTpl(val);
                            html += valor;
                        }
                        return $("tbody").html(html);
                    }

                });
            },
            deleteTag: function (obj) {
                var idParent, idTag, url;
                url = $(this).attr("data-url");
                idTag = obj.parent().data("id");
                idParent = obj.parents("tr").find(".more-exercise").data("id");
                utils.loader($("body"), true);
                $.ajax({
                    url: "/admclient/delete-hotspots-groups",
                    method: "GET",
                    data: {
                        groups: idParent,
                        hotspots: idTag
                    },
                    success: function (json) {
                        utils.loader($("body"), false);
                        swal('Eliminado', 'Se elimino el equipo del grupo.', 'success');
                        return functions.showInitialTable();
                    },
                    error: function () {
                        utils.loader($("body"), false);
                        return echo("An error has occurred, try again");
                    }
                });
            },
            addExerciseModal: function (obj) {
                 var idParent;
                idParent = obj.parents("tr").find(".more-exercise").data("id");
                $.ajax({
                     url: "/admclient/equipment/equipments-free",
                     method: "GET",
                    data: {
                        groups_id: idParent
                    },
                    success: function (json) {
                        var data, excer, html, opt, ref, tpl, val;
                        html = "";
                        data = {};
                        excer = obj.data("exercises").split(",");
                        console.log(excer);
                        ref = json.data;
                        for (opt in ref) {
                            val = ref[opt];
                            if ($.inArray(opt, excer) === -1) {
                                html = html + "<option value='" + opt + "''>" + val + "</option>";
                            }
                        }
                        data.options = html;
                        data.idroutine = obj.data("id");
                        tpl = $(dom.tplTags(data));
                        return $.fancybox({
                            content: tpl,
                            padding: 0,
                            beforeShow: function () {
                                return utils.loader($("body"), false);
                            },
                            afterShow: function () {
                                console.log("todo cargo");
                                $(".ctn-addTags .multiselect-custom").chosen();
                                $(".ctn-addTags .btn-save").on("click", functions.saveTags);
                                return $(".ctn-addTags .btn-cancel").on("click", $.fancybox.close);
                            }
                        });
                    }
                });
            },
            saveTags: function () {
                var arr;
                $.fancybox.close();
                utils.loader($("body"), true);
                arr = "[" + $(".multiselect-custom").val().toString() + "]";
                return $.ajax({
                    url: "/admclient/user/insert-free-all",
                    method: "GET",
                    data: {
                        groups_id: $(".idrout").val(),
                        hotspots_id: arr
                    },
                    success: function (json) {
                        utils.loader($("body"), false);
//                        window.tables['categoryTable'].fnDraw();
//                        return echo("Data have been updated");
                        swal('Agregado', 'Se agrego el equipo al Grupo.', 'success');
                        return functions.showInitialTable();
                    },
                    error: function () {
                        utils.loader($("body"), false);
                        return echo("Ocurrio un error, intentelo nuevamente");
                    }
                });
            }
        };
        initialize = function () {
            catchDom();
            suscribeEvents();
        };
        return {
            init: initialize()
        };
        functions.showInitialTable();
    });


}).call(this);
