<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if($this->layout->seo_tags): ?> 
    <meta name="description" content="<?php echo $this->layout->description; ?>">
    <meta name="keywords" content="<?php echo $this->layout->keywords; ?>">
    <meta name="robots" content="<?php echo $this->layout->robots; ?>"/>
    <meta name="author" content="<?php echo $this->layout->author; ?>">
    <?php endif; ?> 

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Layout Title -->
    <title><?php echo $this->layout->title; ?></title>
    
    <link rel="canonical" href="<?php echo $this->layout->canonical; ?>"/>
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/favicon.png">

    <!-- Core Css (Bootstrap, FontAwesome & Custom Css) -->
    <?php $this->layout->css(); ?>

    <!-- Core Js files -->
    <?php $this->layout->js('header'); ?>

    <!-- Custom Js script  -->
    <?php $this->layout->custom_script('header'); ?>

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

    <!-- Footer -->
    <?php echo $footer; ?>

    <!-- Core Js Files -->
    <?php $this->layout->js(); ?>

    <!-- Custom Js script  -->
    <?php $this->layout->custom_script('footer'); ?>
  </body>
</html>
