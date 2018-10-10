// Fetch ID Based on user select
function ajax(reportType) {
  $.ajax({
    url: baseurl + 'admin/idmaker/id',
    type: 'GET',
    dataType: 'html',
    data: {
      type: reportType
    },
    success:function(data) {
      $('#id').val(data);
    },
    fail:function(){
      console.log('Error');
    }
  });

}

// Appending Gem to dropdown list
function gemstone() {
  $.ajax({
    url: baseurl + 'admin/report/gemstone/gem-list',
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
      url: baseurl + 'admin/report/gemstone/add',
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
    url: baseurl +'admin/report/edit/append-toedit',
    type: 'GET',
    dataType: 'json',
    data: {
      labrepid: $('#labRepid').val()
    },
    success: function (data) {
      // ID according to Report Type
      if(typeof(data.gsrid) == "undefined") {
        $('#rmid').val(data.memoid);
      }
      if(typeof(data.memoid) == "undefined") {
        $('#rmid').val(data.gsrid);
      }

      // Amount value according to Report Type
      if (typeof(data.mem_amount) == "undefined" ) {
        $('#amount').val(data.gsr_amount);
      }
      if (typeof(data.gsr_amount) == "undefined" ) {
        $('#amount').val(data.mem_amount);
      }

      // Payment Status according to Report Type
      if (typeof(data.gsr_paymentStatus) == "undefined" ) {
        $('#pstatus').val(data.mem_paymentStatus);
      }
      if (typeof(data.mem_paymentStatus) == "undefined" ) {
        $('#pstatus').val(data.gsr_paymentStatus);
      }

      $('#reportType').val(data.rep_type);
      $('#newGem').val(data.rep_gemID);
      $('#imgGem').attr('src', baseurl + data.img_path+'/'+data.img_gemstone);
      $('#object').val(data.rep_object);
      $('#variety').val(data.rep_variety);
      $('#weight').val(data.rep_weight);
      $('#spgroup').val(data.rep_spgroup);
      $('#color').val(data.rep_color);
      $('#width').val(data.rep_gemWidth);
      $('#height').val(data.rep_gemHeight);
      $('#length').val(data.rep_gemLength);
      $('#shapecut').val(data.rep_shapecut);
      $('#comment').val(data.rep_comment);
      $('#labRepid').val(data.reportid);
      $('#other').val(data.rep_other);
    },
    fail: function () {
      console.log("error");
    }
  });

}
