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
          <a href="#" class="btn btn-sm btn-dark" data-action="searchReport"> Search Report </a>
        </div>
      </div>
    </form>
    <!-- Search My Reports -->

    <!-- Jumbptron -->
    <div class="jumbotron mt-3" style="padding:10px;">
      <div class="d-flex align-items-center">
        <div class="input-group">
          <span class="mr-2">Show</span>
          <select id="rowCount" style="width:3rem;">
            <option>10</option>
            <option>15</option>
            <option>25</option>
            <option>50</option>
          </select>
          <span class="mx-2">entries</span>
          <a href="#" data-action="reload" class="mx-2"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i> Reload</a>
        </div>

        <a href="<?php echo base_url('admin/report/add'); ?>" class="btn btn-primary">Add</a>
      </div>
    </div>
    <!-- /. of Jumbotron -->

    
    <div id="allReportData"></div>

  </div><!-- /. of container fluid -->
</div><!-- /. of container wrapper -->
<script>
  // $(document).ready(function () {

  //   $(document).on('click', 'tbody tr', function () {
  //     var checked = $(this).find('input[type="checkbox"]');
  //     var id = $(this).data('id');
  //     console.log(id);

  //     checked.prop('checked', !checked.is(':checked'));
  //     $(this).toggleClass('selected');
  //   });
  //   $(document).on('click', '#sAll', function (event) {
  //     event.preventDefault();
  //     $('tbody tr').toggleClass('selected');
  //     $('#usAll').toggleClass('cursor')
  //     var id = $(this).data('id');

  //     console.log(id);
  //   });
  //   $(document).on('click', '#plus', function (event) {
  //     event.preventDefault();
  //     $(this).parent('tbody tr').toggleClass('selected');
  //     $('#erow').toggle(function () {
  //       /* Stuff to do every *odd* time the element is clicked */

  //     }, function () {
  //       /* Stuff to do every *even* time the element is clicked */
  //       $('#erow').text('Demo content');
  //     });

  //     // $('#erow').html('<td colspan="6" class="hiddenRow"><div class="accordian-body collapse" id="demo1">Demo Content</div></td>').toggle();
  //   });
  //   //  $(document).on('click', 'input[type="checkbox"]', function () {
  //   //     $(this).prop('checked', !$(this).is(':checked'));
  //   //     $(this).parent('tr').toggleClass('selected'); // or anything else for highlighting purpose
  //   // });
  // });
</script>