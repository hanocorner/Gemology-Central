<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Memo Card</title>

    <style>
      @font-face {
          font-family: 'Times New Roman';
          src: url('<?php echo base_url(); ?>assets/admin/fonts/times/TimesNewRomanPSMT.woff2') format('woff2'),
              url('<?php echo base_url(); ?>assets/admin/fonts/times/TimesNewRomanPSMT.woff') format('woff');
          font-weight: normal;
          font-style: normal;
      }
    </style>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/print/paper.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/print/memocard.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      @page { size: 85.60mm 53.98mm } /* output size */
      body.memocard .sheet { width: 85.60mm; height: 53.98mm } /* sheet size */
      @media print { body.memocard { width: 85.60mm } } /* fix for Chrome */
    </style>

  </head>
  <body class="memocard"  onload="window.print();">
    <section class="sheet">
      <div class="header">
        <div class="flex-wrap justify-content-between" style="margin-bottom:5px;">
          <img src="<?php echo base_url(); ?>assets/admin/images/memocard-gcl-logo.png" alt="GCL Logo" style="margin-left:5px;">
          <img src="<?php echo base_url(); ?>assets/admin/images/memocard-gia-logo.png" alt="GIA Logo">
        </div>
      </div>
      <div class="data flex-wrap">
        <table>
          <tbody>
            <tr>
              <td width="120">No.</td>
              <td width="130"><?php echo $data[0]->memoid; ?></td>
            </tr>
            <tr>
              <td width="100">Date</td>
              <td width="130"><?php echo $data[0]->rep_date; ?></td>
            </tr>
            <tr>
              <td width="100">Object</td>
              <td width="130"><?php echo ucwords($data[0]->rep_object); ?></td>
            </tr>
            <tr>
              <td width="100"><strong>Identification</strong></td>
              <td width="130"><strong><?php echo ucwords($data[0]->rep_identification); ?></strong></td>
            </tr>
            <tr>
              <td width="100">Weight</td>
              <td width="130"><?php echo $data[0]->rep_weight; ?></td>
            </tr>

            <tr>
              <td width="100">Cut</td>
              <td width="130"><?php echo $data[0]->rep_cut; ?></td>
            </tr>

            <tr>
              <td width="100">Dimensions</td>
              <td width="150">
                <?php echo $data[0]->rep_gemWidth.' x '.$data[0]->rep_gemHeight. ' x '. $data[0]->rep_gemLength.' (mm) '; ?>
              </td>
            </tr>

            <tr>
              <td width="100">Shape</td>
              <td width="130"><?php echo $data[0]->rep_shape; ?></td>
            </tr>

            <tr>
              <td width="100">Color</td>
              <td width="130"><?php echo $data[0]->rep_color; ?></td>
            </tr>

            <tr>
              <td width="100"><strong>Comment</strong></td>
              <td width="130"><strong><?php echo ucwords($data[0]->rep_comment); ?></strong></td>
            </tr>

          </tbody>
        </table>
        <div class="img-section">
          <img src="<?php echo base_url(); ?>assets/admin/images/gem/<?php echo $data[0]->rep_imagename; ?>" alt="Gemstone" class="gem-img">
          <img src="<?php echo base_url(); ?>assets/admin/images/qr/<?php echo $qrcode; ?>" alt="QRCode Image" class="qr-code">
        </div>
      </div>
      <div class="footer" style="margin-top:2px;"></div>
    </section>
  <a href="<?php echo base_url(); ?>admin/customer" class="back-btn">Go Back</a>
</body>
</html>
