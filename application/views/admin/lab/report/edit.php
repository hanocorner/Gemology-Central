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
            <h5 class="card-title"><?php echo $cname; ?></h5>
            <p class="card-text">Customer ID #<?php echo $cid; ?></p>
          </div>
        </div>
      </div>

    </div><!-- End of card Row  -->

    <?php echo form_open_multipart('admin/report/update'); ?>
    <div class="row">
      <div class="col-md-6">
        <div class="form-row">
          <div class="d-block">
            <!-- <label for="Gem">Existing Image</label> -->
            <img src="<?php echo base_url(); ?>assets/admin/images/gem/<?php // echo $result->rep_imagename; ?>" width="250" height="250" class="ml-2 mr-5" alt="Gem Image">
          </div>
          <div class="custom-file-container" data-upload-id="myUploader">
            <label>New Image<sup><strong>*</strong></sup> &nbsp;&nbsp;<a href="javascript:void(0)" class="custom-file-container__image-clear btn btn-outline-danger btn-sm" title="Clear Image"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Remove</a></label>
            <label class="custom-file-container__custom-file" >
              <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
              <input type="file" class="custom-file-container__custom-file__custom-file-input" name="imagegem" accept="*">
              <span class="custom-file-container__custom-file__custom-file-control"></span>
            </label>
            <input type="hidden" name="oldimage" value="<?php // echo $result->rep_imagename; ?>">
            <div class="custom-file-container__image-preview"></div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-4">
            <label for="id">Next #ID</label>
            <input type="text" class="form-control form-control-sm" name="rmid" value="" readonly id="rmid">
          </div>

          <div class="col-4">
            <label for="Gem">Gemstone<sup><strong>*</strong></sup> </label>
            <div class="input-group input-group-sm mb-3">
              <select class="form-control form-control-sm" id="newGem" name="gem-type">
                <option value="0" selected>Choose...</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#gemModal"><i class="fa fa-diamond" aria-hidden="true"></i>&nbsp; New Gem</button>
              </div>
            </div>
          </div>

          <div class="form-group col-4">
            <label for="paymentstatus">Payment Status <sup><strong>*</strong></sup></label>
            <select class="form-control form-control-sm" name="pstatus">
              <option value="default" <?php echo  set_select('pstatus', 'default', TRUE); ?> selected>Choose...</option>
              <option value="1" <?php echo  set_select('pstatus', '1'); ?>>Paid</option>
              <option value="0" <?php echo  set_select('pstatus', '0'); ?>>Unpaid</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="col-4">
            <label for="amount">Amount<sup><strong>*</strong></sup></label>
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-money" aria-hidden="true"></i>&nbsp; LKR</div>
              </div>
              <?php //if(isset($result->mem_amount)): ?>
                <input type="text" class="form-control" name="amount" value="" id="amount">
              <?php //endif; ?>
              <?php //if(isset($result->gsr_amount)): ?>
                <!-- <input type="text" class="form-control" name="amount" value="<?php // echo $result->gsr_amount; ?>"> -->
              <?php //endif; ?>
            </div>
          </div>

          <div class="form-group col-4">
            <label for="object">Object<sup><strong>*</strong></sup> </label>
            <input type="text" class="form-control form-control-sm" name="object" value="<?php // echo $result->rep_object; ?>" autocomplete="off" required>
          </div>

          <div class="form-group col-4">
            <label for="identification">Identification<sup><strong>*</strong></sup></label>
            <input type="text" class="form-control form-control-sm" name="identification"  value="<?php // echo $result->rep_identification; ?>" autocomplete="off" required>
          </div>

        </div>

        <div class="form-row">
          <div class="col-4">
            <label for="Weight">Weight<sup><strong>*</strong></sup></label>
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control form-control-sm" name="weight" value="<?php // echo $result->rep_weight; ?>" autocomplete="off">
              <div class="input-group-append">
                <div class="input-group-text">ct</div>
              </div>
            </div>
          </div>
          <div class="col-4">
            <label for="cut">Cut: </label>
            <input type="text" class="form-control form-control-sm" name="gemcut" value="<?php // echo $result->rep_cut; ?>" autocomplete="off">
          </div>

          <div class="form-group col-4">
            <label for="color">Color: </label>
            <input type="text" class="form-control form-control-sm" name="color" value="<?php // echo $result->rep_color; ?>" autocomplete="off">
          </div>
        </div>

        <div class="form-row">
          <div class="col-4">
            <label for="dimensions">Width:</label>
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control form-control-sm" name="gemWidth" value="<?php // echo $result->rep_gemWidth; ?>" autocomplete="off">
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp; mm</div>
              </div>
            </div>
          </div>

          <div class="col-4">
            <label for="dimensions">Height: </label>
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control form-control-sm" name="gemHeight" value="<?php // echo $result->rep_gemHeight; ?>"  autocomplete="off">
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-long-arrow-up" aria-hidden="true"></i>&nbsp; mm</div>
              </div>
            </div>
          </div>

          <div class="col-4">
            <label for="dimensions">Length:</label>
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control form-control-sm" name="gemLength" value="<?php //echo $result->rep_gemLength; ?>" autocomplete="off">
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-long-arrow-down" aria-hidden="true"></i>&nbsp; mm</div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-4">
            <label for="shape">Shape: </label>
            <input type="text" class="form-control form-control-sm" name="shape" value="<?php // echo $result->rep_shape; ?>" autocomplete="off">
          </div>

          <div class="form-group col-8">
            <label for="comment">Comment: </label>
            <input type="text" class="form-control form-control-sm" name="comment" value="<?php // echo $result->rep_comment; ?>" autocomplete="off">
          </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary my-3"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Update</button>&nbsp;&nbsp;
      </div>

      <div class="col-md-5">
        <div class="alert alert-primary" role="alert">
          <strong><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; Information</strong>
          <ul>
            <li>Image Max Width: 1024 px & Height: 1024 px</li>
            <li>Amount field is decimal(i.e. 650.00)</li>
            <li>If you don't find gem in the gemstone list please add by clicking <strong>New Gem</strong> button</li>
            <li>If you want to print whatever the report immediately, Please click Print button</li>
          </ul>
        </div>

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
  });
</script>
