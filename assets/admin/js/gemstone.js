$(function(){

  create_csrf();

  var btnActions = {
    search:function (e){
      e.preventDefault();
      fetchSearchData();
    },
    refresh:function (){
      $('input').val('');
      $('select').val('default');
      $('#dataTable').html('');
    },
    preClose: function () {
      create_csrf();
    },
    delete: function () {
      var id = $(this).data('id');
      $('#reportID').html(id);
      $('#deleteID').attr('value', id);
    },
    delConfirmed: function () {
      var repid = $('#deleteID').val();
      var reportType = $('select').val();
      deleteReport(repid, reportType);
      location.reload();
    }
  };

  $(document).on("click", 'button[data-action]', function (event) {
    var link = $(this);
    var action = link.data("action");

    if( typeof btnActions[action] === "function" ) {
      btnActions[action].call(this, event);
    }
  });

});

function fetchSearchData() {
  var reportType = $('#reportType').val();

  if(reportType == "default" || reportType == null) {
    alert('Please select report type');
    return false;
  }

  $.ajax({
    url: baseurl +'admin/gemstone/search-data',
    type: 'GET',
    dataType: 'HTML',
    data: {
      reportType: reportType,
      reportNo:$('#reportNo').val(),
      weight: $('#weight').val(),
      color: $('#color').val(),
      width: $('#width').val()
    },
    success :function (data) {
      $('#dataTable').html(data);
    },
    fail :function () {
      console.log('error');
    }
  });

}

function deleteReport(id, reportType)
{
  $.ajax({
    url: baseurl+'admin/gemstone/delete',
    type: 'POST',
    data: {
      'repid': id,
      'csrf_test_name':$('#csrfToken').val(),
      'repoType': reportType
    },
    success :function (data) {
      return data;
    },
    fail :function () {
      console.log('error');
    }
  });

}

function previewReport()
{
  var id = $('#repid').val();
  var reportType = $('select').val();
  var tbody = $('#previewResults');

  $('#previewModal').modal({backdrop: 'static', keyboard: false});

  $.ajax({
    url: baseurl+'admin/gemstone/preview',
    type: 'POST',
    dataType: 'JSON',
    data: {
      'repid': id,
      'csrf_test_name':$('#csrfToken').val(),
      'repoType': reportType
    },
    beforeSend:function () {
      tbody.html(null);
    },
    success :function (data) {
      tbody.append('<tr><td><img src="'+baseurl+'assets/admin/images/gem/'+data.rep_imagename+'" alt="'+ data.memoid+'" width="80px" height="80px"></td></tr>');
      tbody.append('<tr><td width="120"><strong>Number:</strong></td> <td>'+ data.memoid+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Date:</strong></td> <td>'+data.memoid+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Object:</strong></td> <td>'+data.rep_object+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Identification:</strong></td> <td>'+data.rep_identification+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Weight:</strong></td> <td>'+data.rep_weight+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Cut:</strong></td> <td>'+data.rep_cut+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Dimensions:</strong></td> <td>'+data.rep_gemWidth+' x '+data.rep_gemHeight+' x '+data.rep_gemLength+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Shape:</strong></td> <td>'+data.rep_shape+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Color:</strong></td> <td>'+data.rep_color+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Comment:</strong></td> <td>'+data.rep_comment+'</td></tr>');

    },
    fail :function () {
      console.log('error');
    }
  });
}
function create_csrf() {
  $.getJSON(baseurl + 'public/report/set-csrf', function(data) {
    $("#csrfToken").attr('name', data.name).attr('value', data.hash);
  });
}
