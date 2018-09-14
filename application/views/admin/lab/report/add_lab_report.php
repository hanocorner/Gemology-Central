<style media="screen">

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

    <div class="card text-white bg-dark mb-3" style="width:20rem;">
      <div class="card-body">
        <h3 class="card-title">Sunil Perera</h3>
        <p class="card-text">Customer ID: #GCLC-1001</p>
        <p class="card-text">Report Type: Memo Card</p>
        <p class="card-text">Report ID: #000001</p>
      </div>
    </div>

    <div class="d-flex my-3">
      <h4>New Lab Report</h4>
    </div>

        <?php echo form_open_multipart('admin/report/insert-gemstone-data'); ?>

        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="object">Object: </label>
            <input type="text" class="form-control form-control-sm" name="object" value="" >
          </div>
          <div class="form-group col-md-2">
            <label for="identification">Identification:</label>
            <input type="text" class="form-control form-control-sm" name="identification"  value="" >
          </div>
        </div>

        <div class="form-row">
          <div class="col-2">
            <label for="Weight">Weight:</label>
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control form-control-sm" name="weight">
              <div class="input-group-append">
                <div class="input-group-text">ct</div>
              </div>
            </div>
          </div>
          <div class="col-2">
            <label for="cut">Cut: </label>
            <input type="text" class="form-control form-control-sm" name="gemcut">
          </div>
        </div>

        <div class="form-row">

          <div class="col-2">
            <label for="dimensions">Width:</label>
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control form-control-sm" name="gemWidth">
              <div class="input-group-append">
                <div class="input-group-text">mm</div>
              </div>
            </div>
          </div>

          <div class="col-1">
            <label for="dimensions">Height: </label>
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control form-control-sm" name="gemHeight">
              <div class="input-group-append">
                <div class="input-group-text">mm</div>
              </div>
            </div>
          </div>

          <div class="col-1">
            <label for="dimensions">Length:</label>
            <div class="input-group input-group-sm mb-3">
              <input type="text" class="form-control form-control-sm" name="gemLength">
              <div class="input-group-append">
                <div class="input-group-text">mm</div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="color">Color: </label>
            <input type="text" class="form-control form-control-sm" name="color">
          </div>

          <div class="form-group col-md-2">
            <label for="shape">shape: </label>
            <input type="text" class="form-control form-control-sm" name="shape">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="comment">Comment: </label>
            <input type="text" class="form-control form-control-sm" name="comment">
          </div>
        </div>

        <div class="form-row ml-0">
          <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save</button>&nbsp;&nbsp;
          <button type="submit" name="print" class="btn btn-sm btn-danger"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</button>
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
