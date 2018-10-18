<style media="screen">
  sup {
    color: red;
    font-size: 18px;
  }
  .help-block {
    color: red;
  }
  .alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
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
            <h5 class="card-title"><?php echo $name; ?></h5>
            <p class="card-text">Customer-id #<?php echo $cid; ?></p>
          </div>
        </div>
      </div>

    </div><!-- End of card Row  -->

    <form class="" action="#" method="post">

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

    <div class="form-row"> <!-- Customer data  -->
      <div class="form-group col-3">
        <label for="customer">Select Customer</label>
        <input type="text" class="form-control form-control-sm" id="">
      </div>
      <div class="form-group col-1">
        <label for="customer"></label>
        <button type="button" class="btn btn-sm btn-warning mt-2"><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Add Customer</button>
      </div>
    </div>

    <div class="form-row"> <!-- Report Type  -->
      <div class="form-group col-2">
        <label for="customer">Select your report</label>
        <select class="form-control form-control-sm" id="repType" name="repo-type">
          <option value="0" selected>Choose...</option>
          <option value="memo">Memo Card</option>
          <option value="repo">Certificate</option>
          <option value="verb">Verbal</option>
        </select>
      </div>
      <div class="form-group col-2">
        <label for="customer">Report ID#</label>
        <input type="text" class="form-control form-control-sm" id="id" name="rmid" value="<?php echo set_value('rmid'); ?>" readonly>
      </div>
    </div>

    <div class="form-row"> <!-- Gemstone type  -->
      <div class="form-group col-3">
        <label for="Gem">Gemstone<sup>*</sup></label>
        <select class="form-control form-control-sm" id="newGem" name="gemid">
          <option value="0" selected>Choose...</option>
        </select>
      </div>
      <div class="form-group col-1">
        <label for="customer"></label>
        <button type="button" class="btn btn-sm btn-secondary mt-2" data-toggle="modal" data-target="#gemModal"><i class="fa fa-diamond" aria-hidden="true"></i>&nbsp; Add Gemstone</button>
      </div>
    </div>

    <div class="form-row"> <!-- Payment  -->
      <div class="form-group col-2">
        <label for="paymentstatus">Payment<sup>*</sup></label>
        <select class="form-control form-control-sm" name="pstatus" id="pStatus">
          <option value="default" <?php echo  set_select('pstatus', 'default', TRUE); ?> selected>Choose...</option>
          <option value="1" <?php echo  set_select('pstatus', '1'); ?>>Paid</option>
          <option value="0" <?php echo  set_select('pstatus', '0'); ?>>Unpaid</option>
        </select>
      </div>
      <div class="col-2">
        <label for="paymentstatus">Payment<sup>*</sup></label>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-money" aria-hidden="true"></i>&nbsp; LKR</div>
          </div>
          <input type="text" class="form-control" name="amount" id="amount" value="<?php echo set_value('amount'); ?>" placeholder="Amount in figure" required autocomplete="off">
        </div>
      </div>
    </div>

    <div class="form-row"> <!-- Object  -->
      <div class="form-group col-4">
        <label for="object">Object<sup>*</sup></label>
        <input type="text" class="form-control form-control-sm" name="object" value="<?php echo set_value('object'); ?>" autocomplete="off" required>
      </div>
    </div>

    <div class="form-row align-items-center"> <!-- Variety  -->
      <div class="form-group col-4">
        <label for="variety">Variety<sup>*</sup></label>
        <input type="text" class="form-control form-control-sm" name="variety" value="<?php echo set_value('variety'); ?>" autocomplete="off" style="border: 1px solid #dc3545">
      </div>
      <div class="col-4">
        <small id="passwordHelp" class="text-danger">Must be 8-20 characters long.</small>
      </div>
    </div>

    <div class="form-row"> <!-- Species/Group  -->
      <div class="form-group col-4">
        <label for="species/group">Species/Group<sup>*</sup></label>
        <input type="text" class="form-control form-control-sm" name="spgroup" value="<?php echo set_value('spgroup'); ?>" autocomplete="off" required>
      </div>
    </div>

    <div class="form-row"> <!-- Weight  -->
      <div class="col-1">
        <label for="Weight" >Weight<sup>*</sup></label>
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="weight" value="<?php echo set_value('weight'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">ct</div>
          </div>
        </div>
      </div>
      <div class="col-1"> <!-- Width  -->
        <label for="dimensions" >Width:</label>
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemWidth" value="<?php echo set_value('gemWidth'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>

      <div class="col-1"> <!-- Height  -->
        <label for="dimensions">Height:</label>
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemHeight" value="<?php echo set_value('gemHeight'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>

      <div class="col-1"> <!-- Length  -->
        <label for="dimensions" >Length:</label>
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemLength" value="<?php echo set_value('gemLength'); ?>" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-row"> <!-- Shape & Cut  -->
      <div class="form-group col-4">
        <label for="shape&cut">Shape & Cut:</label>
        <input type="text" class="form-control form-control-sm" name="shapecut" value="<?php echo set_value('shapecut'); ?>" autocomplete="off">
      </div>
    </div>

    <div class="form-row"> <!-- Color  -->
      <div class="form-group col-4">
        <label for="color">Color: </label>
        <input type="text" class="form-control form-control-sm" name="color" value="<?php echo set_value('color'); ?>" autocomplete="off">
      </div>
    </div>

    <div class="form-row"> <!-- Comment  -->
      <div class="form-group col-4">
        <label for="comment">Comment:</label>
        <input type="text" class="form-control form-control-sm" name="comment" value="<?php echo set_value('comment'); ?>" autocomplete="off">
      </div>
    </div>

    <div class="form-row"> <!-- Other  -->
      <div class="form-group col-4">
        <label for="other">Other</label>
        <input type="text" class="form-control form-control-sm" name="other" value="<?php echo set_value('other'); ?>" autocomplete="off">
      </div>
    </div>

    <div class="form-row">

      <div class="col-4">
        <label for="image">Upload Image:</label>
        <div class="custom-file-container" data-upload-id="myUploader">
          <label>
            <a href="javascript:void(0)" class="custom-file-container__image-clear btn btn-outline-danger btn-sm" title="Clear Image">
              <i class="fa fa-times" aria-hidden="true"></i>&nbsp; Remove image
            </a>
            <small class="form-text text-muted">Image Max Width: 1024 px & Height: 1024 px</small>
          </label>
          <label class="custom-file-container__custom-file" >
            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="imagegem" accept="*">
            <span class="custom-file-container__custom-file__custom-file-control"></span>
          </label>
          <div class="custom-file-container__image-preview"></div>
        </div>

      </div>
    </div>

    <!-- <button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</button> -->
    <button type="submit" name="submit" class="btn btn-sm btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save & Download QR</button>&nbsp;&nbsp;

    <div class="form-group row mb-4">
      <div class="col-2"></div>
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
  var pstatus = $('#pStatus');
  var amount = $("#amount");

  $(document).ready(function() {
    gemstone();
    addGemstone();

    reptype.change(function () {
      if (this.selectedIndex == 0) {
        $('#id').val('');
        pstatus.removeAttr('disabled');
        amount.removeAttr('disabled');
      }
      if (this.selectedIndex == 1) {
        ajax('memo');
        pstatus.removeAttr('disabled');
        amount.removeAttr('disabled');
      }
      if (this.selectedIndex == 2) {
        ajax('repo');
        pstatus.removeAttr('disabled');
        amount.removeAttr('disabled');
      }
      if (this.selectedIndex == 3) {
        ajax('verb');
        pstatus.attr('disabled', 'disabled');
        amount.attr('disabled', 'disabled');
      }
    });

  });
</script>
