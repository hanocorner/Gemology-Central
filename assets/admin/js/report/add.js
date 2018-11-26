$(function() {

  /* Varibales */
  var reptype = $('#radio-1, #radio-2, #radio-3');
  var amount = $("#amount");
  var form, formData = null;
  var messageBox = null;

  /* Functions */

  // Fetch ID Based on user select
  var getId = function(reportType) {
    $.ajax({
      url: baseurl + 'admin/report/handler/id',
      type: 'GET',
      dataType: 'html',
      data: {
        repotype: reportType
      },
      success: function(data) {
        $('#id').val(data);
      },
      fail: function() {
        console.log('Error');
      }
    });
  }

  // Function to populate customer on user input
  var populateCustomer = function() {
    $("#customer").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: baseurl + 'admin/customer/customer/append-customer',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function(data) {
          var results = $.map(data, function(value, key) {
            return {
              label: value.cus_firstname + ' ' + value.cus_lastname,
              value: value.cus_firstname + ' ' + value.cus_lastname,
              id: value.custid
            };
          });
          response(results);
        });
      },
      minLength: 1,
      select: function(event, ui) {
        $('#customerID').val(ui.item.id);
      }
    });
  };

  // Function to populate gemstone field on user input
  var populateGemstone = function() {
    $("#newGem").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: baseurl + 'admin/report/gemstone/gem-list',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function(data) {
          var results = $.map(data, function(value, key) {
            return {
              label: value.gem_name,
              value: value.gem_name,
              id: value.gemid
            };
          });
          response(results);
        });
      },
      minLength: 1,
      select: function(event, ui) {
        $('#gemid').val(ui.item.id);
        $('input[name=variety]').val(ui.item.value);
      }
    });
  };

  // Function to add decimal value(.00) to the amount field
  // (if there is no decimal value from user input)
  var addZero = function(num) {
    var value = Number(num);
    var res = num.split(".");
    if (res.length == 1 || (res[1].length < 3)) {
      value = value.toFixed(2);
    }
    return value
  };

  // Function to populate species/group field on user input
  var populateSpeciesGroup = function() {
    $("#sgField").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: baseurl + 'admin/report/handler/populate-spgroup',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function(data) {
          var results = $.map(data, function(value, key) {
            return {
              label: value.spgroup,
              value: value.spgroup
            };
          });
          response(results);
        });
      },
      minLength: 2
    });
  };

  // Function to populate shape-cut field on user input
  var populateShapeCut = function() {
    $("#shapecutField").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: baseurl + 'admin/report/handler/populate-shapecut',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function(data) {
          var results = $.map(data, function(value, key) {
            return {
              label: value.shapecut,
              value: value.shapecut
            };
          });
          response(results);
        });
      },
      minLength: 2
    });
  };

  // Function to populate color field on user input
  var populateColor = function() {
    $("#colorField").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: baseurl + 'admin/report/handler/populate-color',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function(data) {
          var results = $.map(data, function(value, key) {
            return {
              label: value.color,
              value: value.color
            };
          });
          response(results);
        });
      },
      minLength: 2
    });
  };

  var imageReader = function(input) {
    var file = input.files[0];
    // Message array
    var message = new Array();
    message['allowedTypes'] = "Not a valid image format, Please upload following file type jpg|jpeg|png|gif ";
    message['height'] = "Height is too large, Please upload an image less than 1024px";
    message['width'] = "Width is too large, Please upload an image less than 1024px";
    message['fileSize'] = "File size is too large, Please upload an image less than 2MB";

    // Regular Expression to validate image allowed types
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png|.gif)$");
    if (!regex.test(input.value.toLowerCase())) {
      alert(message['allowedTypes']);
      return false;
    }
    // File size MAX 2MB
    if (file.size > 2000000) {
      alert(message['fileSize']);
      return false;
    }
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = e.target.result;

        //Validate the File Height and Width.
        image.onload = function() {
          var height = this.height;
          var width = this.width;
          if (width > 1024) {
            alert(message['width']);
            return false;
          }
          else if (height > 1024) {
            alert(message['height']);
            return false;
          }
          $('#imagegem').attr('src', e.target.result);
          return true;
        };
      }
      reader.readAsDataURL(input.files[0]);
    }
    $('#removeImg').on('click', function() {
      $('#imagegem').attr('src', baseurl+'assets/images/default-img.png');
      $("#imginput").val('');
    });
  };

  // Function to Add a Report to DB
  var addReport = function(fm) {

    var form = $('#formReport');
    var formData = new FormData(fm);
    var cstid = $('#customerID').val();
    var gemid = $('#gemid').val();
    var commentData = CKEDITOR.instances.editor1.getData();

    formData.append("customer", cstid);
    formData.append("gemid", gemid);
    formData.append("editor1", commentData);

    $.ajax({
      url: form.attr("action"),
      type: form.attr("method"),
      dataType: 'JSON',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $('.addReport').html('<i class="fa fa-spinner fa-spin"></i><span class="sr-only">Loading...</span>Sending...');
      },
      success: function(response) {
        $('.addReport').html('<i class="fa fa-floppy-o" aria-hidden="true"></i>Submit Report');
        $('input[name=csrf_test_name]', '#formReport').val(response.csrf);

        if (response.auth) {
          $('#messageModal').modal({backdrop: 'static', keyboard: false });
          $('#messageModal .modal-body').html(
            '<div class="alert alert-success-alt"><i class="fa fa-check" aria-hidden="true"></i>'+response.message+'</div>'+
            '<div class="d-flex align-items-center">'+
            '<img src="'+baseurl+'assets/images/qr/temp.png" alt="QR-Code" width="200" height="200"> '+
            '<a href="'+response.url+'" class="btn btn-danger mx-3"><i class="fa fa-download" aria-hidden="true"></i>Download QR</a>'+
            '</div>'
          );

          $('#messageModal .modal-footer').html(
            '<a href="'+baseurl+'admin/report" >Go to myReport page</a>'+
            '<a href="#" id="anotherReport" class="btn btn-primary">Create Another</a>'
          );
          $('#messageModal .close').css('display', 'none');
          formData = null;
          $('#imagegem').attr('src', baseurl+'assets/images/default-img.png');
          form.trigger('reset');
          return true;
        } else {
          $('#messageModal').modal('show');
          $('#messageModal .modal-body').html(
            '<div class="alert alert-danger-alt">'+
            '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>'+
            'ERROR: Please check the error log on top of the form</div>'
          );
          $('#message').html(
            '<div class="alert alert-danger">'+
            '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Error Log<br/>'+
            '<ul>'+response.message + "</ul>" +
            '</div>'
          );
        }

      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('#messageModal').modal('show');
        $('#messageModal .modal-body').html(
          '<div class="alert alert-danger-alt">'+
          '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>'+
          'ERROR: '+errorThrown+'</div>'
        );
      }
    });

  };

  // Function to add new gemstone
  var addGemstone = function (fm) {
    messageBox = $('#gemModal #message');
    $.ajax({
      url: fm.attr('action'),
      type: fm.attr('method'),
      dataType: 'JSON',
      data: {
        gemName:$('#gemName').val(),
        gemDesc:$('#gemDesc').val(),
        csrf_test_name:$('#formGemstone  input[name=csrf_test_name]').val()
      },
      beforeSend: function() {
        messageBox.html('<div class="alert alert-info" role="alert">Sending...</div>');
      },
      success: function(response) {
        $('#formGemstone  input[name=csrf_test_name]').val(response.csrf);

        if (response.auth) {
          messageBox.html('<div class="alert alert-success-alt" role="alert"><i class="fa fa-check" aria-hidden="true"></i>'+response.message+'</div>');
          formData = null;
          fm.trigger('reset');
          setTimeout(function () {
            messageBox.html('');
          }, 5000);

          return true;
        }
        else {
          messageBox.html('<div class="alert alert-danger-alt" role="alert">'+response.message+'</div>');
        }
      },
      fail: function(errorResponse) {
        messageBox.html('<div class="alert alert-danger-alt" role="alert">'+errorResponse+'</div>');
        console.log(errorResponse);
      }
    });
  };



  /* Binding */

  // Create

  // Report Form submit event
  $('form').on("submit", function(event) {
    event.preventDefault();
    addReport(this);
  });

  reptype.click(function() {
    if (this.id == 'radio-1') {
      $('#repotype').val($(this).data('value'));
      getId($(this).data('value'));
    } else if (this.id == 'radio-2') {
      $('#repotype').val($(this).data('value'));
      getId($(this).data('value'));
    } else if (this.id == 'radio-3') {
      $('#repotype').val($(this).data('value'));
      getId($(this).data('value'));
    }
  });

  $('input[name=amount]').focusout(function() {
    $('input[name=amount]').val(addZero($('input[name=amount]').val()));
  });

  populateGemstone();

  populateCustomer();

  populateSpeciesGroup();

  populateShapeCut();

  populateColor();

  $("input[name=radio-1]").checkboxradio({
    icon: false
  });

  $("#imginput").change(function(){
    imageReader(this);
  });

  $('#messageModal').on('click', '#anotherReport', function(event) {
    event.preventDefault();
    location.reload();
  });

  $('#gemModal').on('click', '#saveGem', function() {
    addGemstone($('#formGemstone'));
  });

}); // End of document ready
