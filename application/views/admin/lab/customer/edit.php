<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Report</li>
      <li class="breadcrumb-item">New Report</li>
      <li class="breadcrumb-item active">Edit Customer</li>
    </ol>

    <div class="padding-1"></div>
    <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>Edit Customer</h2>
    <p>Important fields are mentioned in <strong style="color:red;font-size: 18px;">*</strong></p>
    <div class="padding-1"></div>

    <!-- Alert box -->
    <div style="max-width:33.3333%;" id="messageBox"></div>
    <!-- /. Alert box -->

    <?php echo form_open(); ?>
        <div class="form-row">
          <div class="form-group col-2">
            <label for="first-name">First Name:<sup>*</sup> </label>
              <div class="form-group">
                <input type="text" class="form-control form-control-sm" aria-label="Text input with dropdown button"  name="fname" data-validation="required" autocomplete="off" >
              </div>
          </div>
          <div class="form-group col-2">
            <label for="last-name">Last Name:<sup>*</sup></label>
            <input type="text" class="form-control form-control-sm" name="lname" data-validation="required" autocomplete="off">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-4">
            <label for="Number">Number:<sup>*</sup></label>
            <input type="tel" class="form-control form-control-sm" name="number" data-validation="length" data-validation-length="7-10" data-validation-error-msg="Phone number has to contain Min 7 and Max 10" autocomplete="off">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-4">
            <label for="email">Email: </label>
            <input type="email" class="form-control form-control-sm" name="email" autocomplete="off">
          </div>
        </div>
        <input type="hidden" class="form-control" name="custid" value="<?php echo $custid; ?>">
        <button type="sumbit" id="update" class="btn btn-primary mt-2"><i class="fa fa-floppy-o" aria-hidden="true"></i>Update Customer</button>
    <?php echo form_close(); ?>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    // JS Form Validator
    $.validate();

    var msgBox = $('#messageBox');
    var csrfToken = $("input[name=csrf_test_name]");

    $.ajax({
      url: '<?php echo base_url('admin/customer/customer/append-toedit'); ?>',
      type: 'POST',
      dataType: 'JSON',
      data: {
        'csrf_test_name': csrfToken.val(),
        custid: $("input[name='custid']").val()
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

    update();
  });

  function update() {
    $(document).on('click','#update', function(event){
      event.preventDefault();
      $.ajax({
        url: '<?php echo base_url('admin/customer/customer/update'); ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {
          'csrf_test_name':csrfToken.val(),
          custid:$("input[name='custid']").val(),
          fname:$("input[name='fname']").val(),
          lname:$("input[name='lname']").val(),
          number:$("input[name='number']").val(),
          email:$("input[name='email']").val()
        },
        beforeSend: function () {
          msgBox.html('<div class="alert alert-info-alt" role="alert"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>Processing...</div>');
        },
        success: function (response) {
          csrfToken.val(response.csrf);
          if(!response.auth){
            msgBox.html('<div class="alert alert-danger-alt" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; '+response.message+'</div>');
            return;
          }
          if(response.auth){
            msgBox.html('<div class="alert alert-success-alt" role="alert"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp; '+response.message+'</div>');
          }
          window.location.href = response.url;
        },
        fail:function () {
          console.log('error');
        }
      });
    });
  }
</script>
