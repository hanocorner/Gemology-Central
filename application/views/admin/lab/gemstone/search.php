<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">
        Search Report
      </li>
    </ol>
    <!-- /. of Breadcrumbs-->

    <!-- Search -->
    <div class="form-row mt-5">
      <div class="col">
        <select class="form-control" id="reportType">
          <option value="default" selected>Choose...</option>
          <option value="memo">Memo Card</option>
          <option value="repo">Certificate</option>
          <option value="verb">Verbal</option>
        </select>
      </div>
      <div class="col">
        <input type="text" class="form-control" placeholder="Search by report no." id="reportNo" autocomplete="off">
      </div>
      <div class="col">
        <input type="text" class="form-control" placeholder="Search by width" id="width" autocomplete="off">
      </div>
      <div class="col">
        <input type="text" class="form-control" placeholder="Search by weight" id="weight" autocomplete="off">
      </div>
      <div class="col">
        <input type="text" class="form-control" placeholder="Search by color" id="color" autocomplete="off">
      </div>
      <div class="col">
        <button type="button" class="btn btn-primary" data-action="search"><i class="fa fa-search" aria-hidden="true"></i>&nbsp; Search</button>
        <button type="button" class="btn btn-info" data-action="refresh"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp; Reset</button>
      </div>
    </div>
    <!-- /. Search -->

    <div class="row">
      <div class="col-md-12">
        <div id="dataTable" class="my-4"></div>
      </div>
    </div>

  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewModalLabel">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table>
          <tbody>
            <tr>
              <td width="120">Number:</td>
              <td id="repNumber" ></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /. Preview Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Report: <strong><span id="reportID"></span> ?</strong>
        <input type="hidden" id="deleteID" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" data-action="delConfirmed">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- /. Delete Modal -->
<script type="text/javascript">
  var baseurl = '<?php echo base_url(); ?>';
  var csrfhash = '<?php echo $csrfhash; ?>';
</script>
<?php if(isset($_SESSION['success'])): ?>
  <script>
    swal("Deletion Successful", "<?php echo $_SESSION['success']; ?>", "success");
  </script>
<?php endif; ?>
<?php if(isset($_SESSION['error'])): ?>
  <script>
    swal("Deletion Failed", "<?php echo $_SESSION['error']; ?>", "error");
  </script>
<?php endif; ?>
