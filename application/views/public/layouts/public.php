<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Layout Title -->
    <title><?php echo $title; ?></title>

    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/public/images/favicon.png">
    <!-- Core Css with Bootstrap, FontAwesome & Custom Css -->
    <link href="<?php echo base_url();?>assets/public/css/main.css" rel="stylesheet">

    <!-- Core Js Cdn  -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Core Bootstrap Bundle Js with Popper and Jquery -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Jquery Core ui -->
    <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom Css or Js files -->
    <?php echo $this->layout->print_includes(); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body id="page-top">
    <!-- Header -->
    <?php echo $header; ?>

    <!-- Body Content -->
    <?php echo $content; ?>

    <!-- Footer  -->
    <?php echo $footer; ?>

    <!-- Custom scripts for all pages-->

  </body>
</html>
