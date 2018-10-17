<div class="content-wrapper">
  <div class="container-fluid">

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Report</li>
      <li class="breadcrumb-item active">Download QR</li>
    </ol>

    <div class="row">
      <div class="col-md-3">
        <img src="<?php echo base_url().$qrwithpath; ?>" alt="QR" class="img-fluid">
        <div class="buttons">
          &nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>admin/report/download/get/<?php echo $qrwithoutpath; ?>" class="btn btn-sm btn-danger"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
          <a href="<?php echo base_url(); ?>admin/customer" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right" aria-hidden="true"></i> Go to Customer page</a>
        </div>
      </div>
    </div>
  </div>
</div>
