function format(url, d) {
  // `d` is the original data object for the row
  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
    '<tr>' +
    '<td>Full name:</td>' +
    '<td>' + d.cerno + '</td>' +
    '</tr>' +
    '<tr>' +
    '<td>Extension number:</td>' +
    '<td>' + d.cer_shape + '</td>' +
    '</tr>' +
    '<tr>' +
    '<td>Extra info:</td>' +
    '<td>And any further details here (images etc)...</td>' +
    '</tr>' +
    '</table>';

}

function dataTable(url) {
  var customerTable = $('#custTable').DataTable({
    "scrollX": true,
    "pagingType": "first_last_numbers",
    "processing": true,
    "serverSide": true,
    "ordering": false,
    "ajax": {
      url: url + "admin/report/all", // json datasource
      type: "POST"
    },
    "columns": [{
        "data": "custid"
      },
      {
        "data": "cus_firstname"
      },
      {
        "data": "cus_lastname"
      },
      {
        "data": "cus_email"
      },
      {
        "data": function(e) {
          return '<a href="' + url + 'admin/report/gem" class="btn btn-info" target="_blank">' + '<i class="fa fa-eye" aria-hidden="true"></i>&nbsp;See Gemstone(s)' + '</a>&nbsp;&nbsp;&nbsp;&nbsp;' +
            '<a href="' + url + 'admin/report/edit-customer/' + e.custid + '" class="btn btn-warning" target="_blank">' + '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit Customer' + '</a>&nbsp;&nbsp;&nbsp;&nbsp;' +
            '<a href="#" data-id="' + e.custid + '" class="btn btn-danger delete"  data-toggle="modal" data-target="#deleteModal">' + '<i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete' + '</a>';
        }
      }
    ]
  });

  return customerTable;
}


function gemTable(url, id) {
  var gemData = $('#gemTable').DataTable({
    "rowCallback": function(row, data) {
      if (data.cer_type == 'cert-report') {
        $('td:eq(1)', row).html('Report');
        $('td:eq(7)', row).html('<a href="' + url + 'admin/report/print-preview/cert-report/' + data.cerno + '" target="_blank" class="btn btn-dark">' + '<i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print Report' + '</a>');
      }
      if (data.cer_type == 'memo-card') {
        $('td:eq(1)', row).html('Memo Card');
        $('td:eq(7)', row).html('<a href="' + url + 'admin/report/print-preview/memo-card/' + data.cerno + '" target="_blank" class="btn btn-dark">' + '<i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print Memo' + '</a>');
      }
      if (data.cer_type == 'verbal') {
        $('td:eq(1)', row).html('Verbal');
        $('td:eq(7)', row).html('<a href="JavaScript:void(0);" class="btn btn-dark">' + '<i class="fa fa-minus-circle" aria-hidden="true"></i>&nbsp;Print void' + '</a>');
      }

      if (data.cer_paymentStatus == 1) {
        $('td:eq(5)', row).css('color', '#4cad24').html('<strong><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Paid</strong>');
      }
      if (data.cer_paymentStatus == 0) {
        $('td:eq(5)', row).css('color', '#c82333').html('<strong><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp; Unpaid</strong>');
      }
    },
    "scrollX": true,
    "pagingType": "first_last_numbers",
    "processing": true,
    "serverSide": true,
    "ordering": false,
    "ajax": {
      url: url + "admin/report/gem-all/", // json datasource
      type: "POST",
      data: {
        id: id
      }
    },
    "columns": [{
        "data": "cerno"
      },
      {
        "data": "cer_type"
      },
      {
        "data": "cer_object"
      },
      {
        "data": "cer_identification"
      },
      {
        "data": "cer_weight"
      },
      {
        "data": "cer_paymentStatus"
      },
      {
        "data": function(e) {
          return '<div class="btn-group">' +
            '<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' + '<i class="fa fa-usd" aria-hidden="true"></i>&nbsp;Payment' + '</a>&nbsp;&nbsp;&nbsp;&nbsp;' +
            '<div class="dropdown-menu">' +
            '<a class="dropdown-item paid" data-id="' + e.cerno + '" data-status="1" href="#">Paid</a>' +
            '<a class="dropdown-item unpaid" data-id="' + e.cerno + '" data-status="0" href="#">Unpaid</a>' +
            '<a class="dropdown-item receipt" href="' + url + 'admin/report/print-receipt/' + e.cerno + '">Print Receipt</a>' +
            '</div>' +
            '</div>' +
            '<a href="#" class="btn btn-success"  data-id="' + e.cerno + '" data-toggle="modal" data-target="#previewModal" id="preID">' + '<i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Preview' + '</a>&nbsp;&nbsp;&nbsp;&nbsp;' +
            '<a href="' + url + 'admin/report/edit-gemstone/' + e.cerno + '" class="btn btn-warning" target="_blank">' + '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit Gemstone' + '</a>&nbsp;&nbsp;&nbsp;&nbsp;' +
            '<a href="#" data-id="' + e.cerno + '" class="btn btn-danger delete"  data-toggle="modal" data-target="#deleteModal">' + '<i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete' + '</a>&nbsp;&nbsp;&nbsp;&nbsp;';

        }
      },
      {
        "data": "cer_type"
      }
    ]
  });
}

// Preview Gemstone Data
function preview(url, crno, result) {
  $.ajax({
    url: url + 'admin/report/preview-modal',
    type: 'POST',
    dataType: 'html',
    data: {
      'id': crno
    },
    success: function(data) {
      result(data);
    },
    fail: function() {
      console.log("error");
    }
  });
}


// Delete Report
function deleteReport(url, crno) {
  $.ajax({
    url: url + 'admin/report/delete',
    type: 'POST',
    dataType: 'html',
    data: {
      'id': crno
    },
    success: function() {
      window.top.location = window.top.location;
    },
    fail: function() {
      console.log("error");
    }
  });
}

function ajax(reportType) {
  $.ajax({
    url: baseurl+'admin/report/'+reportType,
    type: 'GET',
    dataType: 'html',
    success: function(data) {
      $('#id').val(data);
    },
    fail: function() {
      console.log("error");
    }
  });
}

function gemstone() {
  $.ajax({
    url: baseurl+'admin/report/gem-list',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      $.each(data, function(key, value) {
        var toAppend = "";
        toAppend += '<option value="'+value.gemid+'">'+value.gem_name+'</option>';
        gemtype.append(toAppend);
      });
    },
    fail: function() {
      console.log("error");
    }
  });
}
