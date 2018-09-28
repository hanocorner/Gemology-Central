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

    <div class="row my-4"><!-- Card Row  -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">New Report</h5>
            <p class="card-text">Important fields are mentioned in <strong style="color:red;">*</strong></p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-white bg-dark">
          <div class="card-body">
            <h5 class="card-title"><?php echo $cname; ?></h5>
            <p class="card-text">Customer-id #<?php echo $cid; ?></p>
          </div>
        </div>
      </div>

    </div><!-- End of card Row  -->

    <?php echo form_open_multipart('admin/report/add'); ?>
    <!-- Alert Box -->
    <div class="form-group row">
      <div class="col-sm-6">
        <?php if(validation_errors() !=''): ?>
          <div class="alert alert-danger" role="alert">
            <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; Error(s) Found</strong><br/>
            <?php echo validation_errors();  ?>
          </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['status'])): ?>
          <div class="alert alert-danger mt-2" role="alert">
            <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; Error(s) Found</strong><br/>
            <?php echo $_SESSION['status']; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <!-- /. Alert Box -->

    <div class="form-group row">
      <label for="repo-type" class="col-sm-2 col-form-label">Report type<sup>*</sup></label>
      <div class="col-sm-2">
        <select class="form-control form-control-sm" id="repType" name="repo-type">
          <option value="0" selected>Choose...</option>
          <option value="memo">Memo Card</option>
          <option value="repo">Certificate</option>
          <option value="verb">Verbal</option>
        </select>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control form-control-sm" id="id" name="rmid" value="<?php echo set_value('rmid'); ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
      <label for="Gem" class="col-sm-2 col-form-label">Gemstone<sup>*</sup></label>
      <div class="col-sm-4">
        <div class="input-group input-group-sm mb-3">
          <select class="form-control form-control-sm" id="newGem" name="gemid">
            <option value="0" selected>Choose...</option>
          </select>
          <div class="input-group-append">
            <button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#gemModal"><i class="fa fa-diamond" aria-hidden="true"></i>&nbsp; New Gem</button>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="paymentstatus" class="col-sm-2 col-form-label">Payment<sup>*</sup></label>
      <div class="col-sm-2">
        <select class="form-control form-control-sm" name="pstatus">
          <option value="default" <?php echo  set_select('pstatus', 'default', TRUE); ?> selected>Choose...</option>
          <option value="1" <?php echo  set_select('pstatus', '1'); ?>>Paid</option>
          <option value="0" <?php echo  set_select('pstatus', '0'); ?>>Unpaid</option>
        </select>
      </div>
      <div class="col-sm-2">
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-money" aria-hidden="true"></i>&nbsp; LKR</div>
          </div>
          <input type="text" class="form-control" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="Amount in figure" required autocomplete="off">
        </div>
        <small class="form-text text-muted">Amount field is decimal (i.e. 650.00)</small>
      </div>
    </div>

    <div class="form-group row">
      <label for="object" class="col-sm-2 col-form-label">Object<sup>*</sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="object" value="<?php echo set_value('object'); ?>" autocomplete="off" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="identification" class="col-sm-2 col-form-label">Identification Species group<sup>*</sup></label>
      <div class="col-sm-2">
        <input type="text" class="form-control form-control-sm" name="identification"  value="<?php echo set_value('identification'); ?>" autocomplete="off" required>
      </div>
      <div class="col-sm-2">
        <input type="text" class="form-control form-control-sm" name=""  value="<?php echo set_value(''); ?>" autocomplete="off" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="Weight" class="col-sm-2 col-form-label">Weight<sup>*</sup></label>
      <div class="col-sm-4">
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="weight" value="<?php echo set_value('weight'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">ct</div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="cut" class="col-sm-2 col-form-label">Cut:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="gemcut" value="<?php echo set_value('gemcut'); ?>" autocomplete="off">
      </div>
    </div>

    <div class="form-group row">
      <label for="dimensions" class="col-sm-2 col-form-label">Dimensions (W x H  x L):</label>
      <div class="col-sm-1">
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemWidth" value="<?php echo set_value('gemWidth'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>
      <div class="col-sm-1">
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemHeight" value="<?php echo set_value('gemHeight'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>
      <div class="col-sm-1">
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemLength" value="<?php echo set_value('gemLength'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="shape" class="col-sm-2 col-form-label">Shape: </label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="shape" value="<?php echo set_value('shape'); ?>" autocomplete="off">
      </div>
    </div>

    <div class="form-group row">
      <label for="color" class="col-sm-2 col-form-label">Color: </label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="color" value="<?php echo set_value('color'); ?>" autocomplete="off">
      </div>
    </div>

    <div class="form-group row">
      <label for="comment" class="col-sm-2 col-form-label">Comment:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="comment" value="<?php echo set_value('comment'); ?>" autocomplete="off">
      </div>
    </div>

    <div class="form-group row">
      <label for="image" class="col-sm-2 col-form-label">Upload Image:</label>
      <div class="col-sm-4">
        <div class="custom-file-container" data-upload-id="myUploader">
          <label>
            <a href="javascript:void(0)" class="custom-file-container__image-clear btn btn-outline-danger btn-sm" title="Clear Image">
              <i class="fa fa-times" aria-hidden="true"></i>&nbsp; Remove image
            </a>
            <small class="form-text text-muted">Image Max Width: 1024 px & Height: 1024 px</small>
          </label>
          <label class="custom-file-container__custom-file" >
            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="imagegem" accept="*" required>
            <span class="custom-file-container__custom-file__custom-file-control"></span>
          </label>
          <div class="custom-file-container__image-preview"></div>
        </div>

      </div>
    </div>

    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save & Download QR</button>&nbsp;&nbsp;
    <!-- <button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</button> -->

    <div class="mb-4"></div>


    <div class="form-row">
      <div class="col-4">

      </div>
    </div>
    <?php echo form_close(); ?><!-- End of form  -->

  </div><!-- End of Container fluid -->
</div><!-- End of Content wrapper -->

<div class="modal fade" id="gemModal" tabindex="-1" role="dialog" aria-labelledby="gemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gemModalLabel">New Gemstone</h5>
      </div>
      <div class="modal-body">
        <div id="message"></div>
        <div id="gemForm">
          <?php echo form_open(); ?>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Gemstone Name<sup><strong>*</strong></sup></label>
              <input type="text" class="form-control" id="gemName" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Gemstone Description<sup><strong>*</strong></sup></label>
              <input type="text" class="form-control" id="gemDesc" autocomplete="off" required>
            </div>
          <?php echo form_close(); ?><!-- End of form  -->
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeGem">Close</button>
        <button type="button" class="btn btn-primary" id="saveGem">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Custom Script  -->
<script type="text/javascript">
  var myUpload = new FileUploadWithPreview('myUploader');

  var baseurl = '<?php echo base_url(); ?>';
  var gemtype = $('#newGem');
  var reptype = $('#repType');

  $(document).ready(function() {
    gemstone();
    addGemstone();

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
