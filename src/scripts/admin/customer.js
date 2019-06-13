$(function () {

	/* Varibales */

	var formData = null;
	var formAdd = $('#formAddCustomer');
	var formEdit = $('#formEditCustomer');
	var hulla = new hullabaloo();
	var spinner = '<i class="fa fa-spinner fa-spin fa-lg fa-fw d-block mx-auto text-primary mt-3"></i><span class="sr-only">Loading...</span>';
	var rows = $('#rowCount').find(":selected").text();
	var htmlData = $('#allCustomerData');
	
	/* Functions */

	// Executing functions according to url
	var urlBasedAction = function () {
		return window.location.pathname.split('/');
	};

	// Populating the customers grid 
	var populate = function (pg, rw) {
		
		$.ajax({
			url: baseurl + 'admin/customers/customer/populate',
			type: 'GET',
			dataType: 'html',
			data: {
				page: pg,
				rows: rw
			},
			beforeSend: function () {
				htmlData.html(spinner);
			},
			success: function (data) {
				htmlData.html('');
				htmlData.html(data);
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};

	// Add a new customer
	var addCustomer = function () {
		formData = new FormData();
		var ajaxLoader = $('#ajaxLoader');
		var x = formAdd.serializeArray();
		$.each(x, function (i, field) {
			formData.append(field.name, field.value);
		});

		$.ajax({
			url: formAdd.attr("action"),
			type: formAdd.attr("method"),
			dataType: 'JSON',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function () {
				formAdd.hide();
				ajaxLoader.html(spinner);
			},
			success: function (response) {
				ajaxLoader.html('');
				formAdd.show();

				if (response.auth) {
					$('#addModal').modal('hide');
					hulla.send(response.message, 'success');
					populate(1, rows);
					formData = null;
					formAdd.trigger("reset");
					return true;

				} else {
					hulla.send(response.message, 'danger');
				}
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});

	};

	// Populate Edit form
	var populateEdit = function (id, token) {
		var eLoader = $('#eLoader');
		$.ajax({
			url: baseurl + 'admin/customers/customer/populate-edit',
			type: 'POST',
			dataType: 'JSON',
			data: {
				cid: id,
				csrf_test_name: token
			},
			beforeSend: function () {
				eLoader.html(spinner);
				formEdit.hide();
			},
			success: function (data) {
				eLoader.html('');
				formEdit.show();
				if ($.isEmptyObject(data) || data == null) {
					$('#editModal').modal('hide');
					hulla.send('Unable to fetch data', 'danger');
					console.log('empty');
					return false;
				} else {
					$('#eFname').val(data.firstname);
					$('#eLname').val(data.lastname);
					$('#eNumber').val(data.number);
					$('#eEmail').val(data.email);
					$('#customerEditId').val(data.custid);
				}

			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};
	// Update Customer based on user input
	var updateCustomer = function () {
		formData = new FormData();
		var eLoader = $('#eLoader');

		var x = formEdit.serializeArray();
		$.each(x, function (i, field) {
			formData.append(field.name, field.value);
		});

		$.ajax({
			url: formEdit.attr("action"),
			type: formEdit.attr("method"),
			dataType: 'JSON',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function () {
				eLoader.html(spinner);
				formEdit.hide();
			},
			success: function (response) {
				eLoader.html('');
				formEdit.show();

				if (response.auth) {
					$('#editModal').modal('hide');
					hulla.send(response.message, 'success');
					populate(1, rows);
					formData = null;
					formEdit.trigger("reset");
					return true;

				} else {
					hulla.send(response.message, 'danger');
				}
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};

	// Delete customer
	var delCustomer = function (id, token) {
		$.ajax({
			url: baseurl + 'admin/customers/customer/delete',
			type: 'POST',
			dataType: 'JSON',
			data: {
				cid: id,
				csrf_test_name: token
			},
			success: function (response) {
				if (response.auth) {
					$('#delModal').modal('hide');
					hulla.send(response.message, 'success');
					populate(1, rows);

				} else {
					hulla.send(response.message, 'danger');
				}

				id = null;
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};

	// Search customer
	var searchCustomer = function (key) {
		$.ajax({
			url: baseurl + 'admin/customers/customer/populate',
			type: 'GET',
			dataType: 'html',
			data: {
				search: true,
				query: key
			},
			beforeSend: function () {
				htmlData.html(spinner);
			},
			success: function (data) {
				htmlData.html('');
				htmlData.html(data);
			},
			fail: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	};

	/* Binding */

	// Uri Action
	var uri = urlBasedAction();

	// Trigerring the populate customer function
	if (uri[2] == 'customer') {
		populate(1, rows);

		$('#rowCount').on('change', function () {
			populate(1, this.value);
		});

		// Search
		$("#searchCst").keyup(function () {
			var key = $(this).val();
			if (key.length >= 1) {
				searchCustomer(key);
			}
			else if(key.length == 0 ) {
				populate(1, 10);
			}
		});

		// Anchor button actions binding
		var btnActions = {
			add: function (event) {
				event.preventDefault();
				$('#addModal').modal('toggle');
			},
			adCustomer: function (event) {
				event.preventDefault();
				addCustomer();
			},
			deleteModal: function (event) {
				event.preventDefault();
				$('#delModal').modal('toggle');
				$('#cstid').val($(this).data('id'));
			},
			deleteCustomer: function (event) {
				event.preventDefault();
				delCustomer($('#cstid').val(), $(this).data('csrf'));
			},
			editCustomer: function (event) {
				event.preventDefault();
				updateCustomer($(this).data('id'));
			},
			editModal: function (event) {
				event.preventDefault();
				$('#editModal').modal('toggle');
				populateEdit($(this).data('id'), $(this).data('csrf'));
			},
			reloadCustomer: function (event) {
				event.preventDefault();
				$('#rowCount').prop('selectedIndex', 0);
				populate(1, rows);
			},
			pagination: function (event) {
				event.preventDefault();
				var page = $(this).data("ci-pagination-page");
				populate(page, rows);
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