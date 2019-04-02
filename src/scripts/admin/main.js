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
		
		//
		var btnActions = {
			
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