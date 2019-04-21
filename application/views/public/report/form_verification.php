<section class="report mt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <h1>GCL Online Report Verification</h1>
        <br/>
        <p>
          Please fill in all the fields below exactly as they appear on the document to facilitate authenticating your report. All fields are case sensitive.
          If you encounter any difficulty in authenticating your report, please conatct us
         </p>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-4">
        <div id="alertMsg"></div>
        <?php echo form_open('public/report/form-authentication', array('id'=>'verifyReport')); ?>
        <form action="#" method="post" id="verify" accept-charset="utf-8">
          <div class="form-group">
            <label for="report">GCL Report Number</label>
            <input type="text" class="form-control" name="repono" autocomplete="off" value="<?php set_value('repono'); ?>">
          </div>
          <div class="form-group">
            <label for="report">GCL Report Weight</label>
            <input type="text" class="form-control" name="weight"  autocomplete="off" value="<?php set_value('weight'); ?>">
          </div>
          <div class="form-group">
            <label for="report">Security Check</label>
            <?php echo $captcha; ?>
            <input type="text" class="form-control mt-2" id="captcha" name="captcha" autocomplete="off">
          </div>

          <button type="submit" class="btn btn-primary mt-2" id="verifyReportBtn">Verify Report</button>
        <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>
<!-- /. Report -->
<div class="py-5"></div>

