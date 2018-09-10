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
.cg-data {
  background-color: #FBFBFB;
  opacity: 1;
  box-shadow: #ececec -3px 4px 7px 2px;
  border-radius: 5px;
  padding:15px;
}
.cs-data {
  border: 1px solid #707070;
  border-radius: 5px;
  padding: 15px;
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

    <!-- Search -->
    <div class="row my-4">
      <div class="col-md-3">
        <div class="form-group">
          <input type="search" class="form-control" id="squery"  autocomplete="off" placeholder="Search Customer">
        </div>
      </div>
    </div>
    <!-- /. Search -->

    <!-- Customer & Gem Data  -->
    <div class="row my-4">
      <!-- Customer Data -->
      <div class="col-md-3">
        <div id="customerAll"></div>
      </div>
      <!-- /. Customer Data -->

      <!-- Customer Gem Data -->
      <div class="col-md-8">
        <div id="allData"></div>
      </div>

      <!-- /. Customer Gem Data -->

    </div>
    <!-- /. Customer & Gem Data  -->

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

<script type="text/javascript">
  var baseurl = '<?php echo base_url(); ?>';
</script>
