<style media="screen">
  #image-preview {
    width: 220px;
    height: 150px;
  }
</style>
<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Report</li>
      <li class="breadcrumb-item active">Gemstone</li>
    </ol>
      <?php
        echo form_open_multipart('admin/report/insert-gemstone-data', '', $hidden);
      ?>
          <div class="padding-1"></div>
          <div class="row">
            <div class="col-md-6">
              <h2>Gem Details</h2>
            </div>

          </div>
          <div class="padding-1"></div>
          <div class="row">
          <!-- First Column  -->
          <div class="col-md-6">
              <div class="form-group">
                <label for="gem-no">Gem No: </label>
                <input type="text" class="form-control" value="<?php //echo $gemid; ?>" disabled>
              </div>
              <div class="form-group">
                <label for="certificate-type"></label>
                <select class="custom-select" name="cert-type">
                  <option value="verbal" selected>Verbal</option>
                  <option value="memo-card">Memo Card</option>
                  <option value="cert-report">Certificate Report</option>
                </select>
              </div>
              <div class="form-group">
                <label for="object">Object: </label>
                <input type="text" class="form-control" name="object" placeholder="Ex: One faceted">
              </div>
            <div class="form-group">
              <label for="identification">Identification: </label>
              <input type="text" class="form-control" name="identification" placeholder="Ex: Diffusion Treated..">
            </div>
            <div class="form-group">
              <label for="gem-img">Gem Image*</label>
              <div id="image-preview" style="background-image: url(<?php echo base_url().'assets/admin/images/no-image.png';?>);">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload"/>
                <span style="color: #000000"></span>
              </div>
            </div>

          </div>

          <!-- Second Column  -->
          <div class="col-md-6">
            <div style="display:flex;">
              <div class="col-sm-9" style="padding-left:0;">
                <div class="form-group">
                  <label for="Weight">Weight: </label>
                  <input type="text" class="form-control" name="weight">
                </div>
              </div>
              <div class="col-sm-3" style="padding-right:0;">
                <div class="form-group">
                  <label for="dimensions">Unit: </label>
                  <input type="text" class="form-control" value="ct" disabled>
                </div>
              </div>
            </div>
            <div style="display:flex;">
              <div class="col-sm-3" style="padding-left:0;">
                <div class="form-group">
                  <label for="dimensions">Width: </label>
                  <input type="text" class="form-control" name="gemWidth">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="dimensions">Height: </label>
                  <input type="text" class="form-control" name="gemHeight">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="dimensions">Length: </label>
                  <input type="text" class="form-control" name="gemLength" >
                </div>
              </div>
              <div class="col-sm-3" style="padding-right:0;">
                <div class="form-group">
                  <label for="dimensions">Unit: </label>
                  <input type="text" class="form-control" value="mm" disabled>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="cut">Cut: </label>
              <input type="text" class="form-control" name="gemcut" placeholder="modification">
            </div>
            <div class="form-group">
              <label for="shape">shape: </label>
              <input type="text" class="form-control" name="shape" placeholder="Ex: Oval">
            </div>
          <div class="form-group">
            <label for="color">Color: </label>
            <input type="text" class="form-control" name="color" placeholder="Ex: blue">
            <span><?php echo form_error(''); ?></span>
          </div>

          <div class="form-group">
            <label for="comment">Comment: </label>
            <textarea name="comment"  class="form-control"  rows="8" cols="100"></textarea>
            <span><?php echo form_error(''); ?></span>
          </div>

          </div>
          <div class="col-md-6">
            <div class="padding-1"></div>
            <input type="submit" class="btn btn-primary" value="Submit Report">
            <div class="padding-1"></div>
          </div>

       </div>

       </div>
      <?php echo form_close(); ?>
  </div>
</div>

<?php
if (isset($_SESSION['message']))
{
  if (isset($_SESSION['cerno']))
  {
?>
<!--  preview modal-->
  <div class="modal fade" id="success" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4>Print Memo Card</h4>
              </div>
              <div class="modal-body">
                <div class="alert alert-<?php echo $_SESSION['status']; ?>">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php echo $_SESSION['message']; ?>
                </div>
                <br>
                Press <strong>Print</strong> button to print or <strong>Close</strong> button to ignore
              </div>
              <div class="modal-footer">
                <a href="<?php echo base_url(); ?>admin/report/print-preview/memo-card/<?php echo $_SESSION['cerno']; ?>" class="btn btn-sm btn-primary">&nbsp;Print&nbsp;</a>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-label="Close">Close</button>
              </div>
          </div>
      </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#success').modal('show');
    });
  </script>
<?php
  }
}
?>

<script type="text/javascript">

</script>
