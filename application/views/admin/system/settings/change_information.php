<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Settings</li>
      <li class="breadcrumb-item active">change Information</li>
    </ol>

    <div class="row">
      <div class="col-sm-12">
        <div class="padding-1"></div>
        <h2 class="text-left">Change Information</h2>
        <div class="padding-1"></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <form action="admin/setting/update_information" method="post">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="c-username">
          </div>

          <input type="submit" class="btn btn-primary" value="Save">
        </form>
      </div>
    </div>

  </div>
</div>
