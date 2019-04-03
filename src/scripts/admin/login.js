(function (window, $, document) {
    'use strict';
    //your global variables here...

    var formData;
    var formLogin = $('#formLogin');
    //var hulla = new hullabaloo();

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
            formLogin.on("sumbit", login);
        };

        // Message function
        var responseMessage = function (message, status) {
            return '<div class="alert alert-'+status+'"><i class="fa fa-times-circle fa-fw fa-lg"></i>'+message+'</div>';
        }

        // Function login
        var login = function(event) {
            event.preventDefault();
            formData = new FormData(document.getElementById('formLogin'));
            ajaxCall(formData, formLogin.attr("action")).done(function (response) {
                if (response.auth) {
					alert(response.message);
					location.href = response.url;
				} else {
                    alert(response.message);
					//messageBox.html(message(response.message, 'error'));
				}
            })
            .fail(function (xhr, statusText, error){
                console.log(error);
            });
        };

        //Ajaxcall function
        var ajaxCall = function(data, dataUrl) {
            
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