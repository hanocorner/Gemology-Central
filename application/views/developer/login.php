<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Developer</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>assets/css/sb-admin.min.css" rel="stylesheet">

  <style media="screen">
  .card-login {
    max-width: 25rem;
  }
  .ml-auto, .mx-auto {
    margin-left: auto!important;
  }
  .mr-auto, .mx-auto {
    margin-right: auto!important;
  }
  .mt-5, .my-5 {
    margin-top: 3rem!important;
  }
  </style>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Developer Please Login</div>
      <div class="card-body">
          <form action="<?php echo base_url()?>developer/base/login" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" id="username" type="text" placeholder="Enter username" name="username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" id="password" type="password" placeholder="Password" name="password">
          </div>
          <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>" />
          <button type="submit" class="btn btn-primary"  >Login</button>
        </form>

      </div>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/notify.js"></script>
  <script src="<?php echo base_url();?>assets/js/login.js"></script>
</body>

</html>
