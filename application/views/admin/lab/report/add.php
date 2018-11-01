<style media="screen">
  sup {
    color: red;
    font-size: 18px;
  }
  .help-block {
    color: red;
  }
  .alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
  .filter-option{
    border: 1px solid #cecece;
    border-radius: .25em;
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

    <!-- Page Title  -->
    <div class="d-flex align-items-center">
      <h2 class="card-title"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>Add Report</h2>
      <button type="submit" name="submit" class="btn btn-primary position-fixed" style="right:15px;">
        <i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>Save Report
      </button>
    </div>
    <p class="card-text">Important fields are mentioned in <strong style="color:red;">*</strong></p>

    <!-- /. Page Title  -->

    <div class="pt-2"></div>
    <!-- Alert Box -->
    <div id="message"></div>
    <!-- /. Alert Box -->

    <form action="#" method="post">
    <div class="form-row"> <!-- Customer data  -->
      <div class="form-group col-3">
        <label for="customer">Select Customer</label>
        <input id="plate" class="form-control form-control-sm"/>
      </div>
      <div class="form-group col-1">
        <div class="pt-4"></div>
        <button type="button" class="btn btn-sm btn-dark " data-toggle="modal" data-target="#customerModal"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Add a Customer</button>
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
        <select class="selectpicker form-control form-control-sm" id="newGem" name="gemid" data-live-search="true">
          <option value="0" selected>Choose...</option>
        </select>
      </div>
      <div class="form-group col-1">
        <div class="pt-4"></div>
        <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#gemModal">
          <i class="fa fa-diamond fa-fw" aria-hidden="true"></i>Add Gemstone
        </button>
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
    <button type="submit" name="submit" class="btn btn-primary mb-3"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save Report</button>

    <?php echo form_close(); ?><!-- End of form  -->

  </div><!-- End of Container fluid -->
</div><!-- End of Content wrapper -->

<!-- Gemstone Modal -->
<div class="modal fade" id="gemModal" tabindex="-1" role="dialog" aria-labelledby="gemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gemModalLabel"><i class="fa fa-diamond" aria-hidden="true"></i>&nbsp; New Gemstone</h5>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeGem"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Close</button>
        <button type="button" class="btn btn-primary" id="saveGem"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save Gemstone</button>
      </div>
    </div>
  </div>
</div>
<!-- /. Gemstone Modal -->

<!-- Customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerModalLabel"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp; New Customer</h5>
      </div>
      <div class="modal-body">
        <div id="message"></div>
        <form method="post" action="#">
          <div class="form-row">
            <div class="form-group col-6">
              <label for="first-Name">First Name<sup>*</sup></label>
              <input type="text" class="form-control form-control-sm" id="fName" >
            </div>
            <div class="form-group col-6">
              <label for="last-Name">Lirst Name<sup>*</sup></label>
              <input type="text" class="form-control form-control-sm" id="lName">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12">
              <label for="number">Phone Number<sup>*</sup></label>
              <input type="text" class="form-control form-control-sm" id="number" >
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-12">
              <label for="email">Email</label>
              <input type="email" class="form-control form-control-sm" id="email">
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeGem"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Close</button>
        <button type="button" class="btn btn-primary" id="saveGem"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save Customer</button>
      </div>
    </div>
  </div>
</div>
<!-- /. Customer Modal -->

<!-- Custom Script  -->
<script type="text/javascript">
  var myUpload = new FileUploadWithPreview('myUploader');

  var baseurl = '<?php echo base_url(); ?>';
  var gemtype = $('.selectpicker');
  var reptype = $('#repType');
  var pstatus = $('#pStatus');
  var amount = $("#amount");

  $(document).ready(function() {
    gemstone();
    addGemstone();
    $.fn.selectpicker.Constructor.BootstrapVersion = '4';

    var options = {
    	url: baseurl + "assets/countries.json",
    	getValue: "name",
    	list: {
    		match: {
    			enabled: true
    		},
    		maxNumberOfElements: 8
    	},
    	theme: "plate-dark"
    };

    $("#plate").easyAutocomplete(options);

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
