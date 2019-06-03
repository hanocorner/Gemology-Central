<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Articles</li>
    </ol>

    <!-- /. of Breadcrumbs-->
    <!-- Grid nav -->
    <div class="grid-nav">
            <div class="form-group mb-0">
                <span class="mr-2">Show</span>
                <select id="rowCount" style="width:3rem;">
                    <option selected="selected">10</option>
                    <option>15</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span class="mx-2">entries</span>
            </div>
            
            <a href="#" class="text-primary ml-2" id="reloadTable"><i class="fa fa-refresh fa-fw"
                    aria-hidden="true"></i>
                Refresh</a>
            <input type="text" class="mx-3" id="searchId" autocomplete="off" placeholder="Search by title">

            <a href="/admin/blog/add/" class="btn btn-primary btn-sm ml-auto"><i class="fa fa-plus fa-fw"></i> Add
                Article</a>

        </div>

    <!-- Table -->
    <div id="articleTable"></div>
    <!-- /. of Table -->
    
  </div><!-- /.container-fluid-->
</div><!-- /.content-wrapper-->



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


