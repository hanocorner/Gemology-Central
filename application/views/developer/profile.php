<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Developer Dashboard</li>
    </ol>

    <?php
    if(isset($_SESSION['message'])){
      echo '<script language="javascript">';
      echo 'alert("'.$_SESSION['message'].'")';
      echo '</script>';
    }

    ?>
    <!-- /. of Breadcrumbs-->

    <div class="row">
      <div class="col-md-12">
        <a href="#" class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#username">
          <i class="fa fa-fw fa-user"></i>&nbsp;&nbsp; Change Administrator Username
        </a>
        &nbsp;&nbsp;
        <a href="#" class="btn btn-warning btn-lg" role="button" data-toggle="modal" data-target="#password">
          <i class="fa fa-fw fa-lock"></i>&nbsp;&nbsp; Change Administrator Password
        </a>
      </div>
    </div>

  <!-- Username Modal -->
  <div class="modal fade" id="username" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Username</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="profile/change-username" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="c-username" value="<?php echo $c_username; ?>">
            </div>
            <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>" />
            <input type="submit" class="btn btn-primary" value="Save">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /. Username Modal -->

  <!-- Username Modal -->
  <div class="modal fade" id="password" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="profile/change-password" method="post">
            <div class="form-group">
              <label for="current-pass">Current Password</label>
              <input type="text" class="form-control" name="old-pass" value="<?php echo $c_passwowrd; ?>" disabled>
            </div>

            <div class="form-group">
              <label for="new-pass">New Password</label>
              <input type="password" class="form-control" name="new-pass" id="new-pass">
            </div>

            <div class="form-group">
              <label for="Confrim-pass">Confirm Password</label>
              <input type="password" class="form-control" name="con-pass" id="con-pass">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" onclick="showPassword()">&nbsp; Show Password</label>
            </div>
            <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>" />
            <input type="submit" class="btn btn-primary" value="Save">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /. Username Modal -->

    </div>
  </div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->

  <script>
    function showPassword() {
        var x = document.getElementById("new-pass");
        var y = document.getElementById("con-pass");
        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
</script>
