<style>
  sup {
    color: red;
    font-weight: 600;
  }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container">

    <h2>Add Report</h2>

    <!-- Alert Box -->
    <div id="message"></div>
    <!-- /. Alert Box -->

    <div class="mt-2">
      <?php echo form_open_multipart('admin/report/handler/insert', array('id'=>'formAddReport')); ?>

      <div class="form-row">
        <!-- Customer data  -->
        <div class="form-group col-6">
          <label for="customer">Select Customer<sup>*</sup></label>
          <div class="ui-widget">
            <input id="customer" autocomplete="off" class="form-control form-control-sm">
            <input type="hidden" id="customerid" name="customerid" value="">
          </div>
        </div>
        <!-- Payment -->
        <div class="col-3">
          <label for="paymentstatus">Amount<sup>*</sup></label>
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-money fa-fw mr-2" aria-hidden="true"></i>LKR</div>
            </div>
            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount in figure" required
              autocomplete="off">
          </div>
        </div>
        <div class="form-group col-3">
        <label for="paymentstatus">Payment Status</label>
        <input type="text" class="form-control form-control-sm" value="Paid - Full" readonly>
        <input type="hidden" name="payment_status" value="paid-full" readonly>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-3">
          <label for="Repotype">Report type<sup>*</sup></label>
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-sm btn-primary" id="option1" data-value="memo">
              <input type="radio" name="options"> Memocard
            </label>
            <label class="btn btn-sm btn-primary" id="option2" data-value="repo">
              <input type="radio" name="options"> Full Report
            </label>
            <label class="btn btn-sm btn-primary" id="option3" data-value="verb">
              <input type="radio" name="options"> Verbal
            </label>
          </div>
          <input type="hidden" name="repotype" id="repotype" value="">
        </div>
        <div class="form-group col-3">
          <label for="Repotype">Report #ID</label>
          <input type="text" name="reportid" id="repid" class="form-control form-control-sm" aria-describedby="helpId" readonly>
        </div>
        <!-- Object  -->
        <div class="form-group col-6">
          <label for="object">Object<sup>*</sup></label>
          <select class="form-control form-control-sm" name="object">
            <option selected>One Loose Stone</option>
            <option>Mounted</option>
            <option>Rough</option>
            <option>Pair</option>
          </select>
        </div>
      </div>

      <div class="form-row align-items-center">
        <!-- Variety -->
        <div class="form-group col-10">
          <label for="variety">Variety<sup>*</sup></label>
          <div class="ui-widget">
            <input id="newGem" autocomplete="off" class="form-control form-control-sm">
            <input type="hidden" id="gemid" name="gemid" value="">
          </div>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-sm btn-primary mx-2 mt-3 px-2" data-toggle="modal" data-target="#gemModal">
            <i class="fa fa-diamond fa-fw" aria-hidden="true"></i> Add Variety
          </button>
        </div>
      </div>

      <div class="form-row">
        <!-- Species/Group  -->
        <div class="form-group col-12">
          <label for="species/group">Species/Group<sup>*</sup></label>
          <div class="ui-widget">
            <input type="text" class="form-control form-control-sm" name="spgroup" id="sgField" autocomplete="off">
          </div>
        </div>
      </div>

      <div class="form-row">
        <!-- Weight  -->
        <div class="col-6">
          <label for="Weight">Weight<sup>*</sup></label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="weight" autocomplete="off" required>
            <div class="input-group-append">
              <div class="input-group-text">(ct) &nbsp;&nbsp;<i class="fa fa-balance-scale" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-2">
          <!-- Width  -->
          <label for="dimensions">Width:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="gemWidth" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">mm</div>
            </div>
          </div>
        </div>

        <div class="col-2">
          <!-- Height  -->
          <label for="dimensions">Height:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="gemHeight" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">mm</div>
            </div>
          </div>
        </div>

        <div class="col-2">
          <!-- Length  -->
          <label for="dimensions">Length:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="gemLength" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">mm</div>
            </div>
          </div>
        </div>

      </div>

      <div class="form-row">
        <!-- Shape & Cut  -->
        <div class="form-group col-6">
          <label for="shape&cut">Shape & Cut:</label>
          <input type="text" class="form-control form-control-sm" name="shapecut" id="shapecutField" autocomplete="off">
        </div>
        <!-- Color  -->
        <div class="form-group col-6">
          <label for="color">Color: </label>
          <input type="text" class="form-control form-control-sm" name="color" id="colorField" autocomplete="off">
        </div>
      </div>

      <div class="form-row">

      </div>

      <div class="form-row align-items-center">
        <!-- Comment  -->
        <div class="form-group col-6">
          <label for="comment">Comment:</label>
          <textarea class="form-control" id="editor1" rows="4"></textarea>
          <script>
            CKEDITOR.replace('editor1');
          </script>
        </div>

        <div class="col-6">
          <div class="card my-4">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <img src="<?php echo base_url('images/comment.png'); ?>" class="img-fluid" alt="">
                <div class="mx-3">
                  <p class="mb-0 font-weight-bold text-dark">Comment Suggestions</p>
                  <p class="mb-0 text-muted">Indication of Heat treatment</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Private Note  -->
          <div class="form-group">
            <label for="other">Private note</label>
            <textarea class="form-control" name="other" rows="3"></textarea>
          </div>
        </div>
      </div>

      <div class="form-row align-items-center">
        <!-- Gem Image -->
        <div class="col-8">
          <label for="image">Image:</label>
          <div class="target"></div>

        </div>
        <div class="col-4">
          <img id="imagegem" src="<?php echo base_url('images/target.png'); ?>" alt="Image"
            class="img-fluid img-thumbnail d-block mx-auto" />
          <input type="hidden" name="imgpath" id="imgPath" value="">
          <input type="hidden" name="imgname" id="imgName" value="">
        </div>
      </div>

      <a href="#" class="btn btn-primary mb-5 add-report" data-action="addReport">
        <i class="fa fa-floppy-o fa-fw"></i>
        Add Report
      </a>

      <?php echo form_close(); ?>
      <!-- End of form  -->

    </div>

  </div><!-- End of Container fluid -->
</div><!-- End of Content wrapper -->

<?php echo $variety_modal; ?>


<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
      <div class="modal-body">
        <img src="<?php echo base_url('images/trophy.png'); ?>" class="img-fluid d-block mx-auto my-3" alt="Success">
        <p class="text-center font-weight-bold">Report was successfuly created</p>
        <p class="text-center">You can download the QR by clicking the button below or you can create another report or else you can go back to the main page.</p>
        <div class="d-flex align-items-center justify-content-center mt-2">
        <a href="#" class="btn btn-sm btn-danger mx-1" id="qrCodeBtn"><i class="fa fa-download fa-fw"></i> Download</a>
        <a href="javascript:void(0)" onClick="window.location.reload()" class="btn btn-sm btn-primary mx-1"><i class="fa fa-plus fa-fw"></i> Create Another</a>
        <a href="/admin/report/published" class="btn btn-sm btn-dark mx-1"><i class="fa fa-arrow-left fa-fw"></i> Go back</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal Success -->

<!-- Custom Script  -->
<script>
  var baseurl = '<?php echo base_url(); ?>';
</script>