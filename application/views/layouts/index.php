<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Google Tag Manager -->
  <script>
    (function (w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-WWDLS4L');
  </script>
  <!-- End Google Tag Manager -->

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <?php if($this->layout->seo_tags): ?>
  <meta name="description" content="<?php echo $this->layout->description; ?>">
  <meta name="keywords" content="<?php echo $this->layout->keywords; ?>">
  <meta name="robots" content="<?php echo $this->layout->robots; ?>" />
  <meta name="author" content="<?php echo $this->layout->author; ?>">
  <?php endif; ?>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Layout Title -->
  <title><?php echo $this->layout->title; ?></title>

  <link rel="canonical" href="<?php echo $this->layout->canonical; ?>" />
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
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WWDLS4L" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
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