(function (window, $, document) {
    'use strict';
    //your global variables here...

    var formData;
    var addPost = $('#addPost');
    var editPost = $('#editPost');
    var saveDraft = $('#saveDraft');
    var savePublish = $('#savePublish');
    var updateDraft = $('#updateDraft');
    var updatePublish = $('#updatePublish');
    var hulla = new hullabaloo();
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

    var gemApp = function ($) {
        function gemApp() {

            return {
                init: function () {
                    //Call your functions
                    bindEvents();
                }
            }
        }

        // Event Binding 
        var bindEvents = function () {

            saveDraft.on("click", add);

            savePublish.on("click", add);

            updateDraft.on("click", update);

            updatePublish.on("click", update);

            // Image upload
            var token = JSON.parse('{"csrf_test_name": "' + $('input[name=csrf_test_name]').val() + '" } ');
            $(".target").upload({
                    action: baseurl + "admin/blog/image/index",
                    dataType: 'JSON',
                    maxConcurrent: 0,
                    maxSize: 2097152,
                    multiple: false,
                    postData: token
                }).on("filecomplete.upload", onFileComplete)
                .on("fileerror.upload", onFileError)
                .on("start.upload", onFileStart);
        };

        // Message function
        var responseMessage = function (message, status) {
            return '<div class="alert alert-' + status + '"><i class="fa fa-times-circle fa-fw fa-lg"></i>' + message + '</div>';
        }

        // Function Add Post
        var add = function (event) {
            event.preventDefault();
            formData = new FormData(document.getElementById('addPost'));
            formData.append("body", quill.root.innerHTML);
            formData.append("status", $(this).data("status"));

            ajaxCall(formData, addPost.attr("action")).done(function (response) {
                    if (response.auth) {
                        hulla.send(response.message, 'success');
                        location.href = baseurl + 'admin/blog/';
                        formData = null;
                    } else {
                        hulla.send(response.message, 'danger');
                    }
                })
                .fail(function (xhr, statusText, error) {
                    console.log(error);
                });
        };

        // Function Update Post
        var update = function (event) {
            event.preventDefault();
            formData = new FormData(document.getElementById('editPost'));
            formData.append("body", quill.root.innerHTML);
            formData.append("status", $(this).data("status"));

            ajaxCall(formData, editPost.attr("action")).done(function (response) {
                    if (response.auth) {
                        hulla.send(response.message, 'success');
                        location.href = baseurl + 'admin/blog';
                        formData = null;
                    } else {
                        hulla.send(response.message, 'danger');
                    }
                })
                .fail(function (xhr, statusText, error) {
                    hulla.send(error, 'danger');
                });
        };


        function onFileComplete(e, file, response) {
            if (response.status) {
                var image = baseurl + 'images/blog/' + response.image_path + response.image_name;
                $('#postImage').attr('src', image);
                $('#imgPath').val(response.image_path);
                $('#imgName').val(response.image_name);
            } else {
                hulla.send(response.message, 'danger');
            }

        }

        function onFileError(e, file, error) {
            hulla.send(error, 'danger');
        }

        function onFileStart(e, file) {
            console.log("File Start");
        }

        //Ajaxcall function
        var ajaxCall = function (data, dataUrl) {

            return $.ajax({
                url: dataUrl,
                type: 'POST',
                dataType: 'JSON',
                data: data,
                processData: false,
                contentType: false
            });
        };


        return gemApp;
    }(jQuery);

    //Call your app functions//

    var initApp = new gemApp();
    initApp.init();

})(window, jQuery, document);