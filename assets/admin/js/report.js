// Fetch ID Based on user select
function ajax(reportType) {
  $.get(baseurl + 'admin/report/' + reportType, function(data) {
    $('#id').val(data);
  });
}

// Appending Gem to dropdown list
function gemstone() {
  $.ajax({
    url: baseurl + 'admin/gemstone/gem-list',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      $.each(data, function(key, value) {
        var toAppend = "";
        toAppend += '<option value="' + value.gemid + '">' + value.gem_name + '</option>';
        gemtype.append(toAppend);
      });
    },
    fail: function() {
      console.log("error");
    }
  });
}

//Adding a new Gemstone
function addGemstone() {
  $(document).on('click', '#saveGem', function(event) {
    event.preventDefault();
    $.ajax({
      url: baseurl + 'admin/gemstone/add',
      type: 'POST',
      data: {
        'gemName': $('#gemName').val(),
        'gemDesc': $('#gemDesc').val()
      },
      beforeSend: function() {
        $('#message').html('<div class="alert alert-info" role="alert">Sending...</div>');
      },
      success: function(response) {
        if (response == "success") {
          $('#gemForm').css('display', 'none');
          $('#message').html('<div class="alert alert-success" role="alert">Gemstone added successully</div>');
          location.reload();
        }
        if (response == "fail") {
          $('#message').html('<div class="alert alert-danger" role="alert">Problem when adding gemstone</div>');
        }
      },
      fail: function() {
        console.log("error");
      }
    });
  });
  $(document).on('click', '#closeGem', function() {
    $('#message').html(null);
    $('#gemForm').css('display', 'block');
  });

}

function append_toedit() {
  $.ajax({
    url: baseurl +'admin/report/append-data-toedit',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      $('#rmid').val(data.memoid);
      $('#amount').val(data.mem_amount);
    },
    fail: function () {
      console.log("error");
    }
  });

}
