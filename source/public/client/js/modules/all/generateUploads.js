(function () {
    define('generateUploads', ['lib_uploadJs', 'lib-ext_spanishUpload','datepicker'], function () {
        var catchDom, dom, events, functions, initialize, st, suscribeEvents;
        console.log("generateUploads.......");
        st = {
            input: '.js-uploadInput',
            input1: '#uploadImgOne',
            input2: '#uploadImgTwo'
        };
        dom = {};
        catchDom = function () {
            dom.input = $(st.input);
            dom.input1 = $(st.input1);
            dom.input2 = $(st.input2);
        };
        suscribeEvents = function () {

            var image, image2, video, videoFemale;
            image = '';
            video = '';
            videoFemale = '';
            if ($('#image-rountine').val() !== '') {
                image = "<img src='" + $('#image-rountine').val() + "' class='file-preview-image' alt='Desert1' title='Desert'>";
            }
            if ($('#image-rountine-big').val() !== '') {
                image2 = "<img src='" + $('#image-rountine-big').val() + "' class='file-preview-image' alt='Desert2' title='Desert'>";
            }
            dom.input1.fileinput({
                allowedFileExtensions: ["jpg", "png"],
                uploadAsync: true,
                maxFileCount: 5,
                initialPreview: image,
                uploadUrl: dom.input1.data("url")
            });
            dom.input2.fileinput({
                allowedFileExtensions: ["jpg", "png"],
                uploadAsync: true,
                maxFileCount: 5,
                initialPreview: image2,
                uploadUrl: dom.input2.data("url")
            });

            dom.input1.on('fileclear', function(event, key) {
                dom.input1.fileinput('refresh')
            });

            dom.input.on("fileuploaded", function (e, data, previewId, index) {
                console.log(data);
                console.log(e);
                console.log(previewId);
                return console.log(index);
            });


            $('#date1').bootstrapMaterialDatePicker({weekStart: 0, time: false});
            $('#date2').bootstrapMaterialDatePicker({weekStart: 0, time: false});

        };

        events = {
            recargarTable: function () {
                console.log('Redraw occurred at: ' + (new Date).getTime());
            }
        };
        functions = {
            datatable: function () {
            }
        };
        initialize = function () {
            catchDom();
            suscribeEvents();
        };
        return {
            init: initialize()
        };
    });

}).call(this);
