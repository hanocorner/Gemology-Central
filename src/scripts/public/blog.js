(function (window, $, document) {
    'use strict';
    //your global variables here...

    var formData;
    var divPost = $('#blogAllPosts');
    var inputs;
    var addComment = $('#addComment');
    //var hulla = new hullabaloo();

    var gemApp = function ($) {
        function gemApp() {

            return {
                init: function () {
                    //Call your functions
                    bindEvents();
                    populatePosts(1, 4);
                }
            }
        }

        // Event Binding 
        var bindEvents = function () {
            $(document).on('click', '#blogPagination', paginate);
        };

        // Message function
        var responseMessage = function (message, status) {
            return '<div class="alert alert-' + status + '"><i class="fa fa-times-circle fa-fw fa-lg"></i>' + message + '</div>';
        }

        // Total
        var populatePosts = function (pg, total_rows) {
            $.ajax({
                url: baseurl + 'blog/articles/all/page/' + pg + '/',
                type: 'GET',
                dataType: 'html',
                data: {
                    page: pg,
                    rows: total_rows
                },
                success: function (data) {
                    divPost.html(data);
                },
                fail: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            });
        };

        //
        var paginate = function (e) {
            e.preventDefault();
            var page = $(this).data("ci-pagination-page");
            populatePosts(page, 4);
        }


        //Ajaxcall function
        var ajaxCall = function (data, dataUrl) {

            return $.ajax({
                url: dataUrl,
                type: 'GET',
                dataType: 'html',
                data: data
            });
        };


        return gemApp;
    }(jQuery);

    //Call your app functions//

    var initApp = new gemApp();
    initApp.init();

})(window, jQuery, document);