$(function () {

	/* Varibales */
	var formData = null;
	var message = new Array();
	var messageBox = $('#messageBox');
	var formLogin = $('#formLogin');
	//var hulla = new hullabaloo();
	var spinnerSelector = $('#spinner');
	var spinner = '<i class="fa fa-spinner fa-spin fa-lg fa-fw d-block mx-auto text-primary mt-3"></i><span class="sr-only">Loading...</span>';
	var rows = $('#rowCount').find(":selected").text();

	/* Functions */

	//
	var message = function (msg, type) {
		var box;
		switch (type) {
			case 'error':
				return '<div class="notify-box">' +
					'<noscript>Sorry, your browser does not support JavaScript!</noscript>' +
					'<div class="error d-flex align-items-center">' +
					'<img src="' + baseurl + 'assets/images/error.png" alt="Error-Image" class="img-fluid">' +
					'<div>' + msg + '<div>' +
					'</div>' +
					'</div>';
			case 'success':
				return '<div class="notify-box">' +
					'<noscript>Sorry, your browser does not support JavaScript!</noscript>' +
					'<div class="success d-flex align-items-center">' +
					'<img src="' + baseurl + 'assets/images/success.png" alt="Success-Image" class="img-fluid">' +
					'<p>' + msg + '</p>' +
					'</div>' +
					'</div>';
			case 'info':
				return '<div class="notify-box">' +
					'<noscript>Sorry, your browser does not support JavaScript!</noscript>' +
					'<div class="info d-flex align-items-center">' +
					'<img src="' + baseurl + 'assets/images/info.png" alt="Success-Image" class="img-fluid">' +
					'<p>' + msg + '</p>' +
					'</div>' +
					'</div>';
			default:
				return 'Unable to display Message';
		}
	}

	// User Login
	var login = function (fm) {

		formData = new FormData(fm);

		$.ajax({
			url: formLogin.attr("action"),
			type: formLogin.attr("method"),
			dataType: 'JSON',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function () {
				messageBox.html(message('Processing...', 'info'));
			},
			success: function (response) {
				if (response.auth) {
					messageBox.html(message(response.message, 'success'));
					location.href = response.url;
				} else {
					$('input[name=csrf_test_name]').val(response.csrf);
					messageBox.html(message(response.message, 'error'));
				}
			},
			fail: function () {
				console.log('Error');
			}
		});
	}

	// Executing functions according to url
	var urlBasedAction = function () {
		return window.location.pathname.split('/');
	};

	// Fetch Latest Activities
	var latestActivities = function () {
		$.ajax({
			url: baseurl + 'admin/dashboard/account/latest_activities',
			type: 'GET',
			dataType: 'html',
			beforeSend: function () {
				spinnerSelector.html(spinner);
			},
			success: function (data) {
				spinnerSelector.html('');
				$('#latestActivity').html(data);
			},
			fail: function () {
				console.log('Error');
			}
		});
	};

	// Fetch all reports
	var renderAllReportData = function (page, rows) {

		$.ajax({
			url: baseurl + 'admin/report/handler/fetch-all/' + page + '/',
			type: 'GET',
			dataType: 'html',
			data: {
				page: page,
				rows: rows
			},
			beforeSend: function () {
				$('#allReportData').html(spinner);
			},
			success: function (data) {
				$('#allReportData').html('');
				$('#allReportData').html(data);
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};

	// Search Report
	var searchReportData = function () {

		$.ajax({
			url: baseurl + 'admin/report/handler/fetch-all',
			type: 'GET',
			dataType: 'html',
			data: {
				search: true,
				customer: $('#qCustomer').val(),
				color: $('#qColor').val(),
				shape: $('#qShape').val(),
				width: $('#qWidth').val(),
				weight: $('#qWeight').val()
			},
			beforeSend: function () {
				$('#allReportData').html(spinner);
			},
			success: function (data) {
				$('#allReportData').html('');
				$('#allReportData').html(data);
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};

	//
	var updatePayment = function (status, receipt, id, inputAmount) {
		formData = new FormData();

		if(inputAmount == '' || inputAmount == null)
		{
			formData.append('amount', 0.00);
		}
		else {
			formData.append('amount', inputAmount);
		}
		
		formData.append('status', status);
		formData.append('id', id);
		formData.append('isreceipt', receipt);

		$.ajax({
			url: baseurl + 'admin/report/handler/update-payment',
			type: 'GET',
			dataType: 'JSON',
			data: formData,
			beforeSend: function () {
				
			},
			success: function (response) {
				
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};
	

	/* Binding */

	// Create

	formLogin.on("submit", function (event) {
		event.preventDefault();
		login(this);
	});

	var uri = urlBasedAction();

	if (uri[2] == 'dashboard') {
		latestActivities();
	}

	if (uri[2] == 'report' && uri[3] == 'all') {
		renderAllReportData(1, rows);

		$('#rowCount').on('change', function () {
			renderAllReportData(1, this.value);
		});

		//
		var btnActions = {
			pagination: function (e) {
				e.preventDefault();
				var page = $(this).data("ci-pagination-page");
				renderAllReportData(page, rows);
			},
			reloadAllReports: function (e) {
				e.preventDefault();
				renderAllReportData(1, rows);
			},
			searchReport: function (e) {
				e.preventDefault();
				searchReportData();
			},
			psUnpaid: function (e) {
				e.preventDefault();
				var reportID = $('#reportId').val();
				var status = $(this).data('value');

				updatePayment(status, 0, reportID, 0.00);
				
			},
			psPaidA: function (e) {
				e.preventDefault();
				var inputAmount = $('input[name=amountUpdate').val();
				var reportID = $('#reportId').val();
				var status = $(this).data('value');

				updatePayment(status, 1, reportID, inputAmount);
				
			},
			psPaidF: function (e) {
				e.preventDefault();
				var inputAmount = $('input[name=amountUpdate').val();
				var reportID = $('#reportId').val();
				var status = $(this).data('value');

				updatePayment(status, 1, reportID, inputAmount);
			}
		};

		$(document).on("click", 'a[data-action]', function (event) {
			var link = $(this);
			var action = link.data("action");

			if (typeof btnActions[action] === "function") {
				btnActions[action].call(this, event);
			}
		});

	}

}); // End of document ready