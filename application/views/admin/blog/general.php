<style>
input[type="search"]::-webkit-search-cancel-button {
  -webkit-appearance: searchfield-cancel-button;
}
</style>
<!-- /. of Style -->

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Blog Articles</li>
    </ol>

    <!-- /. of Breadcrumbs-->

    <!-- Example DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Blog Articles </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" >
            <a href="<?php echo base_url(); ?>admin/blog/add-article" class="btn btn-primary float-right mb-3"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; New Article</a>
            <thead>
              <tr>
                <th>#ID</th>
                <th>Article Title</th>
                <th>Published Date</th>
                <th>Published Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
        <div class="card-footer small text-muted">Last Updated <?php echo !empty($last_update)?$last_update:"" ; ?></div>
    </div>
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

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

<!-- /. Js -->

<?php if (isset($_SESSION['success']))
{
?>
<script type="text/javascript">
  swal("Deletion Successful", "<?php echo $_SESSION['success']; ?>", "success");
</script>
<?php
}
if (isset($_SESSION['error']))
{
?>
<script type="text/javascript">
  swal("Deletion Failed", "<?php echo $_SESSION['error']; ?>", "error");
</script>
<?php
}
?>

  <script type="text/javascript">
      $(document).ready(function(){

        $(document).on('click','.delete', function(){
          var id = $('.delete').data('id');
          $('#delTrue').attr('href', '<?php echo base_url(); ?>admin/blog/delete/'+id);
        });

    var table = $('#dataTable').DataTable({
      "rowCallback": function(row, data){
      	if(data.post_published == 1){
        	$('td:eq(3)', row).css('color', '#4cad24').html('<strong>Online</strong>');
        }
        if(data.post_published == 0){
        	$('td:eq(3)', row).css('color', '#c82333').html('<strong>Offline</strong>');
        }
      },
      "scrollX": true,
		  "pagingType": "first_last_numbers",
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "ajax":{
        url:"<?php echo base_url(); ?>admin/blog/all-articles", // json datasource
        type:"POST"
      },
      "columns": [
        {"data":"postid"},
        {"data":"post_title"},
        {"data":"post_date"},
        {"data":"post_published"},
        {
          "data": function (e) {
            return '<a href="<?php echo base_url(); ?>blog/'+e.post_url+'" class="btn btn-info" target="_blank">' + '<i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Preview' + '</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
                   '<a href="<?php echo base_url(); ?>admin/blog/edit/'+e.post_url+'" class="btn btn-warning" target="_blank">' + '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit' + '</a>&nbsp;&nbsp;&nbsp;&nbsp;'+
                   '<a href="#" data-id="'+e.postid+'" class="btn btn-danger delete"  data-toggle="modal" data-target="#deleteModal">' + '<i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete' + '</a>';
           }
        }
      ]
    });


    });

  </script>
