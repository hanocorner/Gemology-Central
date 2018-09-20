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
      <div class="col-md-3">
        <form action="<?php echo base_url(); ?>report-verification" method="post">
          <div class="form-group">
            <label for="report">GCL Report Number</label>
            <input type="text" class="form-control" id="repno" name="repno" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="report">GCL Report Date</label>
            <input type="date" class="form-control" id="re" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="report">Security Check</label>
            <?php echo $captcha; ?>

            <input type="text" class="form-control mt-2" id="rep" autocomplete="off">
          </div>
          <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>" />
          <input type="submit" value="Verify" class="btn btn-primary mt-2">
        </form>
      </div>

    </div>
  </div>
</section>
<!-- /. Report -->

<!--  -->
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col col-lg-2">

    </div>
  </div>
</div>
<!-- /. -->

<div class="py-5"></div>

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#submit', function(event) {
      event.preventDefault();
      var repno = $('#repno').val();

      if (repno == '') {
        alert('Please Enter your Certificate number');
      }

    });
  });
</script>
