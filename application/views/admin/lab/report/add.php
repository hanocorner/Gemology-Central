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
      <li class="breadcrumb-item active">Add</li>
    </ol>

    <div class="row mt-4">
      <div class="col-md-4">
        <h2>New Report</h2>
        <p>Important fields are mentioned in <strong style="color:red;font-size: 18px;">*</strong></p>
      </div>
    </div>

    <?php echo form_open_multipart('admin/report'); ?>
    <div class="form-row">
      <div class="form-group col-md-2">
        <label for="">Report Type <sup><strong>*</strong></sup></label>
        <select class="form-control form-control-sm" id="repType" name="repo-type">
          <option selected>Choose...</option>
          <option value="memo">Memo Card</option>
          <option value="repo">Certificate</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <label for="id">Next #ID</label>
        <input type="text" class="form-control form-control-sm" id="id" name="rmid" value="" readonly>
    </div>
  </div>

  <div class="form-row align-items-center">
    <div class="form-group col-md-2">
      <label for="paymentstatus">Payment Status <sup><strong>*</strong></sup></label>
      <select class="form-control form-control-sm" name="pstatus">
        <option value="1">Paid</option>
        <option value="0">Unpaid</option>
      </select>
    </div>
    <div class="col-auto">
        <label class="" for="inlineFormInputGroup">Amount <sup><strong>*</strong></sup></label>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <div class="input-group-text">LKR</div>
          </div>
          <input type="text" class="form-control" name="amount" value="<?php echo set_value('amount'); ?>" required>
        </div>
      </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="gemtype">Gem Type <sup><strong>*</strong></sup></label>
      <select class="form-control form-control-sm" id="newGem" name="gem-type">
        <option selected>Choose...</option>
        <option>New Gem</option>
      </select>
    </div>
    <div class="form-group col-md-2" id="gemName" style='display:none;'>
      <label for="gemname">Gem Name</label>
      <input type="text" class="form-control form-control-sm" name="gem-name" >
  </div>
  <div class="form-group col-md-2" id="gemDes" style='display:none;'>
    <label for="gemname">Gem Decsription</label>
    <input type="text" class="form-control form-control-sm" name="gem-des">
</div>
</div>

<div class="row no-gutters mt-3">
  <div class="col-md-3">
    <div class="custom-file-container" data-upload-id="myUploader">
      <label>Upload Image <sup><strong>*</strong></sup> &nbsp;&nbsp;<a href="javascript:void(0)" class="custom-file-container__image-clear btn btn-sm btn-danger" title="Clear Image"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Remove</a></label>
      <label class="custom-file-container__custom-file" >
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        <input type="file" class="custom-file-container__custom-file__custom-file-input" name="imagegem" accept="*" required>
        <span class="custom-file-container__custom-file__custom-file-control"></span>
      </label>

      <div class="custom-file-container__image-preview"></div>
    </div>
  </div>
</div>

<button type="submit" class="btn btn-primary mb-2">Submit</button>
<?php echo form_close(); ?>

  </div>
</div>

<script type="text/javascript">

  var myUpload = new FileUploadWithPreview('myUploader');

  var baseurl = '<?php echo base_url(); ?>';
  var gemtype = $('#newGem');
  var reptype = $('#repType');

  // JS Form Validator
  $.validate();

  $(document).ready(function() {
    gemstone();

    gemtype.change(function () {
      var display = this.selectedIndex == 1 ? "inline" : "none";
      $('#gemName').css('display', display);
      $('#gemDes').css('display', display);
    });

    reptype.change(function () {
      if (this.selectedIndex == 0) {
        $('#id').val('');
      }
      if (this.selectedIndex == 1) {
        ajax('set-memo-id');
      }
      if (this.selectedIndex == 2) {
        ajax('set-certificate-id');
      }
    });

  });
</script>
