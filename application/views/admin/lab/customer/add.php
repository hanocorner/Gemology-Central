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
    <div class="row">
      <div class="col-md-4">
        <div class="padding-1"></div>
        <h2>New Customer</h2>
        <p>Important fields are mentioned in <strong style="color:red;font-size: 18px;">*</strong></p>
        <div class="padding-1"></div>
        <?php echo form_open('admin/customer/insert-customer'); ?>
            <div class="form-group">
              <label for="first-name">First Name:<sup><strong>*</strong></sup> </label>
                <div class="form-group">
                  <input type="text" class="form-control" aria-label="Text input with dropdown button"  name="fname" data-validation="required" autocomplete="off" value="<?php echo set_value('fname'); ?>" required>
                  <span style="color:red;"><?php echo form_error('fname'); ?></span>
                </div>
            </div>
            <div class="form-group">
              <label for="last-name">Last Name:<sup><strong>*</strong></sup></label>
              <input type="text" class="form-control" name="lname" data-validation="required" autocomplete="off" value="<?php echo set_value('lname'); ?>" required>
            </div>
            <div class="form-group">
              <label for="Number">Number:<sup><strong>*</strong></sup> </label>
              <input type="tel" class="form-control" name="number" data-validation="length" data-validation-length="7-10" data-validation-error-msg="Phone number has to contain Min 7 and Max 10" autocomplete="off" value="<?php echo set_value('number'); ?>" required>
              <span style="color:red;"><?php echo form_error('number'); ?></span>
            </div>
          <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" class="form-control" name="email" data-validation="email" autocomplete="off" value="<?php echo set_value('email'); ?>">
            <span><?php echo form_error('email'); ?></span>
          </div>
         <input type="submit" class="btn btn-primary" value="Submit">
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
// JS Form Validator
$.validate();
</script>
