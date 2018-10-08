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
        <?php if(isset($_SESSION['qrcode'])): ?>
        <img src="<?php echo base_url(); ?>assets/admin/images/qr/<?php echo $qr; ?>" alt="QR" class="img-fluid">
        <?php else: ?>
          <p>No QR Code Available. Please Click the button below.</p>
        <?php endif; ?>
        <div class="buttons">
          <?php if(isset($_SESSION['qrcode'])): ?>
          &nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>admin/report/download-qr" class="btn btn-sm btn-danger"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
          <?php endif; ?>
          <a href="<?php echo base_url(); ?>admin/customer" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right" aria-hidden="true"></i> Go to Customer page</a>
        </div>
      </div>
    </div>
  </div>
</div>
