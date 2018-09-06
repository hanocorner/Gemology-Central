<style>
input[type="search"]::-webkit-search-cancel-button {
  -webkit-appearance: searchfield-cancel-button;
}
.dropdown-menu li .dropdown-links {
  color: #454545;
}
.dropdown-menu li .dropdown-links:hover {
  color: #007bff;
  text-decoration: none;
}
.search-btn {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
.btn-print{
  background-color: #6434b3;
  color: #fff;
}
.img-preview {
  border: 1px solid #c6c6c6;
  box-shadow: 3px 2px rgb(203,203,203);
}
.form-control {
  margin-right: 15px;
}
</style>

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">
        All Reports
      </li>
    </ol>
    <!-- /. of Breadcrumbs-->

    <!-- Alert box -->
    <?php
    if (isset($_SESSION['message']))
    {
    ?>
    <div class="alert alert-<?php echo $_SESSION['status']; ?>">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong><?php echo $_SESSION['status']; ?></strong> <?php echo $_SESSION['message']; ?>
    </div>
    <?php
    }
    ?>
    <!-- /. Alert box -->

    <!-- Search -->
    <!-- <h5>Search Filters</h5>
    <form class="form-inline" method="get" id="searchForm" autocomplete="off">

      <div class="form-group">
        <input type="text" class="form-control" placeholder="Customer"  id="customer" onkeyup="searchData(this.value)">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Gem Shape" id="shape">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Gem Weight" id="weight">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Gem Color" id="color">
      </div>
      <a href="#" class="btn btn-info" data-action="query" style="margin-right:15px;"><i class="fa fa-search" aria-hidden="true"></i>&nbsp; Search</a>

      <div class="form-group">
        <div class="dropdown" style="margin-right:15px;">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Payment Status
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="#" class="dropdown-links" data-action="paid">&nbsp;<i class="fas fa-hand-holding-usd"></i>&nbsp; Paid</a></li>
            <li><a href="#" class="dropdown-links" data-action="unpaid">&nbsp;<i class="fas fa-hand-holding"></i>&nbsp; Unpaid</a></li>
          </ul>
        </div>
      </div>
      <input type="hidden" name="<?php //echo $name; ?>" value="<?php //echo $hash; ?>" />

    </form> -->
    <!-- /. Search -->

    <div class="padding-1"></div>
    <!-- Example DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> All Reports
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered" id="custTable" width="100%" >
            <a href="<?php echo base_url(); ?>admin/report/add-customer" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; New Customer</a>
            <thead>
              <tr>
                <th>#ID</th>
                <th>FName</th>
                <th>LName</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>

  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->


<!--Delete modal-->
<div class="modal fade" id="deleteModal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this report? </p>
            </div>
            <div class="modal-footer">
              <a href='javascript:void(0);' class="btn btn-small btn-danger" id="deltrue">yes</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">no</button>
            </div>
        </div>
    </div>
</div>

<!-- /. Js -->

  <script type="text/javascript">
    // Body Selectors
    var userData = $('#user_data');
    var cerno;

    var back = '<a class="btn btn-info" style="margin-bottom:10px;" href="<?php echo base_url(); ?>admin/report"><i class="fas fa-arrow-left"></i>&nbsp; Back</a>';

      function searchData(data){
        $.ajax({
          url: "<?php echo base_url();?>admin/report/search",
          method:"GET",
          data: { "data":data }
          })
          .done(function(response)
          {
            userData.html(response);
          })
          .fail(function() {
            console.log("ERROR: XHR Request Failed when fetching data");
          });
      }

      function paymentStatus(status) {
        $.ajax({
          url: "<?php echo base_url();?>admin/report/payment",
          method:"GET",
          data: {"status":status},
          })
          .done(function(response)
          {
            userData.html(response);
          })
          .fail(function() {
            console.log("ERROR: XHR Request Failed when fetching data");
          });
      }

      function updatePayment(numb, status, page) {
        $.ajax({
          url: "<?php echo base_url();?>admin/report/updatePayment",
          method:"GET",
          data: {
            "status":status,
            "numb":numb
          },
          })
          .done(function(response)
          {
            fetchData(page);
          })
          .fail(function() {
            console.log("ERROR: XHR Request Failed when fetching data");
          });
      }

      // Update Content when DOM is Ready
      $(document).ready(function() {

        var customerTable = dataTable('<?php echo base_url(); ?>');
        // Body, series of Click events
        var actions = {


          delete: function (event) {
            $('#delete').modal('show');
            var id = $(this).data('id');
            $(document).on('click', '#deltrue', function() {
              var url = "<?php echo base_url();?>admin/report/delete/"+id;
              $(this).attr('href', url);
            });
          },
          query:function (event) {
            var data = {
              'customer' : $('#customer').val(),
              'shape' : $('#shape').val(),
              'weight' : $('#weight').val(),
              'color' : $('#color').val()
            };
            $('#back').html(back);
            searchData(data);
          },
          paid:function (event) {
            $('#back').html(back);
            paymentStatus(1);
          },
          unpaid:function (event) {
            $('#back').html(back);
            paymentStatus(0);
          },
          userPaid:function (event) {
            var id = $(this).data('id');
            var page = $(this).data("ci-pagination-page");
            updatePayment(id, 1, page);
          },
          userUnpaid:function (event) {
            var id = $(this).data('id');
            var page = $(this).data("ci-pagination-page");
            updatePayment(id, 0, page);
          }
        };

        $(document).on("click", 'a[data-action]', function (event) {
          var link = $(this);
          var action = link.data("action");

          event.preventDefault();

          if( typeof actions[action] === "function" ) {
            actions[action].call(this, event);
          }
        });







      }); // End of document ready function


  </script>
