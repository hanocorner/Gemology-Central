function report() {
  $.ajax({
    url: baseurl +'base/report-data',
    type: 'POST',
    dataType: 'json',
    data: {
      'reportno': $('#reportid').val()
    },
    success: function (data) {
      if(data == null) {
        $('#noData').html("No Records Found");
      }
      else {
        // ID according to Report Type
        if(typeof(data.gsrid) == "undefined") {
          $('#repno').html(data.memoid);
        }
        if(typeof(data.memoid) == "undefined") {
          $('#repno').html(data.gsrid);
        }

        $('#date').html(data.rep_date);
        $('#imgGem').attr('src', baseurl + 'assets/admin/images/gem/'+data.rep_imagename).attr('alt', data.rep_identification);
        $('#object').html(data.rep_object);
        $('#identification').html(data.rep_identification);
        $('#weight').html(data.rep_weight + " ct ");
        $('#cut').html(data.rep_cut);
        $('#color').html(data.rep_color);
        $('#dimension').html(data.rep_gemWidth + " x " + data.rep_gemHeight + " x " + data.rep_gemLength + " (mm) ");
        $('#shape').html(data.rep_shape);
        $('#comment').html(data.rep_comment);
      }
    },
    fail: function () {
      console.log("error");
    }
  });

}

function verify_report() {
  var alertbox = $('#alertMsg');

  $(document).on('click', '#submitRepo', function(event) {
    event.preventDefault();
    $.ajax({
      url: baseurl + 'authenticating-report',
      type: 'POST',
      dataType: 'JSON',
      data: {
        reportno: $('#repoNo').val(),
        repweight: $('#rWeight').val()
      },
      beforeSend: function () {
        $('#alertMsg').html('<div class="alert alert-primary" role="alert">Checking your input data...</div>');
      },
      success: function (response) {
        $('#alertMsg').html('<div class="alert alert-danger" role="alert">'+response+'</div>');
        //alert(response);

        if(response == 'success') {
          window.location.href = baseurl;
        }

      },
      fail: function () {
        console.log("error");
      }
    });

  });
}
