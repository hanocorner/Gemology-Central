<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">My Profile</li>
    </ol>
    <!-- /. of Breadcrumbs-->

    <div class="col-md-4 pl-0">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
            <img src="<?php echo base_url(); ?>assets/images/profile-pic.png" alt="Profile image" class="img-fluid">
            <div class="d-block ml-5">
              <h2 id="username"></h2>
              <p class="text-primary">Administrator</p>
            </div>
          </div>
          <div class="alert alert-secondary" ><i class="fa fa-bolt" aria-hidden="true"></i>Latest Activities</div>
          <table class="table ">
            <tbody>
              <tr>
                <th style="border:none;">Current user</th>
                <th class="text-center" style="border:none;">:</th>
                <td style="border:none;" id="cuser"></td>
              </tr>
              <tr>
                <th>Last Login</th>
                <th class="text-center">:</th>
                <td id="lLoginDate"></td>
              </tr>
              <tr>
                <th>User Agent</th>
                <th class="text-center">:</th>
                <td id="userAgent"></td>
              </tr>
              <tr>
                <th>IP Address</th>
                <th class="text-center">:</th>
                <td id="ipAddress"></td>
              </tr>
              <tr>
                <th>Opertaing System</th>
                <th class="text-center">:</th>
                <td id="platform"></td>
              </tr>
              <tr>
                <th>Password</th>
                <th class="text-center">:</th>
                <td>
                  <strong>&#183; &#183; &#183; &#183; &#183; &#183; </strong>&nbsp;&nbsp;
                  <a href="<?php echo base_url();?>admin/system/setting/change-password" title="Change password">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
  </div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->
  <script>
    $(document).ready(function() {
      $.ajax({
        url: '<?php echo base_url('admin/system/dashboard/profile-stats') ?>',
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
          $('#username').html(data.username);
          $('#cuser').html(data.username);
          $('#lLoginDate').html(data.timestamp);
          $('#userAgent').html(data.useragent);
          $('#ipAddress').html(data.ipaddress);
          $('#platform').html(data.platform);
        },
        fail : function () {
          console.log('error');
        }
      });
    });
  </script>
