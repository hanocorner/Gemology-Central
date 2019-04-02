$(function () {
    
    /** Variables  **/
    var rows = $('#rowCount').find(":selected").text();
    var spinner = '<i class="fa fa-spinner fa-pulse fa-lg fa-fw d-block mx-auto text-white"></i><span class="sr-only">Loading...</span>';
    var reptype = $('#option1, #option2, #option3');
    var hulla = new hullabaloo();


    /** Functions **/

    // Populate all reports
  var populatePublishedTable = function (page, rows) {

    $.ajax({
      url: baseurl + 'admin/report/handler/populate-published/' + page + '/',
      type: 'GET',
      dataType: 'html',
      data: {
        page: page,
        rows: rows
      },
      beforeSend: function () {
        $('#publishedData').html(spinner);
      },
      success: function (data) {
        $('#publishedData').html('');
        $('#publishedData').html(data);
      },
      fail: function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
  };

  // Search Report
	var searchPublished = function (key) {

		$.ajax({
			url: baseurl + 'admin/report/handler/populate-published',
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

    /** Binding **/

    // Populating draft table function call
    populatePublishedTable(1, rows);

    var btnActions = {
        pagination: function (e) {
          e.preventDefault();
          var page = $(this).data("ci-pagination-page");
          populatePublishedTable(page, rows);
        },
        reload: function (e) {
          e.preventDefault();
          $('#rowCount').prop('selectedIndex', 0);
          $("#searchId").val('');
          populatePublishedTable(1, rows);
        },
    
      };
    
      $(document).on("click", 'a[data-action]', function (event) {
        var link = $(this);
        var action = link.data("action");
    
        if (typeof btnActions[action] === "function") {
          btnActions[action].call(this, event);
        }
      });

});