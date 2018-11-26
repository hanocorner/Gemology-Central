<style>
  sup {
    color: red;
    font-size: 18px;
  }
  .help-block {
    color: red;
  }
  .alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
  .alert-success-alt{ border-color: #10BC72;background: #10BC72;color: #fff; }

  .filter-option{
    border: 1px solid #cecece;
    border-radius: .25em;
  }

.image-gem {
  position: relative;
  width: 200px;
  height: 150px;
}
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
}
.image-gem:hover .overlay{
  background: rgba(0, 0, 0, .3);
}
.pos {
  position: absolute;
  top: 4px;
  right: 4px;
  opacity: 0;
}
.image-gem:hover .pos {
  opacity: 1;
}
</style>
<div class="content-wrapper">
  <div class="container">

    <h2>Add Report</h2>

    <div class="pt-2"></div>
    <!-- Alert Box -->
    <div id="message"></div>
    <!-- /. Alert Box -->

    <div class="mt-3">
      <?php echo form_open_multipart('admin/report/handler/insert', array('id'=>'formReport')); ?>
      <div class="form-row"> <!-- Customer data  -->
        <div class="form-group col-12">
          <label for="customer">Select Customer<sup>*</sup></label>
          <div class="ui-widget">
            <input id="customer" autocomplete="off" class="form-control form-control-sm">
            <small class="form-text text-muted">NOTE: You can only select an existing customer</small>
            <input type="hidden" id="customerID" value="">
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="mb-1 mx-1" for="customRadioInline1">Report Type:<sup>*</sup></label>
          <fieldset class="mx-1">
            <label for="radio-1">Memocard</label>
            <input type="radio" name="radio-1" id="radio-1" data-value="memo">
            <label for="radio-2">Certificate</label>
            <input type="radio" name="radio-1" id="radio-2" data-value="repo">
            <label for="radio-3">Verbal</label>
            <input type="radio" name="radio-1" id="radio-3" data-value="verb">
          </fieldset>
          <input type="hidden" name="repotype" id="repotype" value="">
        </div>
        <div class="form-group mx-2">
          <label for="customRadioInline1">Report #ID</label>
          <input type="text" class="form-control form-control-sm " id="id" name="rmid" readonly style="height:34px;">
        </div>
      </div>
      
      <div class="form-row"> <!-- Variety -->
        <div class="form-group col-10">
          <label for="variety">Variety<sup>*</sup></label>
          <div class="ui-widget">
            <input id="newGem" name="gemid" autocomplete="off" class="form-control form-control-sm">
            <input type="hidden" id="gemid" value="">
            <small class="form-text text-muted">NOTE: You can only select an existing variety</small>
            <input type="hidden" name="variety" value="">
          </div>
        </div>
        <div class="form-group col-1">
          <div class="pt-4"></div>
          <button type="button" class="btn btn-sm btn-primary mx-2" data-toggle="modal" data-target="#gemModal">
            <i class="fa fa-diamond fa-fw" aria-hidden="true"></i>Add Gemstone
          </button>
        </div>
      </div>

      <div class="form-row"> <!-- Payment -->
        <div class="col-6">
          <label for="paymentstatus">Amount<sup>*</sup></label>
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-money" aria-hidden="true"></i>LKR</div>
            </div>
            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount in figure" required autocomplete="off">
          </div>
        </div>
        <div class="form-group col-6">
          <label for="paymentstatus">Payment Status</label>
          <select class="form-control form-control-sm" name="paymentstatus">
            <option value="0">Unpaid</option>
            <option value="1">Paid</option>
          </select>
        </div>
      </div>

      <div class="form-row"> <!-- Object  -->
        <div class="form-group col-12">
          <label for="object">Object<sup>*</sup></label>
          <select class="form-control form-control-sm" name="object">
            <option value="default">Choose</option>
            <option>One looose stone</option>
          </select>
        </div>
      </div>

      <!-- <div class="form-row"> <!~~ Variety  ~~>
        <div class="form-group col-12">
          <label for="variety">Variety<sup>*</sup></label>
          <input type="text" class="form-control form-control-sm" name="variety" readonly>
        </div>
      </div> -->

      <div class="form-row"> <!-- Species/Group  -->
        <div class="form-group col-12">
          <label for="species/group">Species/Group<sup>*</sup></label>
          <div class="ui-widget">
            <input type="text" class="form-control form-control-sm" name="spgroup" id="sgField" autocomplete="off">
          </div>
        </div>
      </div>

      <div class="form-row"><!-- Weight  -->
        <div class="col-6">
          <label for="Weight" >Weight<sup>*</sup></label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="weight" autocomplete="off" required>
            <div class="input-group-append">
              <div class="input-group-text">(ct) &nbsp;&nbsp;<i class="fa fa-balance-scale" aria-hidden="true"></i></div>
            </div>
          </div>
        </div>

        <div class="col-2"> <!-- Width  -->
          <label for="dimensions" >Width:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="gemWidth" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">mm</div>
            </div>
          </div>
        </div>

        <div class="col-2"> <!-- Height  -->
          <label for="dimensions">Height:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="gemHeight" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">mm</div>
            </div>
          </div>
        </div>

        <div class="col-2"> <!-- Length  -->
          <label for="dimensions" >Length:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="gemLength" autocomplete="off">
            <div class="input-group-append">
              <div class="input-group-text">mm</div>
            </div>
          </div>
        </div>

      </div>

      <div class="form-row"> <!-- Shape & Cut  -->
        <div class="form-group col-12">
          <label for="shape&cut">Shape & Cut:</label>
          <input type="text" class="form-control form-control-sm" name="shapecut" id="shapecutField" autocomplete="off">
        </div>
      </div>

      <div class="form-row"> <!-- Color  -->
        <div class="form-group col-12">
          <label for="color">Color: </label>
          <input type="text" class="form-control form-control-sm" name="color" id="colorField" autocomplete="off">
        </div>
      </div>

      <div class="form-row"> <!-- Comment  -->
        <div class="form-group col-12">
          <label for="comment">Comment:</label>
          <textarea class="form-control" name="editor1" id="editor1" rows="4" ></textarea>
          <script>
            CKEDITOR.replace('editor1');
          </script>
        </div>
      </div>

      <div class="form-row"> <!-- Other  -->
        <div class="form-group col-12">
          <label for="other">Other</label>
          <textarea class="form-control" name="other" rows="4"></textarea>
        </div>
      </div>

      <div class="form-row align-items-center"> <!-- Gem Image -->
        <div class="col-9">
          <label for="image">Image:</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="imagegem" id="imginput">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
        </div>
        <div class="col-2 mt-4 mx-4">
          <div class="image-gem">
            <img id="imagegem" src="<?php echo base_url('assets/images/default-img.png'); ?>" alt="your image" width="200" height="150"/>
            <div class="overlay"></div>
            <button type="button" class="btn btn-sm btn-danger pos" id="removeImg"><i class="fa fa-times mr-0" aria-hidden="true"></i></button>
          </div>

        </div>
      </div>

      <button type="submit" class="btn btn-success mb-5 addReport"> <!-- Submit Button  -->
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        Submit Report
      </button>

      <?php echo form_close(); ?>
      <!-- End of form  -->
    </div>

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
        <div id="message" class="my-2"></div>
        <?php echo form_open('admin/report/gemstone/add', array('id'=>'formGemstone')); ?>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gemstone Name<sup>*</sup></label>
            <input type="text" class="form-control" id="gemName" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Gemstone Description<sup>*</sup></label>
            <textarea class="form-control"  id="gemDesc" rows="3"></textarea>
          </div>
        <?php echo form_close(); ?><!-- End of form  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" id="closeGem"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
        <button type="button" class="btn btn-primary" id="saveGem"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save Gemstone</button>
      </div>
    </div>
  </div>
</div>
<!-- /. Gemstone Modal -->


<!-- Modal Alert box -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-bell-o" aria-hidden="true"></i>Alert Box</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<!-- Modal -->

<!-- Custom Script  -->
<script>
var baseurl = '<?php echo base_url(); ?>';
</script>
