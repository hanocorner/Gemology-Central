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
    },
    preview: function () {
      var id = $(this).data('id');
      var repoType = $('select').val();
      previewReport(id, repoType)
      create_csrf();
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

function previewReport(id, repoType)
{
  var tbody = $('#previewResults');

  $('#previewModal').modal({backdrop: 'static', keyboard: false});

  $.ajax({
    url: baseurl+'admin/gemstone/preview',
    type: 'GET',
    dataType: 'JSON',
    data: {
      'repid': id,
      'repoType': repoType
    },
    beforeSend:function () {
      tbody.html(null);
    },
    success :function (data) {
      tbody.append('<tr><td><img src="'+baseurl+'assets/admin/images/gem/'+data.img_gemstone+'" alt="'+ data.repid+'" width="80px" height="80px"></td></tr>');
      tbody.append('<tr><td width="120"><strong>Number:</strong></td> <td>'+ data.repid+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Date:</strong></td> <td>'+data.rep_date+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Object:</strong></td> <td>'+data.rep_object+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Variety:</strong></td> <td>'+data.rep_variety+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Species/Group:</strong></td> <td>'+data.rep_spgroup+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Weight:</strong></td> <td>'+data.rep_weight+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Dimensions:</strong></td> <td>'+data.rep_gemWidth+' x '+data.rep_gemHeight+' x '+data.rep_gemLength+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Shape & Cut:</strong></td> <td>'+data.rep_shapecut+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Color:</strong></td> <td>'+data.rep_color+'</td></tr>');
      tbody.append('<tr><td width="120"><strong>Comments:</strong></td> <td>'+data.rep_comment+'</td></tr>');

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
