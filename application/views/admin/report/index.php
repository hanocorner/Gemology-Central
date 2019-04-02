<style media="screen">
  .table .thead-dark th{
    border-color: #32383e;
    border-right: 1px solid #464646;
  }
  .grid-tr {
    background-color: #fff;
    border: 1px solid #f5f5f5;
    box-shadow: 0px 2px 11px #d2d2d2;
  }
  .table {
    border-spacing: 0 8px;
    border-collapse: separate;
  }
  .table tr {
    cursor: pointer;
  }
  .hiddenRow {
    padding: 10px !important;
    font-size: 13px;
  }
  .selected{
    background:#f7e3a7;
  }
  table  tbody  td  .add > i:hover {
    color: #007bff;
  }
  table  tbody  td  .edit > i:hover {
    color: #ffc107;
  }
  table  tbody  td  .delete > i:hover {
    color: #dc3545;
  }
  .cursor {
    cursor: pointer;
    color: #007bff;
  }
  .cursor-d{
    pointer-events: none;
  }
  .cursor-d:hover{
    text-decoration: none;
  }
</style>
<div class="content-wrapper">
  <div class="container-fluid">

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Report</li>
      <li class="breadcrumb-item active">Published</li>
    </ol>

    <!-- Search My Reports -->
    <form class="mt-3">
      <h4>Search filters</h4>
      <div class="form-row mt-3">
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="qCustomer" placeholder="Customer">
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="qColor" placeholder="Color">
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="qShape" placeholder="Shape">
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="qWidth" placeholder="Width">
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="qWeight" placeholder="Weight">
        </div>
        <div class="form-group col-1">
          <a href="#" class="btn btn-sm btn-dark px-2" data-action="searchReport"> Search</a>
        </div>
      </div>
    </form> 
    <!-- Search My Reports -->

    <!-- Grid nav -->
    <div class="grid-nav">
      <div class="d-flex align-items-center">
        <span class="mr-2">Show</span>
        <select id="rowCount" style="width:3rem;">
          <option selected="selected">10</option>
          <option>15</option>
          <option>25</option>
          <option>50</option>
        </select>
        <span class="mx-2">entries</span>
      </div>

      <a href="#" class="text-primary ml-2" data-action="reload"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i>
        Refresh</a>

      <a href="<?php echo base_url('admin/');?>" class="btn btn-dark btn-sm mx-2"> 
        <i class="fa fa-print fa-fw"></i> 
        Print Receipt 
        <span class="badge badge-light">4</span>
      </a>

      <a href="/admin/report/add" class="btn btn-primary btn-sm ml-auto">
        <i class="fa fa-plus fa-fw"></i>
        Add Report
      </a>

    </div>
    <!-- /. of Grid nav -->


    

  </div><!-- /. of container fluid -->

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div id="publishedData"></div>
      </div>
      
    </div>
  </div>

</div><!-- /. of container wrapper -->
