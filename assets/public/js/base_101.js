(function (window, $, document) {
  'use strict';

  var formData;
  var formVerify = $('#verifyReport');
  var scrolltop = $("#return-to-top");
  var messageDiv = $('#alertMsg');

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
      $('#verifyReportBtn').on('click', verifyReport);
      //scrollToTop();
    };

    // Message function
    var responseMessage = function (message, status) {
      if(status) {
        return '<div class="alert alert-success"><div class="d-flex align-items-center mb-3"><strong><i class="fa fa-check-circle-o fa-fw fa-lg"></i> Successful</strong></div>' + message + '</div>';
      }
      else {
        return '<div class="alert alert-danger"><div class="d-flex align-items-center mb-3"><strong><i class="fa fa-times-circle fa-fw fa-lg"></i> Error(s) Encountered</strong></div>' + message + '</div>';
      }
      
    }

    // Function verify report
    var verifyReport = function (e) {
      e.preventDefault();

      formData = new FormData(document.getElementById('verifyReport'));

      ajaxCall(formData, formVerify.attr("action"))
        .done(function (response) {
          if (response.status) {
            messageDiv.html(responseMessage(response.message, response.status));
            location.href = response.url;
          } else {
            messageDiv.html(responseMessage(response.message, response.status));
            return false;
          }
        })
        .fail(function (xhr, statusText, error) {
          console.log(error);
        });
    };

    //
    var scrollToTop = function () {
      $(window).scroll(function() {
        if ($(this).scrollTop() >= 600) {
          scrolltop.fadeIn(200); // Fade in the arrow
        } else {
          scrolltop.fadeOut(200); // Else fade out the arrow
        }
      });
      scrolltop.click(function() {
        // When arrow is clicked
        $("body,html").animate(
          {
            scrollTop: 0 // Scroll to top of body
          },
          500
        );
      });
    };

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

  var initApp = new gemApp();
  initApp.init();

})(window, jQuery, document);