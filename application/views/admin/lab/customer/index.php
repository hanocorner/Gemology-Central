<style media="screen">
  .dataTables_filter {
    margin-bottom: 8px;
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
        Customer
      </li>
    </ol>
    <!-- /. of Breadcrumbs-->

    <div class="padding-1"></div>
    <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>My Customers</h2>

    <div class="padding-1"></div>

    <!-- Customer DataTable -->
    <div class="table-responsive">
      <table class="table table-hover table-striped table-bordered " id="dataTable" width="100%" >
        <a href="<?php echo base_url('admin/customer/add');?>" class="btn btn-primary float-right mb-3">
          <i class="fa fa-plus" aria-hidden="true"></i>Add Customer
        </a>
        <thead>
          <tr>
            <th>#ID</th>
            <th>Full Name</th>
            <th>Number</th>
            <th>Created Date</th>
            <th>Total Reports</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- /. Customer DataTable -->

  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

<!--Edit modal -->
<div class="modal fade" id="editModal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-user" aria-hidden="true"></i>Edit Customer</h4>
            </div>
            <div class="modal-body">
              <!-- Alert box -->
              <div id="messageBox"></div>
              <!-- /. Alert box -->
              <?php echo form_open(); ?>
                  <div class="form-row">
                    <div class="form-group col-6">
                      <label for="first-name">First Name:<sup>*</sup> </label>
                      <input type="text" class="form-control form-control-sm" aria-label="Text input with dropdown button"  name="fname" data-validation="required" autocomplete="off" >
                    </div>
                    <div class="form-group col-6">
                      <label for="last-name">Last Name:<sup>*</sup></label>
                      <input type="text" class="form-control form-control-sm" name="lname" data-validation="required" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-12">
                      <label for="Number">Number:<sup>*</sup></label>
                      <input type="tel" class="form-control form-control-sm" name="number" data-validation="length" data-validation-length="7-10" data-validation-error-msg="Phone number has to contain Min 7 and Max 10" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-12">
                      <label for="email">Email: </label>
                      <input type="email" class="form-control form-control-sm" name="email" autocomplete="off">
                    </div>
                  </div>
                  <input type="hidden" class="form-control" id="custID" value="">

              <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
              <!-- <a href='javascript:void(0);' class="btn btn-small btn-danger" id="deltrue" data-id=""><i class="fa fa-check" aria-hidden="true"></i>Yes</a> -->
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
              <button type="sumbit" id="update" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>Update Customer</button>
            </div>
        </div>
    </div>
</div>

<!--Delete modal-->
<div class="modal fade" id="deleteModal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-question-circle" aria-hidden="true"></i>Delete Customer</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this customer? </p>
              <p><strong><i class="fa fa-user-o" aria-hidden="true"></i><span id="customer_name"></span></strong></p>
            </div>
            <div class="modal-footer">
              <a href='javascript:void(0);' class="btn btn-small btn-danger" id="deltrue" data-id=""><i class="fa fa-check" aria-hidden="true"></i>Yes</a>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>No</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  var csrfToken = $("input[name=csrf_test_name]");
  var msgBox = $('#messageBox');

  var table = $('#dataTable').DataTable({
    "scrollX": true,
    "pagingType": "first_last_numbers",
    "processing": true,
    "serverSide": true,
    "ordering": false,
    "ajax":{
      url:"<?php echo base_url(); ?>admin/customer/customer/populate", // json datasource
      type:"GET"
    },
    "columns": [
      {"data":"custid"},
      {
        "data":function (e){
          return e.cus_firstname+'&nbsp;'+e.cus_lastname;
        }
      },
      {"data":"cus_number"},
      {"data":"cus_createdDate"},
      {"data":"cus_totalReports"},
      {
        "data": function (e) {
          $('#cname').html(e.custid);
          return '<a href="#" id="toEdit" data-id="'+e.custid+'" class="btn btn-warning edit">' + '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit' + '</a>&nbsp;&nbsp;&nbsp;'+
                 '<a href="#" data-id="'+e.custid+'" data-value="'+e.cus_firstname+'&nbsp;'+e.cus_lastname+'" class="btn btn-danger delete">' + '<i class="fa fa-trash-o" aria-hidden="true"></i>Delete' + '</a>';
        }
      }
    ]
  });

  $('#dataTable').on('click', 'a.delete', function(event) {
    event.preventDefault();
    $('#deleteModal').modal('toggle');
    var id = $(this).data('id');
    var cname = $(this).data('value');
    $('#customer_name').html(cname);
    $('#deltrue').attr('data-id', id);
  });

  $('#deleteModal').on('click','a#deltrue', function() {
    $('#deleteModal').modal('hide');
    var cid = $('#deltrue').data('id');
    $.ajax({
      url: '<?php echo base_url('admin/customer/customer/delete'); ?>',
      type: 'GET',
      dataType: 'JSON',
      data: {custid:cid},
      success: function (response) {
        //csrfToken.val(response.csrf);
        if(!response.auth){
          swal("Deletion Unsuccessfull", response.message, "error", {closeOnClickOutside: false, closeOnEsc: false});
          return;
        }
        if(response.auth){
          swal("Deletion Successfull", response.message, "success", {closeOnClickOutside: false, closeOnEsc: false});
        }
      },
      fail:function () {
        console.log('error');
      }
    });
  });
  $('.swal-modal').on('click', 'button.swal-button--confirm', function() {
    location.reload();
  });

  $('#dataTable').on('click', 'a.edit', function(event) {
    event.preventDefault();
    $('#editModal').modal('toggle');
    var id = $(this).data('id');
    $('#custID').attr('value', id);
    $.ajax({
      url: '<?php echo base_url('admin/customer/customer/append-toedit'); ?>',
      type: 'GET',
      dataType: 'JSON',
      data: {
        'csrf_test_name': csrfToken.val(),
        custid:id
      },
      success: function (data) {
        $("input[name='fname']").val(data.cus_firstname);
        $("input[name='lname']").val(data.cus_lastname);
        $("input[name='number']").val(data.cus_number);
        $("input[name='email']").val(data.cus_email);
      },
      fail:function () {
        console.log('error');
      }
    });
  });

  $('#editModal').on('click','button#update', function(event){
    event.preventDefault();

    $.ajax({
      url: '<?php echo base_url('admin/customer/customer/update'); ?>',
      type: 'POST',
      dataType: 'JSON',
      data: {
        'csrf_test_name':csrfToken.val(),
        custid:$('#custID').val(),
        fname:$("input[name='fname']").val(),
        lname:$("input[name='lname']").val(),
        number:$("input[name='number']").val(),
        email:$("input[name='email']").val()
      },
      beforeSend: function () {
        msgBox.html('<div class="alert alert-info-alt" role="alert"><i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only"></span>&nbsp; Processing...</div>');
      },
      success: function (response) {
        csrfToken.val(response.csrf);
        if(!response.auth){
          msgBox.html('<div class="alert alert-danger-alt" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>'+response.message+'</div>');
          return;
        }
        if(response.auth){
          $('#editModal').modal('hide');
          swal("Updation Successfull", response.message, "success", {closeOnClickOutside: false, closeOnEsc: false});
        }
      },
      fail:function () {
        console.log('error');
      }
    });
  });

}); // End of Document ready function

</script>
