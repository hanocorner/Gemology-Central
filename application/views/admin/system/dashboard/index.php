<style media="screen">
  .list-group a:hover{
    text-decoration: none;
  }
  .badge-circle {
    width: 50px;
    height: 34px;
    text-align: center;
    padding: 8px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
  }
</style>
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">My Dashboard</li>
    </ol>
    <!-- /. of Breadcrumbs-->

    <div class="padding-1"></div>

    <div class="row">
      <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
          <div class="card-body">
            <h5 class="card-title"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp; Reports</h5>
            <div class="d-flex justify-content-between">
              <p class="card-text">Total no.of Reports</p>
              <div class="badge-circle badge-danger">2</div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-white bg-dark mb-3">
          <div class="card-body">
            <h5 class="card-title"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; Customers</h5>
            <div class="d-flex justify-content-between">
              <p class="card-text">Total no.of Customers</p>
              <div class="badge-circle badge-danger" id="customer"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
          <div class="card-body">
            <h5 class="card-title"><i class="fa fa-comments" aria-hidden="true"></i>&nbsp; Comments</h5>
            <div class="d-flex justify-content-between">
              <p class="card-text">You have some new comments</p>
              <div class="badge-circle badge-danger">2</div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-white bg-dark mb-3">
          <div class="card-body">
            <h5 class="card-title"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Articles</h5>
            <div class="d-flex justify-content-between">
              <p class="card-text">Total no.of Articles</p>
              <div class="badge-circle badge-danger">2</div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="padding-3"></div>

    </div>
  </div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->
<script>
  $(document).ready(function() {
    stats();
    setInterval(function() {
      stats();
    }, 60 * 1000);
  });
  function stats() {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/system/dashboard/dashboard-stats',
      type: 'GET',
      dataType: 'JSON',
      success:function (response) {
        $('#customer').html(response.totalcustomers);
      },
      fail:function () {
        console.log('error');
      }
    });
  }
</script>
