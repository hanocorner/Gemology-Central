<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Adminstrator</title>

  <!-- Custom css with bootstrap and template css -->
  <link href="<?php echo base_url();?>assets/admin/css/main.css" rel="stylesheet">

  <!-- Custom Css for admin page -->
  <style media="screen">
  .card-login{max-width:25rem}.card-header{font-size:18px;font-weight:500}.ml-auto,.mx-auto{margin-left:auto!important}.mr-auto,.mx-auto{margin-right:auto!important}.mt-5,.my-5{margin-top:3rem!important}.alert{margin:10px 0}.btn{width:100%}
  </style>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header text-center">Gemology Central Laboratory </div>
      <div class="card-body">
        <!-- Alert box -->
        <?php
        if (isset($_SESSION['message']))
        {
        ?>
        <div class="alert alert-<?php echo $_SESSION['status']; ?>">
          <?php echo $_SESSION['message']; ?>
        </div>
        <?php
        }
        ?>
        <!-- /. Alert box -->

          <form action="<?php echo base_url();?>admin/home/login" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" id="username" type="text" name="username" autocomplete="off">

          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" id="password" type="password"  name="password" autocomplete="off">
          </div>
          <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>" />

          <button type="submit" class="btn btn-primary" >Login</button>

        </form>

      </div>
    </div>

    <div class="card card-login mx-auto mt-5">
      <div class="card-body">
        Think you came here by mistake? <a href="<?php echo base_url(); ?>base">Click here</a> to go to the main website.
      </div>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>
