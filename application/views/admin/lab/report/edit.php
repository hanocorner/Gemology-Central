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
            <h5 class="card-title">Edit Report</h5>
            <p class="card-text">Important fields are mentioned in <strong style="color:red;">*</strong></p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-white bg-dark">
          <div class="card-body">
            <h5 class="card-title" id="custName"></h5>
            <p class="card-text">Customer ID #<span id="custId"></span></p>
          </div>
        </div>
      </div>

    </div><!-- End of card Row  -->

    <form action="#" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <input type="hidden" name="" value=""  id="csrfToken">
    <input type="hidden" name="labrepid" id="labRepid" value="<?php echo $id; ?>">
    <input type="hidden" name="report_type" id="reptype" value="">

    <!-- Alert Box -->
    <div class="form-group row">
      <div class="col-sm-6">
        <div id="alertMsg"></div>
      </div>
    </div>
    <!-- /. Alert Box -->

    <div class="form-group row">
      <div class="col-sm-2">
        <img src="" width="250" height="250" class="ml-2 mr-5" alt="Gem Image" id="imgGem">
      </div>
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
            <input type="file" class="custom-file-container__custom-file__custom-file-input" name="imagegem" accept="*">
            <span class="custom-file-container__custom-file__custom-file-control"></span>
          </label>
          <div class="custom-file-container__image-preview"></div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="repo-type" class="col-sm-2 col-form-label">Report</label>
      <div class="col-sm-2">
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <div class="input-group-text">No.</div>
          </div>
          <input type="text" class="form-control form-control-sm" id="rmid" name="rmid" value="" readonly>
        </div>

      </div>
      <div class="col-sm-2">
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <div class="input-group-text">Type.</div>
          </div>
          <input type="text" class="form-control form-control-sm" id="reportType" value="" readonly>
        </div>

      </div>
    </div>

    <div class="form-group row">
      <label for="Gem" class="col-sm-2 col-form-label">Gemstone<sup>*</sup></label>
      <div class="col-sm-3">
        <select class="form-control form-control-sm" id="newGem" name="gemid">
          <option value="default" selected>Choose...</option>
        </select>
      </div>
      <div class="col-sm-2">
        <button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#gemModal"><i class="fa fa-diamond" aria-hidden="true"></i>&nbsp; Add gem</button>
      </div>
    </div>

    <div class="form-group row">
      <label for="paymentstatus" class="col-sm-2 col-form-label">Payment<sup>*</sup></label>
      <div class="col-sm-2">
        <select class="form-control form-control-sm" name="pstatus" id="pstatus">
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
          <input type="text" class="form-control" name="amount" id="amount" value="<?php echo set_value('amount'); ?>" placeholder="Amount in figure" required autocomplete="off">
        </div>
        <small class="form-text text-muted">Amount field is decimal (i.e. 650.00)</small>
      </div>

    </div>

    <div class="form-group row">
      <label for="object" class="col-sm-2 col-form-label">Object<sup>*</sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="object" value="<?php echo set_value('object'); ?>" autocomplete="off" required id="object">
      </div>
    </div>

    <div class="form-group row">
      <label for="variety" class="col-sm-2 col-form-label">Variety<sup>*</sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="variety" value="<?php echo set_value('variety'); ?>" autocomplete="off" required id="variety">
      </div>
    </div>

    <div class="form-group row">
      <label for="species/group" class="col-sm-2 col-form-label">Species/Group<sup>*</sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="spgroup" value="<?php echo set_value('spgroup'); ?>" autocomplete="off" required id="spgroup">
      </div>
    </div>

    <div class="form-group row">
      <label for="Weight" class="col-sm-2 col-form-label">Weight<sup>*</sup></label>
      <div class="col-sm-4">
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="weight" value="<?php echo set_value('weight'); ?>" autocomplete="off" id="weight">
          <div class="input-group-append">
            <div class="input-group-text">ct</div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="dimensions" class="col-sm-2 col-form-label">Dimensions (W x H  x L):</label>
      <div class="col-2">
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemWidth" value="<?php echo set_value('gemWidth'); ?>" autocomplete="off" id="width">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>
      <div class="col-sm-1">
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemHeight" value="<?php echo set_value('gemHeight'); ?>" autocomplete="off" id="height">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>
      <div class="col-sm-1">
        <div class="input-group input-group-sm mb-3">
          <input type="text" class="form-control form-control-sm" name="gemLength" value="<?php echo set_value('gemLength'); ?>" autocomplete="off" id="length">
          <div class="input-group-append">
            <div class="input-group-text">mm</div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="shape&cut" class="col-sm-2 col-form-label">Shape & Cut:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="shapecut" value="<?php echo set_value('shapecut'); ?>" autocomplete="off" id="shapecut">
      </div>
    </div>

    <div class="form-group row">
      <label for="color" class="col-sm-2 col-form-label">Color: </label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="color" value="<?php echo set_value('color'); ?>" autocomplete="off" id="color">
      </div>
    </div>

    <div class="form-group row">
      <label for="comment" class="col-sm-2 col-form-label">Comment:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="comment" value="<?php echo set_value('comment'); ?>" autocomplete="off" id="comment">
      </div>
    </div>

    <div class="form-group row">
      <label for="other" class="col-sm-2 col-form-label">Other</label>
      <div class="col-sm-4">
        <input type="text" class="form-control form-control-sm" name="other" value="<?php echo set_value('other'); ?>" autocomplete="off" id="other">
      </div>
    </div>

    <!-- <button type="submit" name="print" class="btn btn-danger"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</button> -->

    <div class="form-group row mb-4">
      <div class="col-2"></div>
      <div class="col-4">
        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Update</button>&nbsp;&nbsp;
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

  $(document).ready(function() {
    gemstone();
    addGemstone();
    append_toedit();
    create_csrf();
    update();
  });
</script>
