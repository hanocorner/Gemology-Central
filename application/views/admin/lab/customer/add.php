<style media="screen">
  sup {
    color: red;
    font-size: 18px;
  }
  .help-block {
    color: red;
  }
</style>
<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Report</li>
      <li class="breadcrumb-item active">New Customer</li>
    </ol>

    <!-- Form Start -->
    <div class="padding-1"></div>
    <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;New Customer</h2>
    <p>Important fields are mentioned in <strong style="color:red;font-size: 18px;">*</strong></p>
    <div class="padding-1"></div>
    <?php echo form_open('admin/customer/insert-customer'); ?>
        <div class="form-row">
          <div class="form-group col-2">
            <label for="first-name">First Name:<sup>*</sup> </label>
              <div class="form-group">
                <input type="text" class="form-control form-control-sm" aria-label="Text input with dropdown button"  name="fname" data-validation="required" autocomplete="off" value="<?php echo set_value('fname'); ?>" required>
              </div>
          </div>
          <div class="form-group col-2">
            <label for="last-name">Last Name:<sup>*</sup></label>
            <input type="text" class="form-control form-control-sm" name="lname" data-validation="required" autocomplete="off" value="<?php echo set_value('lname'); ?>" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-4">
            <label for="Number">Number:<sup>*</sup></label>
            <input type="tel" class="form-control form-control-sm" name="number" data-validation="length" data-validation-length="7-10" data-validation-error-msg="Phone number has to contain Min 7 and Max 10" autocomplete="off" value="<?php echo set_value('number'); ?>" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-4">
            <label for="email">Email: </label>
            <input type="email" class="form-control form-control-sm" name="email" autocomplete="off" value="<?php echo set_value('email'); ?>">
          </div>
        </div>


      <button type="submit" name="button" class="btn btn-primary mt-3" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save Customer</button>
    <?php echo form_close(); ?>


  </div>
</div>
<script type="text/javascript">
// JS Form Validator
$.validate();
</script>
