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
  .alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
  .alert-warning-alt { border-color: #F3F3EB;background: #E9CEAC;color: #fff; }
  .alert-success-alt { border-color: #19B99A;background: #20A286;color: #fff; }
  .alert-info-alt { border-color: #B4E1E4;background: #81c7e1;color: #fff; }
  .glyphicon { margin-right:10px; }
  </style>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header text-center">Gemology Central Laboratory </div>
      <div class="card-body">
        <!-- Alert box -->
        <div id="messageBox"></div>
        <!-- /. Alert box -->

          <form action="#" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" id="username" type="text" name="username" autocomplete="off">

          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" id="password" type="password"  name="password" autocomplete="off">
          </div>
          <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>" />

          <button type="submit" class="btn btn-primary" id='login'>Login</button>
        </form>

      </div>
    </div>

    <div class="card card-login mx-auto mt-5">
      <div class="card-body">
        Think you came here by mistake? <a href="<?php echo base_url(); ?>">Click here</a> to go to the main website.
      </div>
    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var msgBox = $('#messageBox');
      var csrfToken = $("input[name=csrf_test_name]");

      $(document).on('click', '#login', function(event) {
        event.preventDefault();

        $.ajax({
          url: '<?php echo base_url('admin/home/login'); ?>',
          type: 'POST',
          dataType: 'JSON',
          data: {
            'csrf_test_name': csrfToken.val(),
            username: $('#username').val(),
            password: $('#password').val()
          },
          beforeSend: function () {
            msgBox.html('<div class="alert alert-info-alt" role="alert"><i class="fa fa-spinner fa-spin fa-fw"></i><span class="sr-only">Loading...</span>&nbsp; Authenticating</div>');
          },
          success: function (response) {
            csrfToken.val(response.csrf);
            setTimeout(function () {
              if(!response.auth){
                msgBox.html('<div class="alert alert-danger-alt" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; '+response.message+'</div>');
              }
              if(response.auth){
                msgBox.html('<div class="alert alert-success-alt" role="alert"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp; '+response.message+'</div>');
                window.location.href = response.url;
              }
            }, 1000);
          },
          fail:function() {
            console.log("error");
          }
        });
      });

    });
  </script>
</body>

</html>
