$(function(){
  getCustomerAll(1);

  $('body').on("keyup",'#squery', function(e){
    e.preventDefault();
    var value = $(this).val();

    if (value == '') {
      getCustomerAll(1);
    }
    else {
      search(value);
    }
   });


  var btnActions = {
    cstgemData:function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      dataBundle(id);
    },
    pagination:function (e) {
      e.preventDefault();
      var page = $(this).data("ci-pagination-page");
      getCustomerAll(page);
    },
    reFresh:function (e){
      e.preventDefault();
      location.reload();
    }
  };

  $(document).on("click", 'a[data-action]', function (event) {
    var link = $(this);
    var action = link.data("action");

    if( typeof btnActions[action] === "function" ) {
      btnActions[action].call(this, event);
    }
  });

});

// Search Customer by full name
function search(query) {
  $.ajax({
    url: baseurl+'admin/customer/search',
    type: 'GET',
    dataType: 'html',
    data: {
      "q":query
    },
    success: function(data) {
      return $('#customerAll').html(data);
    },
    fail: function() {
      console.log("error");
    }
  });
}

// Generating the customer list
function getCustomerAll(page) {
  $.ajax({
    url: baseurl+'admin/customer/customer-list/'+page,
    type: 'GET',
    dataType: 'html',
    success: function(data) {
      $('#customerAll').html(data);
    },
    fail: function() {
      console.log("error");
    }
  });
}

// Customer relvant report
function dataBundle(cstid) {
  $.ajax({
    url: baseurl+'admin/customer/customer-report',
    type: 'POST',
    dataType: 'html',
    data: {
      "id": cstid
    },
    success: function(data) {
      $('#allData').html(data);
    },
    fail: function() {
      console.log("error");
    }
  });
}
