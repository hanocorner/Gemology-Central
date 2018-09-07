<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Settings</li>
      <li class="breadcrumb-item active">change Password</li>
    </ol>

    <div class="row">
      <div class="col-sm-12">
        <div class="padding-1"></div>
        <h2 class="text-left">Change Password</h2>
        <div class="padding-1"></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <form action="admin/setting/update_password" method="post">
          <div class="form-group">
            <label for="current-pass">Current Password</label>
            <input type="text" class="form-control" name="old-pass">
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

          <input type="submit" class="btn btn-primary" value="Save">
        </form>
      </div>
    </div>

  </div>
</div>

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
