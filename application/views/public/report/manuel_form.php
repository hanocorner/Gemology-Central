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
      <div class="col-md-6">

        <?php if(validation_errors() !=''): ?>
          <div class="alert alert-danger" role="alert">
            <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; Error(s) Found</strong><br/>
            <?php echo validation_errors();  ?>
          </div>
        <?php endif; ?>
          <?php if(isset($_SESSION['status'])): ?>
            <div class="alert alert-danger" role="alert">
              <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; Error(s) Found</strong><br/>
              <?php echo $_SESSION['status']; ?>
            </div>
          <?php endif; ?>

        <?php echo form_open('authenticating-report'); ?>
          <div class="form-group">
            <label for="report">GCL Report Number</label>
            <input type="text" class="form-control" name="repono" id="repoNo" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="report">GCL Report Weight</label>
            <input type="text" class="form-control" name="weight" id="rWeight" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="report">Security Check</label>
            <?php echo $captcha; ?>

            <input type="text" class="form-control mt-2" id="rep" autocomplete="off">
          </div>

          <input type="submit" value="Verify" class="btn btn-primary mt-2" id="submitRepo">
        <?php echo form_close(); ?>
      </div>

    </div>
  </div>
</section>
<!-- /. Report -->


<div class="py-5"></div>
