<!-- Gemstone Modal -->
<div class="modal fade" id="gemModal" tabindex="-1" role="dialog" aria-labelledby="gemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gemModalLabel"><i class="fa fa-diamond" aria-hidden="true"></i>&nbsp; New Variety
        </h5>
      </div>
      <div class="modal-body">

        <?php echo form_open('admin/report/gemstone/add', array('id'=>'formVariety')); ?>
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Gemstone Name<sup>*</sup></label>
          <input type="text" class="form-control form-control-sm" id="gemName" name="name" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="message-text" class="col-form-label">Gemstone Description</label>
          <textarea class="form-control" id="gemDesc" name="description" rows="2"></textarea>
        </div>
        <?php echo form_close(); ?>
        <!-- End of form  -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal" id="closeGem">Close</button>
        <a href="#" class="btn btn-primary" id="saveGem" data-action="saveGemstone">Save Variety</a>
      </div>
    </div>
  </div>
</div>
<!-- /. Gemstone Modal -->