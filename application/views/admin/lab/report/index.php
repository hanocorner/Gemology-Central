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
      <div class="form-row">
        <div class="form-group col-2">
          <select class="form-control form-control-sm">
            <option selected>Category</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
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
        <div class="form-group col-1">
          <input type="text" class="form-control form-control-sm" id="" placeholder="Width">
        </div>
        <div class="form-group col-1">
          <input type="text" class="form-control form-control-sm" id="" placeholder="Weight">
        </div>
        <div class="form-group col-1">
          <button type="button" class="btn btn-sm btn-dark" name="button">
            <i class="fa fa-search" aria-hidden="true"></i>
            Search
          </button>
        </div>
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
          <a href="#" class="mx-2"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
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
          <th scope="col"><input type="checkbox" aria-label="Checkbox for following text input"></th>
          <th>#</th>
          <th scope="col">Report</th>
          <th scope="col">Customer</th>
          <th scope="col">Weight</th>
          <th scope="col">Color</th>
          <th scope="col">Shape</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tr class="grid-tr">
        <th scope="row"><input type="checkbox" aria-label="Checkbox for following text input"></th>
        <td>100</td>
        <td><span class="text-primary"><i class="fa fa-circle" aria-hidden="true"></i></span>Verbal</td>
        <td>Nimal Siripala</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td><span class="badge badge-warning">Pending</span></td>
        <td>@mdo</td>
      </tr>
      <tr class="grid-tr">
        <th scope="row"><input type="checkbox" aria-label="Checkbox for following text input"></th>
        <td>101</td>
        <td><span class="text-danger"><i class="fa fa-circle" aria-hidden="true"></i></span>Memocard</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td><span class="badge badge-success">Checked</span></td>
        <td>@mdo</td>
      </tr>
      <tr class="grid-tr">
        <th scope="row"><input type="checkbox" aria-label="Checkbox for following text input"></th>
        <td>100</td>
        <td><span class="text-warning"><i class="fa fa-circle" aria-hidden="true"></i></span>Certificate</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td><span class="badge badge-warning">Pending</span></td>
        <td>
          <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>
        </td>
      </tr>
    </table>
<!-- /. of grid  -->

  </div><!-- /. of container fluid -->
</div><!-- /. of container wrapper -->
