$(function(){

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
    preview:function () {
      var id = $(this).data('id');
      var reportType = $('select').val();
      previewReport(id, reportType);
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
      'csrf_test_name':csrfhash,
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

  $.ajax({
    url: baseurl+'admin/gemstone/preview',
    type: 'POST',
    dataType: 'JSON',
    data: {
      'repid': id,
      'csrf_test_name':csrfhash,
      'repoType': reportType
    },
    success :function (data) {
      $('#repNumber').html('GCL');
    },
    fail :function () {
      console.log('error');
    }
  });
}
