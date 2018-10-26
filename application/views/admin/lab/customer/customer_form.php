<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Report</li>
      <li class="breadcrumb-item active">New Customer</li>
    </ol>

    <div class="padding-1"></div>
    <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;New Customer</h2>
    <p>Important fields are mentioned in <strong style="color:red;font-size: 18px;">*</strong></p>
    <div class="padding-1"></div>

    <!-- Alert box -->
    <div style="max-width:33.3333%;" id="messageBox"></div>
    <!-- /. Alert box -->

    <!-- Form Start -->
    <div class="pt-1"></div>
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


      <button type="submit" name="button" class="btn btn-primary mt-3" id="btnSumbit"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save Customer</button>
    <?php echo form_close(); ?>


  </div>
</div>
<script type="text/javascript">
// Customer insertion
$(document).ready(function() {
  // JS Form Validator
  $.validate();

  var msgBox = $('#messageBox');
  var csrfToken = $("input[name=csrf_test_name]");

  $(document).on('click', '#btnSumbit', function(event) {
    event.preventDefault();
    $.ajax({
      url: '<?php echo base_url('admin/customer/insert'); ?>',
      type: 'POST',
      dataType: 'JSON',
      data: {
        'csrf_test_name': csrfToken.val(),
        fname: $("input[name=fname]").val(),
        lname: $("input[name=lname]").val(),
        number:$("input[name=number]").val(),
        email:$("input[name=email]").val()
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
      fail: function () {
        console.log('error');
      }
    });

  });
});
</script>
