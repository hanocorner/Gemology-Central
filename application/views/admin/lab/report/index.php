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
    <form class="mt-5">
      <h4><i class="fa fa-filter fa-fw" aria-hidden="true"></i>Search Filters</h4>
      <div class="form-row">
        <div class="form-group col-2">
          <select class="form-control form-control-sm">
            <option selected>Category</option>
            <option value="1">Memocard</option>
            <option value="2">Certificate</option>
            <option value="3">Verbal</option>
          </select>
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="" placeholder="Customer">
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="" placeholder="Color">
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="" placeholder="Shape">
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="" placeholder="Width">
        </div>
        <div class="form-group col-2">
          <input type="text" class="form-control form-control-sm" id="" placeholder="Weight">
        </div>
        <!-- <div class="form-group col-1">
          <button type="button" class="btn btn-sm btn-dark" name="button">
            <i class="fa fa-search" aria-hidden="true"></i>
            Search
          </button>
        </div> -->
      </div>
    </form>
    <!-- Search My Reports -->

    <!-- Jumbptron -->
    <div class="jumbotron mt-3" style="padding:15px;">
      <div class="d-flex align-items-center">
        <div class="input-group">
          <span class="mr-2">Show</span>
          <select id="inputGroupSelect01" style="width:3rem;">
            <option selected>10</option>
            <option value="1">15</option>
            <option value="2">25</option>
            <option value="3">50</option>
          </select>
          <span class="mx-2">entries</span>
          <a href="#" id="sAll" class="mx-2"><i class="fa fa-check" aria-hidden="true"></i>Select All</a>
          <a href="#" id="usAll" class="text-muted cursor-d mx-2"><i class="fa fa-times" aria-hidden="true"></i>Unselect</a>
          <a href="#" class="text-muted mx-2"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
          <a href="#" class="mx-2"><i class="fa fa-refresh" aria-hidden="true"></i>Reload</a>
        </div>

        <button type="button" class="btn btn-sm btn-primary float-right" name="button"><i class="fa fa-plus" aria-hidden="true"></i>Add Report</button>
      </div>
    </div>
    <!-- /. of Jumbotron -->

    <!-- Grid -->
    <table class="table">
      <col width="15">
      <col width="60">
      <col width="140">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th scope="col">Report</th>
          <th scope="col">Customer</th>
          <th scope="col">Weight</th>
          <th scope="col">Color</th>
          <th scope="col">Shape</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tr class="grid-tr" data-id="121">

        <td style="width:5%;">102</td>
        <td style="width:10%;"><span class="text-success"><i class="fa fa-circle" aria-hidden="true"></i></span>Verbal</td>
        <td style="width:20%;">Nimal Siripala</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;"><span class="badge badge-warning">Pending</span></td>
        <td style="width:10%;">
          <div class="d-flex align-items-center justify-content-center">
            <a href="<?php echo base_url('admin/report/edit'); ?>" class="text-muted mx-2 buttonz edit"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" class="text-muted mx-2 buttonz delete"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" id="plus" class="text-muted mx-2 buttonz add"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
          </div>
        </td>
      </tr>
      <tr class="grid-tr active"  data-toggle="collapse" data-target="#demo1" data-id="120">

        <td style="width:5%;">102</td>
        <td style="width:10%;"><span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span>Memocard</td>
        <td style="width:20%;">Nimal Siripala</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;"><span class="badge badge-warning">Pending</span></td>
        <td style="width:10%;">
          <div class="d-flex align-items-center justify-content-center">
            <a href="<?php echo base_url('admin/report/edit'); ?>" class="text-muted mx-2 buttonz edit"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" class="text-muted mx-2 buttonz delete"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" id="plus" class="text-muted mx-2 buttonz add"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
          </div>
        </td>
      </tr>
      <tr class="grid-tr exRow" id="erow"></tr>
      <tr class="grid-tr" data-id="122">
        <td style="width:5%;">102</td>
        <td style="width:10%;"><span class="text-danger"><i class="fa fa-circle" aria-hidden="true"></i></span>Certificate</td>
        <td style="width:20%;">Nimal Siripala</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;"><span class="badge badge-success">Checked</span></td>
        <td style="width:10%;">
          <div class="d-flex align-items-center justify-content-center">
            <a href="<?php echo base_url('admin/report/edit'); ?>" class="text-muted mx-2 buttonz edit"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" class="text-muted mx-2 buttonz delete"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" id="plus" class="text-muted mx-2 buttonz add"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
          </div>
        </td>
      </tr>
    </table>
<!-- /. of grid  -->

  </div><!-- /. of container fluid -->
</div><!-- /. of container wrapper -->
<script>
$(document).ready(function() {

  $(document).on('click', 'tbody tr', function () {
      var checked = $(this).find('input[type="checkbox"]');
      var id = $(this).data('id');
      console.log(id);

      checked.prop('checked', !checked.is(':checked'));
      $(this).toggleClass('selected');
    });
    $(document).on('click', '#sAll', function (event) {
      event.preventDefault();
      $('tbody tr').toggleClass('selected');
      $('#usAll').toggleClass('cursor')
      var id = $(this).data('id');

      console.log(id);
    });
    $(document).on('click', '#plus', function (event) {
      event.preventDefault();
      $(this).parent('tbody tr').toggleClass('selected');
      $('#erow').toggle(function() {
        /* Stuff to do every *odd* time the element is clicked */

      }, function() {
        /* Stuff to do every *even* time the element is clicked */
        $('#erow').text('Demo content');
      });

      // $('#erow').html('<td colspan="6" class="hiddenRow"><div class="accordian-body collapse" id="demo1">Demo Content</div></td>').toggle();
    });
   //  $(document).on('click', 'input[type="checkbox"]', function () {
   //     $(this).prop('checked', !$(this).is(':checked'));
   //     $(this).parent('tr').toggleClass('selected'); // or anything else for highlighting purpose
   // });
 });



</script>
