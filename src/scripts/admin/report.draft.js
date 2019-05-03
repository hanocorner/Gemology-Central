$(function () {

  // Variables
  var rows = $('#rowCount').find(":selected").text();
  var spinner = '<i class="fa fa-spinner fa-pulse fa-lg fa-fw d-block mx-auto text-white"></i><span class="sr-only">Loading...</span>';
  var reptype = $('#option1, #option2, #option3');
  var hulla = new hullabaloo();

  // Fetch all reports
  var populateDraftTable = function (page, rows) {

    $.ajax({
      url: baseurl + 'admin/report/draft/handler/populate-draft/' + page + '/',
      type: 'GET',
      dataType: 'html',
      data: {
        page: page,
        rows: rows
      },
      beforeSend: function () {
        $('#draftTable').html(spinner);
      },
      success: function (data) {
        $('#draftTable').html('');
        $('#draftTable').html(data);
      },
      fail: function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
    
  };

  // Search Report
	var searchDraft = function (key) {

		$.ajax({
			url: baseurl + 'admin/report/draft/handler/populate-draft',
			type: 'GET',
			dataType: 'html',
			data: {
				search: true,
        id: key
			},
			beforeSend: function () {
				$('#draftTable').html(spinner);
			},
			success: function (data) {
				$('#draftTable').html('');
        $('#draftTable').html(data);
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};

  // Fetch ID Based on user select
  var getId = function (reportType) {
    $.ajax({
      url: baseurl + 'admin/report/handler/id',
      type: 'GET',
      dataType: 'html',
      data: {
        repotype: reportType
      },
      success: function (data) {
        $('#repid').val(data);
      },
      fail: function () {
        console.log('Error');
      }
    });
  }

  // Function to populate customer on user input
  var populateCustomer = function () {
    $("#customer").autocomplete({
      source: function (request, response) {
        $.ajax({
          url: baseurl + 'admin/customers/customer/append-customer',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function (data) {
          var results = $.map(data, function (value, key) {
            return {
              label: value.firstname + ' ' + value.lastname,
              value: value.firstname + ' ' + value.lastname,
              id: value.custid
            };
          });
          response(results);
        });
      },
      minLength: 1,
      select: function (event, ui) {
        $('#customerID').val(ui.item.id);
      }
    });
  };

  // Function to populate shape-cut field on user input
  var populateShapeCut = function () {
    $("#shapecutField").autocomplete({
      source: function (request, response) {
        $.ajax({
          url: baseurl + 'admin/report/handler/populate-shapecut',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function (data) {
          var results = $.map(data, function (value, key) {
            return {
              label: value.shapecut,
              value: value.shapecut
            };
          });
          response(results);
        });
      },
      minLength: 2
    });
  };

  // Function to populate color field on user input
  var populateColor = function () {
    $("#colorField").autocomplete({
      source: function (request, response) {
        $.ajax({
          url: baseurl + 'admin/report/handler/populate-color',
          dataType: "json",
          data: {
            q: request.term
          }
        }).success(function (data) {
          var results = $.map(data, function (value, key) {
            return {
              label: value.color,
              value: value.color
            };
          });
          response(results);
        });
      },
      minLength: 2
    });
  };

  

  // Function to Add a Report to DB
  var addReport = function () {

    var formDraft = $('#addReportDraft');
    var formData = new FormData();
    var cstid = $('#customerID').val();

    var x = formDraft.serializeArray();
    $.each(x, function (i, field) {
      formData.append(field.name, field.value);
    });

    formData.append("customer", cstid);

    $.ajax({
      url: formDraft.attr("action"),
      type: formDraft.attr("method"),
      dataType: 'JSON',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        $('.btn-save').html(spinner);
      },
      success: function (response) {
        $('.btn-save').html('Save');
        if (response.auth) {
          hulla.send(response.message, 'success');
          populateDraftTable(1, rows);
          $('#downlaodQrBtn').html('<a href="' + response.url + '" class="btn btn-sm btn-danger mt-3"><i class="fa fa-download fa-fw"></i> Download</a>');
          formData = null;
          formDraft.trigger('reset');
          return true;

        } else {
          hulla.send(response.message, 'danger');
        }

      },
      error: function (jqXHR, textStatus, errorThrown) {
        hulla.send(errorThrown, 'danger');
      }
    });

  };

  // Function to Add a Report to DB
  var updatePayment = function () {

    var formPayment = $('#paymentForm');
    var formData = new FormData();

    var x = formPayment.serializeArray();
    $.each(x, function (i, field) {
      formData.append(field.name, field.value);
    });

    $.ajax({
      url: formPayment.attr("action"),
      type: formPayment.attr("method"),
      dataType: 'JSON',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        $('#payBtnSave').html(spinner);
      },
      success: function (response) {
        $('#payBtnSave').html('Save');
        if (response.auth) {
          hulla.send(response.message, 'success');
          populateDraftTable(1, rows);
          $('#receiptCount').text(response.total);
          $('#paymentModal').modal('hide');

          formData = null;
          formPayment.trigger('reset');
          return true;

        } else {
          hulla.send(response.message, 'danger');
        }

      },
      error: function (jqXHR, textStatus, errorThrown) {
        hulla.send(errorThrown, 'danger');
      }
    });

  };

  //
  var printReady = function () {
    return $('#tableDraft input:checked').map(function() {
      return this.value;
    }).get().join('-');
  };


  /** Event Binding **/

  populateCustomer();

  populateShapeCut();

  populateColor();

  // Report type selection
  reptype.click(function () {
    if (this.id == 'option1') {
      $('#repotype').val($(this).data('value'));
      getId($(this).data('value'));
    } else if (this.id == 'option2') {
      $('#repotype').val($(this).data('value'));
      getId($(this).data('value'));
    } else if (this.id == 'option3') {
      $('#repotype').val($(this).data('value'));
      getId($(this).data('value'));
    }
  });

  // Populating draft table function call
  populateDraftTable(1, rows);

  // Payment status Advance amount input field display
  $('#pStatus').change(function () {
    var selected = $(this).val();
    if (selected == 'paid-advance') {
      $('#adField').show();
    } else {
      $('#adField').hide();
    }
  });

  $('#rowCount').on('change', function () {
    populateDraftTable(1, this.value);
  });

  //
  $("#searchId").keyup(function (){
    var key = $(this).val();
    if (key.length >= 2) {
      searchDraft(key);
    }
  });

  $('#paymentModal').on('hidden.bs.modal', function (e) {
    $('#paymentForm').trigger('reset');
    $('#adField').hide();
  })

  var btnActions = {
    pagination: function (e) {
      e.preventDefault();
      var page = $(this).data("ci-pagination-page");
      populateDraftTable(page, rows);
    },
    reload: function (e) {
      e.preventDefault();
      $('#rowCount').prop('selectedIndex', 0);
      $("#searchId").val('');
      populateDraftTable(1, rows);
    },
    saveDraft: function (e) {
      e.preventDefault();
      addReport();
    },
    payment:function () {
      $('#pRepId').val($(this).data('id'));
      $('#pRepType').val($(this).data('type'));
      //$(this).closest('tr').toggleClass("highlight", this.checked);
    },
    saveAmount: function (e) {
      e.preventDefault();
      updatePayment();
    }

  };

  $(document).on("click", 'a[data-action]', function (event) {
    var link = $(this);
    var action = link.data("action");

    if (typeof btnActions[action] === "function") {
      btnActions[action].call(this, event);
    }
  });

  $(document).on('click', 'td:first-child input', function(){
    var link = baseurl + 'admin/report/print/receipt/'+ printReady();
    $(this).closest('tr').toggleClass("highlight", this.checked);
    $('#btnPrint').attr('href', link);
  });

  $(document).on('change', 'th:first-child input', function() {
    var checkboxes = $(this).closest('table').find(':checkbox');
    checkboxes.prop('checked', $(this).is(':checked'));
    var link = baseurl + 'admin/report/print/receipt/'+ printReady();
    $(this).closest('table').find('tr').toggleClass("highlight", this.checked);
    $('#btnPrint').attr('href', link);
  });

});