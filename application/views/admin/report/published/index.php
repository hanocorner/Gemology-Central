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

      <a href="#" class="btn btn-dark btn-sm mx-3" data-toggle="modal" data-target="#searchModal" data-backdrop="static" data-keyboard="false"> 
        <i class="fa fa-search fa-fw"></i>
        Search
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

<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel"><i class="fa fa-plus fa-fw"></i>&nbsp; Advanced Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Advance Search -->
        <?php echo form_open('admin/report/handler/populate-published', array('id'=>'formAdvanceSearch')); ?>
      <div class="form-row mt-3">
        <div class="form-group col-4">
          <input type="text" class="form-control form-control-sm" name="customer" placeholder="Customer">
        </div>
        <div class="form-group col-4">
          <input type="text" class="form-control form-control-sm" name="color" placeholder="Color">
        </div>
        <div class="form-group col-4">
          <input type="text" class="form-control form-control-sm" name="shape" placeholder="Shape">
        </div>
        <div class="form-group col-4">
          <input type="text" class="form-control form-control-sm" name="width" placeholder="Width">
        </div>
        <div class="form-group col-4">
          <input type="text" class="form-control form-control-sm" name="weight" placeholder="Weight">
        </div>
      </div>
      <?php echo form_close(); ?>
      <!-- Advance Search -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-action="advanceSearch">Search</button>
      </div>
    </div>
  </div>
</div>