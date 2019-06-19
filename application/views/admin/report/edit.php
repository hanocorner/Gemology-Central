<style>
  sup {
    color: red;
    font-size: 18px;
  }

  .help-block {
    color: red;
  }

  .alert-danger-alt {
    border-color: #B63E5A;
    background: #E26868;
    color: #fff;
  }

  .alert-success-alt {
    border-color: #10BC72;
    background: #10BC72;
    color: #fff;
  }

  .filter-option {
    border: 1px solid #cecece;
    border-radius: .25em;
  }
</style>
<div class="content-wrapper">
  <div class="container">

    <h2>Edit Report</h2>

    <!-- Alert Box -->
    <div id="message"></div>
    <!-- /. Alert Box -->

    <div class="mt-3">
      <?php echo form_open_multipart('admin/report/handler/update', array('id'=>'updateReportForm')); ?>
      <div class="row">
        <div class="col-6">
          <div class="card">

            <div class="card-body">
              <div class="d-flex align-items-center">
                <img src="<?php echo base_url('images/boy.png'); ?>" class="img-fluid" alt="">
                <div class="mx-3">
                  <p class="mb-0 font-weight-bold text-dark">Customer</p>
                  <p class="mb-0 text-muted"><?php echo $results->customer; ?></p>
                  <input type="hidden" value="<?php echo $results->customerid; ?>">
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-6">
          <div class="card">

            <div class="card-body">
              <div class="d-flex align-items-center">
                <img src="<?php echo base_url('images/newspaper.png'); ?>" class="img-fluid" alt="">
                <div class="mx-3">
                  <?php if($results->type == 'verb'): ?>
                  <p class="mb-0 font-weight-bold text-dark">Verbal</p>
                  <?php elseif ($results->type == 'repo'):  ?>
                  <p class="mb-0 font-weight-bold text-dark">Full - Report</p>
                  <?php elseif($results->type == 'memo'):  ?>
                  <p class="mb-0 font-weight-bold text-dark">Memocard</p>
                  <?php endif;?>
                  <input type="hidden" name="repotype" value="<?php echo $results->type; ?>">
                  <p class="mb-0 text-muted"><?php echo $results->reportid; ?></p>
                  <input type="hidden" name="reportno" value="<?php echo $results->reportno; ?>">
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="form-row align-items-center mt-3">
        <!-- Variety -->
        <div class="form-group col-10">
          <label for="variety">Variety<sup>*</sup></label>
          <div class="ui-widget">
            <input type="text" id="newGem" autocomplete="off" class="form-control form-control-sm"
              value="<?php echo $results->variety; ?>">
            <input type="hidden" id="gemid" name="gemid" value="<?php echo $results->gemid; ?>">
          </div>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-sm btn-primary d-block mx-auto px-3 mt-3" data-toggle="modal"
            data-backdrop="static" data-target="#gemModal">
            <i class="fa fa-diamond fa-fw" aria-hidden="true"></i> Add Variety
          </button>
        </div>
      </div>

      <div class="form-row">
        <!-- Payment -->
        <div class="col-6">
          <label for="amount">Amount<sup>*</sup></label>
          <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-money fa-fw mr-2" aria-hidden="true"></i>LKR</div>
            </div>
            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount in figure" required
              autocomplete="off" value="<?php echo $results->amount; ?>">
          </div>
        </div>
        <div class="form-group col-6">
          <label for="paymentstatus">Payment Status</label>
          <select class="form-control form-control-sm" name="payment_status">
            <?php if($results->payment == 'unpaid'): ?>
            <option value="unpaid" selected>Unpaid</option>
            <option value="paid-advance">Paid-Advance</option>
            <option value="paid-full">Paid-Full</option>
            <?php elseif($results->payment == 'paid-advance'): ?>
            <option value="paid-advance" selected>Paid-Advance</option>
            <option value="paid-full">Paid-Full</option>
            <option value="unpaid">Unpaid</option>
            <?php elseif($results->payment == 'paid-full'): ?>
            <option value="paid-full" selected>Paid-Full</option>
            <option value="paid-advance">Paid-Advance</option>
            <option value="unpaid">Unpaid</option>
            <?php endif; ?>
          </select>
        </div>
      </div>

      <div class="form-row">
        <!-- Object  -->
        <div class="form-group col-6">
          <label for="object">Object<sup>*</sup></label>
          <select class="form-control form-control-sm" name="object">
            <option value="One Loose Stone" <?php if($results->object=="One Loose Stone") echo 'selected="selected"'; ?> >One Loose Stone</option>
            <option value="Mounted" <?php if($results->object=="Mounted") echo 'selected="selected"'; ?> >Mounted</option>
            <option value="Rough" <?php if($results->object=="Rough") echo 'selected="selected"'; ?> >Rough</option>
            <option value="Pair" <?php if($results->object=="Pair") echo 'selected="selected"'; ?> >Pair</option>
          </select>
        </div>
        <!-- Species/Group  -->
        <div class="form-group col-6">
          <label for="species/group">Species/Group<sup>*</sup></label>
          <div class="ui-widget">
            <input type="text" class="form-control form-control-sm" name="spgroup" id="sgField" autocomplete="off"
              value="<?php echo $results->spgroup; ?>">
          </div>
        </div>
      </div>

      <div class="form-row">
        <!-- Weight  -->
        <div class="col-6">
          <label for="Weight">Weight<sup>*</sup></label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="weight" autocomplete="off" required
              value="<?php echo $results->weight; ?>">
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
            <input type="text" class="form-control form-control-sm" name="gemWidth" autocomplete="off"
              value="<?php echo $results->gemWidth; ?>">
            <div class="input-group-append">
              <div class="input-group-text">mm</div>
            </div>
          </div>
        </div>

        <div class="col-2">
          <!-- Height  -->
          <label for="dimensions">Height:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="gemHeight" autocomplete="off"
              value="<?php echo $results->gemHeight; ?>">
            <div class="input-group-append">
              <div class="input-group-text">mm</div>
            </div>
          </div>
        </div>

        <div class="col-2">
          <!-- Length  -->
          <label for="dimensions">Length:</label>
          <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm" name="gemLength" autocomplete="off"
              value="<?php echo $results->gemLength; ?>">
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
          <input type="text" class="form-control form-control-sm" name="shapecut" id="shapecutField" autocomplete="off"
            value="<?php echo $results->shapecut; ?>">
        </div>
        <!-- Color  -->
        <div class="form-group col-6">
          <label for="color">Color: </label>
          <input type="text" class="form-control form-control-sm" name="color" id="colorField" autocomplete="off"
            value="<?php echo $results->color; ?>">
        </div>
      </div>

      <div class="form-row align-items-center">
        <!-- Comment  -->
        <div class="form-group col-6">
          <label for="comment">Comment:</label>
          <textarea class="form-control" id="editor1" rows="4"><?php echo $results->comment; ?></textarea>
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
            <textarea class="form-control" name="other" rows="3"><?php echo $results->other; ?></textarea>
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
          <?php if($results->gemstone == ''): ?>
          <img id="imagegem" src="<?php echo base_url('images/target.png'); ?>" alt="Image"
            class="img-fluid img-thumbnail d-block mx-auto" />
          <input type="hidden" name="imgpath" id="imgPath" value="">
          <input type="hidden" name="imgname" id="imgName" value="">
          <?php else: ?>
          <img id="imagegem" src="<?php echo base_url('images/gem/'.$results->path.$results->gemstone); ?>" alt="Image"
            class="img-fluid img-thumbnail d-block mx-auto" />
          <input type="hidden" name="imgpath" id="imgPath" value="<?php echo $results->path; ?>">
          <input type="hidden" name="imgname" id="imgName" value="<?php echo $results->gemstone; ?>">
          <?php endif; ?>
        </div>
      </div>

      <!-- <a href="#" data-action="update" class="btn btn-primary mt-3 mb-5" id="updateReport">
        
        <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>
        Update Report
      </a> -->

      <div class="dropdown show mt-3 mb-5">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          <i class="fa fa-pencil fa-fw"></i> Update
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" data-action="updateRep" href="#">Update Report</a>
          <a class="dropdown-item" data-action="updatePrint" href="#" data-type="<?php echo $rep_type; ?>" data-id="<?php echo $rep_id; ?>">Update and Print</a>

        </div>
      </div>

      <div class="py-5"></div>

      <?php echo form_close(); ?>
      <!-- End of form  -->

    </div>

  </div><!-- End of Container fluid -->
</div><!-- End of Content wrapper -->

<?php echo $variety_modal; ?>

<!-- Custom Script  -->
<script>
  var baseurl = '<?php echo base_url(); ?>';
</script>