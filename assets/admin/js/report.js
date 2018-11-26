function append_toedit() {
  var id = $('#labRepid').val();

  $.ajax({
    url: baseurl +'admin/report/edit/populate/'+id,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      // Customer Data
      $('#custName').html(data.cus_firstname + ' ' + data.cus_lastname);
      $('#custId').html(data.custid);

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

      $('#rmid').val(data.repid);
      $('#pstatus').val(data.pstatus);
      $('#amount').val(data.amount);
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



// Function Update
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
          window.location.href = response.url;
        }
        if (!response.isvalid) {


          alertbox.html('<div class="alert alert-danger" role="alert">'+
                        '<strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp; Found Error(s) </strong>'+
                       response.message +'</div>');
          create_csrf();

        }

      },
      fail:function () {
        console.log('error');
      }
    });

  });
}


// ******* NEW *******
