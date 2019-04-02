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
                    formLogin.on("submit", function (event) {
                        event.preventDefault();
                        login();
                    });

                }
            }
        }

        // Function login
        function login() {
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
        }

        //Ajaxcall function
        var ajaxCall = function(fm, dataUrl) {
            
            return $.ajax({
                url: dataUrl,
                type: 'POST',
                dataType: 'JSON',
                data: fm,
                processData: false,
			    contentType: false
            });
        }


        return gemApp;
    }(jQuery);

    //Call your app functions//

    var initApp = new gemApp();
    initApp.init();

})(window, jQuery, document);