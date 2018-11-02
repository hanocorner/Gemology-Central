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
          <th scope="col"><input type="checkbox" type="checkbox" onchange="checkAll(this)" name="chk[]" aria-label="Checkbox for following text input"></th>
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
      <tr class="grid-tr">
        <th style="width:2%;"><input type="checkbox" aria-label="Checkbox for following text input"></th>
        <td style="width:5%;">102</td>
        <td style="width:10%;"><span class="text-warning"><i class="fa fa-circle" aria-hidden="true"></i></span>Certificate</td>
        <td style="width:20%;">Nimal Siripala</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;"><span class="badge badge-warning">Pending</span></td>
        <td style="width:10%;">
          <div class="d-flex align-items-center justify-content-center">
            <a href="#" class="mx-2"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" class="mx-2"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" class="mx-2"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
          </div>
        </td>
      </tr>
      <tr class="grid-tr active"  data-toggle="collapse" data-target="#demo1">
        <th style="width:2%;"><input type="checkbox" aria-label="Checkbox for following text input"></th>
        <td style="width:5%;">102</td>
        <td style="width:10%;"><span class="text-warning"><i class="fa fa-circle" aria-hidden="true"></i></span>Certificate</td>
        <td style="width:20%;">Nimal Siripala</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;"><span class="badge badge-warning">Pending</span></td>
        <td style="width:10%;">
          <div class="d-flex align-items-center justify-content-center">
            <a href="#" class="mx-2"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" class="mx-2"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" id="plus" class="mx-2" ><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
          </div>
        </td>
      </tr>
      <!-- <tr class="grid-tr exRow" id="erow"></tr> -->
      <tr class="grid-tr">
        <th style="width:2%;"><input type="checkbox" aria-label="Checkbox for following text input"></th>
        <td style="width:5%;">102</td>
        <td style="width:10%;"><span class="text-warning"><i class="fa fa-circle" aria-hidden="true"></i></span>Certificate</td>
        <td style="width:20%;">Nimal Siripala</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;">@mdo</td>
        <td style="width:10%;"><span class="badge badge-success">Checked</span></td>
        <td style="width:10%;">
          <div class="d-flex align-items-center justify-content-center">
            <a href="#" class="mx-2"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" class="mx-2"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
            <a href="#" id="plus" class="mx-2" ><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
          </div>
        </td>
      </tr>
    </table>
<!-- /. of grid  -->

  </div><!-- /. of container fluid -->
</div><!-- /. of container wrapper -->
<script>
$(document).ready(function() {
  // function change(param){
  //   param.preventDefault();
  //   $(param).find('.grid-tr').css('background-color', '#f7e3a7');
  // }
  $('table').on('click', '#plus', function(event) {
    event.preventDefault();

    $('.active', 'table').css('background-color', '#f7e3a7');
    $('#erow').html('<td colspan="6" class="hiddenRow"><div class="accordian-body collapse" id="demo1">Demo Content</div></td>').fadeIn('slow');
  });
 });
// $(function() {
//   $(".accordian-body").on("show.bs.collapse", function() {
//   $(this)
//     .closest("table")
//     .find(".collapse.in")
//     .not(this)
//     .collapse("toggle");
//   });
//
// });
function checkAll(ele) {
    var checkboxes = document.getElementsByTagName('input');
    if (ele.checked) {
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type == 'checkbox') {
          checkboxes[i].checked = true;
          $('.grid-tr', 'table').css('background-color', '#f7e3a7');
        }
      }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            console.log(i)
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = false;
                $('.grid-tr', 'table').css('background-color', '#fff');
            }
        }
    }
}
</script>
