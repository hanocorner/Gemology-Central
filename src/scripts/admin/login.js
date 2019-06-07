(function (window, $, document) {
    'use strict';
    //your global variables here...

    var formData;
    var formLogin = $('#formLogin');
    var btnLogin = $('#logMeIN');
    var alert = $('#alertBox');

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
            btnLogin.on("click", login);
        };

        // Message function
        var responseMessage = function (message, status) {
            if(status == false) {
                return alert.html('<div class="alert alert-danger"><i class="fa fa-times-circle fa-fw fa-lg"></i> '+message+'</div>');
            }
            else {
                return alert.html('<div class="alert alert-success"><i class="fa fa-times-circle fa-fw fa-lg"></i> '+message+'</div>');
            }
            
        }

        // Function login
        var login = function(event) {
            event.preventDefault();
            formData = new FormData(document.getElementById('formLogin'));
            ajaxCall(formData, formLogin.attr("action")).done(function (response) {
                if (response.auth) {
					responseMessage(response.message, response.auth);
					location.href = response.url;
				} else {
					responseMessage(response.message, response.auth);
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