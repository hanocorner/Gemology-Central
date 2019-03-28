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
      <li class="breadcrumb-item active">My Reports</li>
    </ol>

    <!-- Search My Reports -->
    <!-- <form class="mt-3">
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
          <a href="#" class="btn btn-sm btn-dark" data-action="searchReport"> Search Report </a>
        </div>
      </div>
    </form> -->
    <!-- Search My Reports -->

    <!-- Grid nav -->
    <div class="grid-nav">
      <div class="input-group">
        <span class="mr-2">Show</span>
        <select id="rowCount" style="width:3rem;">
          <option selected="selected">10</option>
          <option>15</option>
          <option>25</option>
          <option>50</option>
        </select>
        <span class="mx-2">entries</span>
      </div>

      <select id="" style="width:5rem;" class="mx-2">
        <option selected="selected">Date</option>
        <option>15</option>
        <option>25</option>
        <option>50</option>
      </select>

      <select id="" style="width:9rem;" class="mx-2">
        <option selected="selected">Unpaid</option>
        <option>Paid - Full Payment</option>
        <option>Paid - Advance</option>
      </select>
      <a href="<?php echo base_url('admin/');?>" class="btn btn-dark btn-sm mx-2"> <i class="fa fa-print fa-fw"
          aria-hidden="true"></i> Print Receipt <span class="badge badge-light">4</span></a>

      <a href="#" class="text-primary ml-2" data-action="reloadAllReports"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i>
        Refresh</a>
      <a href="<?php echo base_url('admin/report/add'); ?>" class="btn btn-primary btn-sm ml-auto"><i class="fa fa-plus fa-fw"
          aria-hidden="true"></i>
        Add Report</a>

    </div>
    <!-- /. of Grid nav -->


    <div id="allReportData"></div>

  </div><!-- /. of container fluid -->
</div><!-- /. of container wrapper -->

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Payment Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Amount field is only required if you select paid option</p>
        <?php echo form_open('admin/report/', array('id'=>'', 'class'=>'needs-validation')); ?>
        <input type="hidden" id="reportId" value="74">
        <div class="form-row">
          <div class="col">
            <input type="text" class="form-control" id="validationTooltip01" placeholder="Amount" name="amountUpdate">
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>
      <div class="modal-footer">
        <a href="#" data-value="0" data-action="psUnpaid" class="btn btn-danger btnupd"> Unpaid</a>
        <a href="#" data-value="1" data-action="psPaidA" class="btn btn-warning">Paid - Advance</a>
        <a href="#" data-value="2" data-action="psPaidF" class="btn btn-success">Paid - Full Amount</a>
      </div>

    </div>
  </div>
</div>