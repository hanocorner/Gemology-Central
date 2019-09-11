$(function() {

  /* Varibales */
  var reptype = $('#option1, #option2, #option3');
  var spinner = '<i class="fa fa-spinner fa-pulse fa-lg fa-fw d-block mx-auto text-white"></i><span class="sr-only">Loading...</span>';
  var messageBox = null;
  var url;
  var hulla = new hullabaloo();
  var webComment = $('#webComment');
  var comment = $('#comment');

  /* Functions */

  //
  var message = function (msg, type) {
		var box;
		switch (type) {
			case 'error':
				return '<div class="notify-box">' +
					'<noscript>Sorry, your browser does not support JavaScript!</noscript>' +
					'<div class="error d-flex align-items-center">' +
					'<img src="' + baseurl + 'assets/images/error.png" alt="Error-Image" class="img-fluid">' +
					'<div>' + msg + '<div>' +
					'</div>' +
					'</div>';
			case 'success':
				return '<div class="notify-box">' +
					'<noscript>Sorry, your browser does not support JavaScript!</noscript>' +
					'<div class="success d-flex align-items-center">' +
					'<img src="' + baseurl + 'assets/images/success.png" alt="Success-Image" class="img-fluid">' +
					'<p>' + msg + '</p>' +
					'</div>' +
					'</div>';
			case 'info':
				return '<div class="notify-box">' +
					'<noscript>Sorry, your browser does not support JavaScript!</noscript>' +
					'<div class="info d-flex align-items-center">' +
					'<img src="' + baseurl + 'assets/images/info.png" alt="Success-Image" class="img-fluid">' +
					'<p>' + msg + '</p>' +
					'</div>' +
					'</div>';
			default:
				return 'Unable to display Message';
		}
  }
  
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
        $('#repid').val(data);
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
          url: baseurl + 'admin/customers/customer/append-customer',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function(data) {
          var results = $.map(data, function(value, key) {
            return {
              label: value.firstname + ' ' + value.lastname,
              value: value.firstname + ' ' + value.lastname,
              id: value.custid
            };
          });
          response(results);
        });
      },
      minLength: 1,
      select: function(event, ui) {
        $('#customerid').val(ui.item.id);
      }
    });
  };

  // Function to populate gemstone field on user input
  var populateGemstone = function() {
    $("#newGem").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: baseurl + 'admin/report/gemstone/populate',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function(data) {
          var results = $.map(data, function(value, key) {
            return {
              label: value.name,
              value: value.name,
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

  // Function to Add a Report
  var addReport = function() {

    var formAdd = $('#formAddReport');
    var formData = new FormData();

    var x = formAdd.serializeArray();
    $.each(x, function (i, field) {
      formData.append(field.name, field.value);
    });

    var commentData = CKEDITOR.instances.editor1.getData();
    formData.append("comment", commentData);

    var webCommentData = $('textarea#webcomment').val();

    if(webCommentData === '') {
      formData.append("webcomment", '');
    }
    else {
      formData.append("webcomment", webCommentData);
    }
    

    $.ajax({
      url: formAdd.attr("action"),
      type: formAdd.attr("method"),
      dataType: 'JSON',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $('.add-report').html(spinner);
      },
      success: function(response) {
        $('.add-report').html('Add Report');

        if (response.auth) {
          $('#successModal').modal({backdrop: 'static', keyboard: false });
          $('#qrCodeBtn').attr('href', response.url);
          formData = null;
          formAdd.trigger('reset');
          return true;

        } else {
          hulla.send(response.message, 'danger');
        }

      },
      error: function (jqXHR, textStatus, errorThrown) {
        hulla.send(errorThrown, 'danger');
      }
    });

  };

  // Function to update specific report
  var updateReport = function (uri) {

    var formUpdate = $('#updateReportForm');
    var formData = new FormData();

    var x = formUpdate.serializeArray();
    $.each(x, function (i, field) {
      formData.append(field.name, field.value);
    });

    var commentData = CKEDITOR.instances.editor1.getData();
    formData.append("comment", commentData);

    var webCommentData = $('textarea#webcomment').val();

    if(webCommentData === '') {
      formData.append("webcomment", '');
    }
    else {
      formData.append("webcomment", webCommentData);
    }

    $.ajax({
      url: formUpdate.attr("action"),
      type: formUpdate.attr("method"),
      dataType: 'JSON',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $('#updateReport').html(spinner);
      },
      success: function(response) {
        $('#updateReport').html("Update Report");
        if (response.auth) {
          hulla.send(response.message, 'success');
          formData = null;
          location.href = baseurl + uri;
          return true;

        } else {
          hulla.send(response.message, 'danger');
        }

      },
      error: function (jqXHR, textStatus, errorThrown) {
        hulla.send(errorThrown, 'danger');
      }
    });
  };

  // Function to add new gemstone
  var addGemstone = function () {
    
    var formVariety = $('#formVariety');
    var formData = new FormData();

    var x = formVariety.serializeArray();
    $.each(x, function (i, field) {
      formData.append(field.name, field.value);
    });

    $.ajax({
      url: formVariety.attr('action'),
      type: formVariety.attr('method'),
      dataType: 'JSON',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {
        $('#saveGem').html(spinner);
      },
      success: function(response) {
        $('#saveGem').html('Save Vareity');

        if (response.auth) {
          hulla.send(response.message, 'success');
          formData = null;
          formVariety.trigger('reset');
          $('#gemModal').modal('hide');
          return true;
        }
        else {
          hulla.send(response.message, 'danger');
        }
      },
      fail: function(errorResponse) {
        hulla.send(errorResponse, 'success');
      }
    });
  };


  /* Binding */
  
  // Image upload
  var token = JSON.parse('{"csrf_test_name": "'+$('input[name=csrf_test_name]').val()+'" } ') ;
  $(".target").upload({
    action: baseurl + "admin/report/image/index",
    dataType: 'JSON',
    maxConcurrent: 0,
    maxSize: 2097152,
    multiple: false,
    postData: token
  }).on("filecomplete.upload", onFileComplete)
    .on("fileerror.upload", onFileError)
    .on("start.upload", onFileStart);

  function onFileComplete(e, file, response) {
    if(response.status) {
      var image = baseurl + 'images/gem/' +response.image_path + response.image_name;
      $('#imagegem').attr('src', image);
      $('#imgPath').val(response.image_path);
      $('#imgName').val(response.image_name);
    }
    else {
      hulla.send(response.message, 'danger');
    }
    
  }

  function onFileError(e, file, error) {
    hulla.send(error, 'danger');
  }

  function onFileStart(e, file) {
    console.log("File Start");
  }

  populateGemstone();

  populateCustomer();

  populateSpeciesGroup();

  populateShapeCut();

  populateColor();

  // Report type selection
  reptype.click(function () {
    if (this.id == 'option1') {
      $('#repotype').val($(this).data('value'));
      webComment.show();
      comment.text('Print Comment');
      getId($(this).data('value'));
    } else if (this.id == 'option2') {
      $('#repotype').val($(this).data('value'));
      getId($(this).data('value'));
      webComment.hide();
      comment.text('Comment');
    } else if (this.id == 'option3') {
      $('#repotype').val($(this).data('value'));
      getId($(this).data('value'));
      webComment.hide();
      comment.text('Comment');
    }
  });

  $("input[name=radio-1]").checkboxradio({
    icon: false
  });

  var btnActions = {
    updateRep: function (e) {
      e.preventDefault();
      url = 'admin/report/published';
      updateReport(url);
    },
    updatePrint: function (e) {
      e.preventDefault();
      url = 'admin/report/print/card/'+$(this).data('type')+'/'+$(this).data('id');
      updateReport(url);
    },
    updateDownload: function (e) {
      e.preventDefault();
      url = 'admin/report/print/image/'+$(this).data('type')+'/'+$(this).data('id');
      location.href = baseurl + url;
      //updateReport(url);
    },
    addReport: function (e) {
      e.preventDefault();
      addReport(this);
    },
    saveGemstone: function (e) {
      addGemstone();
    }

  };

  $(document).on("click", 'a[data-action]', function (event) {
    var link = $(this);
    var action = link.data("action");

    if (typeof btnActions[action] === "function") {
      btnActions[action].call(this, event);
    }
  });

}); // End of document ready
