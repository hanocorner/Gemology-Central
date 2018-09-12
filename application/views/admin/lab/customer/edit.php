<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Report</li>
      <li class="breadcrumb-item">New Report</li>
      <li class="breadcrumb-item active">Edit Customer</li>
    </ol>

    <?php
    if (isset($_SESSION['message']))
    {
    ?>
    <div class="alert alert-<?php echo $_SESSION['status']; ?>">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong><?php echo $_SESSION['status']; ?></strong> <?php echo $_SESSION['message']; ?>
    </div>
    <?php
    }
    ?>

    <div class="row">
      <div class="col-md-4">
        <div class="padding-1"></div>
        <h2>Edit Customer Details</h2>
        <div class="padding-1"></div>
        <form action="<?php echo base_url(); ?>admin/report/update-customer-data" method="post">
            <div class="form-group">
              <label for="first-name">First Name: </label>
              <input type="text" class="form-control" name="fname" value="<?php echo $data->cus_firstname; ?>">
              <span><?php echo form_error(''); ?></span>
            </div>
            <div class="form-group">
              <label for="last-name">Last Name: </label>
              <input type="text" class="form-control" name="lname" value="<?php echo $data->cus_lastname; ?>">
              <span><?php echo form_error(''); ?></span>
            </div>
          <div class="form-group">
            <label for="email">Email: </label>
            <input type="email" class="form-control" name="email" value="<?php echo $data->cus_email; ?>">
            <span><?php echo form_error(''); ?></span>
          </div>
          <div class="form-group">
            <label for="Number">Number: </label>
            <input type="tel" class="form-control" name="number" value="<?php echo $data->cus_number; ?>">
            <span><?php echo form_error(''); ?></span>
          </div>

          <input type="hidden" class="form-control" name="custid" value="<?php echo $data->custid; ?>">
          <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>" />
         <input type="submit" class="btn btn-primary" value="Update">
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
      });
    }, 4000);
  });
</script>
