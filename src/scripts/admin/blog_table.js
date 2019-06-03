(function (window, $, document) {
    'use strict';
    //your global variables here...

    var formData;
    var postTable = $('#articleTable');
    var hulla = new hullabaloo();
    var arr = [];

    var gemApp = function ($) {
        function gemApp() {

            return {
                init: function () {
                    //Call your functions
                    bindEvents();
                    populate(1, 10);
                }
            }
        }

        // Event Binding 
        var bindEvents = function () {
            $(document).on('click', '#blogPagination', paginate);

            $('#reloadTable').on('click', reload);

            $('#rowCount').on('change', rowcount);

            $('#searchId').on('keyup', search);
        };

        // Populate Admin table
        var populate = function (pg, total_rows) {
            $.ajax({
                url: baseurl + 'admin/blog/handler/all/page/' + pg + '/',
                type: 'GET',
                dataType: 'html',
                data: {
                    page: pg,
                    rows: total_rows
                },
                success: function (data) {
                    postTable.html(data);
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
            populate(page, 10);
        };

        var reload = function (e) {
            e.preventDefault();
            //$('#rowCount').prop('selectedIndex', 0);
            //$("#searchId").val('');
            populate(1, 10);
        };

        var rowcount = function () {
            populate(1, this.value);
        }

        var search = function () {
           if(this.value.length > 1) {
                $.ajax({
                    url: baseurl + 'admin/blog/handler/all/',
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        search: true,
                        q: this.value
                    },
                    success: function (data) {
                        postTable.html(data);
                    },
                    fail: function (jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                    }
                });
           }
        };

        

        return gemApp;
    }(jQuery);

    //Call your app functions//

    var initApp = new gemApp();
    initApp.init();

})(window, jQuery, document);