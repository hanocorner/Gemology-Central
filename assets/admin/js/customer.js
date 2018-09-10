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

// Search Customer Data
function search(query) {
  $.ajax({
    url: baseurl+'admin/report/search',
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

// customer Data
function getCustomerAll(page) {
  $.ajax({
    url: baseurl+'admin/report/xmlHttpReq-customer/'+page,
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

// Specific data
function dataBundle(cstid) {
  $.ajax({
    url: baseurl+'admin/report/get-data-bundle',
    type: 'GET',
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
