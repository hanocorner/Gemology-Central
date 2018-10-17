function report() {
  var message = $('#messageBox');
  $.ajax({
    url: baseurl +'public/report/data',
    type: 'POST',
    dataType: 'json',
    data: {
      'csrf_test_name':csrfhash,
      'reportno': $('#reportid').val()
    },
    success: function (data) {
      if(data == null) {
        message.html('<div class="alert alert-danger" role="alert"><strong><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp; Report not found</strong></div>');
        $('#table').hide();
      }
      else {
        message.html('<div class="alert alert-success" role="alert"><strong><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;&nbsp; Your report is verfied</strong></div>');
        // ID according to Report Type
        if(typeof(data.gsrid) == "undefined") {
          $('#repno').html(data.memoid);
        }
        if(typeof(data.memoid) == "undefined") {
          $('#repno').html(data.gsrid);
        }

        $('#date').html(data.img_created_date);
        $('#imgGem').attr('src', baseurl + data.img_path +'/'+ data.img_gemstone).attr('alt', 'Image not available');
        $('#object').html(data.rep_object);
        $('#variety').html(data.rep_variety);
        $('#spgroup').html(data.rep_spgroup);
        $('#weight').html(data.rep_weight + " ct ");
        $('#shapecut').html(data.rep_shapecut);
        $('#color').html(data.rep_color);
        $('#dimension').html(data.rep_gemWidth + " x " + data.rep_gemHeight + " x " + data.rep_gemLength + " (mm) ");
        $('#comment').html(data.rep_comment);
      }
    },
    fail: function () {
      console.log("error");
    }
  });

}

function reportAuthentication() {
  var alertbox = $('#alertMsg');

  var error = '<div class="alert alert-danger" role="alert">'+
              '<strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp; Found Error(s) </strong>'+
              '</div>';

  var success = '<div class="alert alert-success" role="alert">'+
                '<strong><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp; Authentication successful, Redirecting...</strong>'+
                '</div>';

  var info = '<div class="alert alert-primary" role="alert">'+
              '<strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; Authenticating your report...</strong>'+
              '</div>';


  $(document).on('click', '#submitRepo', function(event) {
    event.preventDefault();
    $.ajax({
      url: baseurl + 'public/report/form-authentication',
      type: 'POST',
      dataType: 'JSON',
      data: {
        'csrf_test_name':$('#csrfToken').val(),
        'reportno': $('#repoNo').val(),
        'repweight': $('#rWeight').val(),
        'captcha': $('#captcha').val()
      },
      beforeSend: function () {
        alertbox.html(info);
      },
      success: function (response) {
        if(!response.valid) {
          alertbox.html(error);
          $(response.message).insertAfter('strong');
        }
        if (response.valid) {
          alertbox.html(success);
          setTimeout(function(){ window.location.href = baseurl + response.url; }, 2000);
        }
        create_csrf();
      },
      fail: function () {
        console.log("error");
      }
    });

  });
}

function create_csrf() {
  $.getJSON(baseurl + 'public/report/set-csrf', function(data) {
    $("#csrfToken").attr('name', data.name).attr('value', data.hash);
  });
}
