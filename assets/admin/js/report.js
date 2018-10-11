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
  var id = $('#labRepid').val();

  $.ajax({
    url: baseurl +'admin/report/edit/populate/'+id,
    type: 'GET',
    dataType: 'json',
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
      // Customer Data
      $('#custName').html(data.cus_firstname + ' ' + data.cus_lastname);
      $('#custId').val(data.custid);

      // Lab data
      if (data.rep_type == "memo" ) {
        $('#reportType').val('Memocard');
      }
      if (data.rep_type == "repo" ) {
        $('#reportType').val('Certificate');
      }
      if (data.rep_type == "verb" ) {
        $('#reportType').val('Verbal');
      }

      $('#reptype').val(data.rep_type);
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

function update() {
  var formData = new FormData(this);
  var alertbox = $('#alertMsg');

  $("form").on('submit', function(event) {
    event.preventDefault();

    $.ajax({
      url: baseurl + 'admin/report/edit/update-todb',
      type: 'POST',
      dataType: 'json',
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success:function (response){
        if(response.isvalid){
          window.location.href = baseurl +'admin/report';
        }
        if (!response.isvalid) {
          alertbox.html('<div class="alert alert-danger" role="alert">'+
                        '<strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp; Found Error(s) </strong>'+
                        response.message+'</div>');
          create_csrf();
        }

      },
      fail:function () {
        console.log('error');
      }
    });

  });
}

function create_csrf() {
  $.getJSON(baseurl + 'public/report/set-csrf', function(data) {
    $("#csrfToken").attr('name', data.name).attr('value', data.hash);
  });
}
