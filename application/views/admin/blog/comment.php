<style>
input[type="search"]::-webkit-search-cancel-button {
  -webkit-appearance: searchfield-cancel-button;
}
td.details-control {
    background: url('<?php echo base_url(); ?>assets/admin/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url(); ?>assets/admin/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Blog</li>
      <li class="breadcrumb-item active">Comments</li>
    </ol>
    <!-- /. of Breadcrumbs-->

    <!-- Comment DataTable -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Blog Comments
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered" id="commentTable" width="100%" >
            <thead>
              <tr>
                <th></th>
                <th>#ID</th>
                <th>Comment</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
        <div class="card-footer small text-muted">Last Updated <?php echo !empty($last_update)?$last_update:"" ; ?></div>
    </div>
    <!-- /. Comment DataTable -->

  </div>
</div>

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
        <p>Are sure you want to delete this post ?</p>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="delTrue">Yes</a>
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['success']))
{
?>
<script type="text/javascript">
  swal("Task Successful", "<?php echo $_SESSION['success']; ?>", "success");
</script>
<?php
}
if (isset($_SESSION['error']))
{
?>
<script type="text/javascript">
  swal("Task Failed", "<?php echo $_SESSION['error']; ?>", "error");
</script>
<?php
}
?>

<script type="text/javascript">
  $(document).ready(function() {
    comments("<?php echo base_url(); ?>");

    $(document).on('click','#cmntAccept', function(){
      var id = $('#cmntAccept').data('id');
      var status = $('#cmntAccept').data('status');
      $('#cmntAccept').attr('href', '<?php echo base_url(); ?>admin/comment/status/'+id+'/'+status);
    });

    $(document).on('click','.delete', function(){
      var id = $('.delete').data('id');
      $('#delTrue').attr('href', '<?php echo base_url(); ?>admin/comment/delete/'+id);
    });

  });
</script>
