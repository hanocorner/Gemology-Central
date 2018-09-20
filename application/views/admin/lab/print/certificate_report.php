<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Gemstone Report</title>

    <style>
      @font-face {
          font-family: 'Times New Roman';
          src: url('<?php echo base_url(); ?>assets/admin/fonts/times/TimesNewRomanPSMT.woff2') format('woff2'),
              url('<?php echo base_url(); ?>assets/admin/fonts/times/TimesNewRomanPSMT.woff') format('woff');
          font-weight: normal;
          font-style: normal;
      }
      .back-btn{
        width: 150px;
        display: block;
        margin: auto;
        background-color: rgb(46,101,204);
        color: #fff;
        padding: 5px;
        text-decoration: none;
        text-align: center;
        border: 1px solid rgb(46,101,204);
        border-radius: 5px;
      }
      .back-btn:hover{
        text-decoration: none;
      }
    </style>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/print/paper.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/print/report.print.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>@page { size: A4 landscape }</style>

  </head>
  <body class="A4 landscape" onload="window.print();">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
    <div class="flex-wrap">
      <div class="box box-1">
        <div class="logo">
          <img src="<?php echo base_url(); ?>assets/admin/images/gcl-logo.png" alt="GCL Logo">
        </div>
        <h1>Gemstone Report</h1>
        <table>
          <tbody>
            <tr>
              <td width="120">No.</td>
              <td width="350"><?php echo $data[0]->gsrid; ?></td>
            </tr>
            <tr>
              <td width="100">Date</td>
              <td width="350"><?php echo $data[0]->rep_date; ?></td>
            </tr>
            <tr>
              <td width="100">Object</td>
              <td width="350"><?php echo $data[0]->rep_object; ?></td>
            </tr>
            <tr>
              <td width="100"><strong>Identification</strong></td>
              <td width="350"><strong><?php echo $data[0]->rep_identification; ?></strong></td>
            </tr>
            <tr>
              <td width="100">Weight</td>
              <td width="350"><?php echo $data[0]->rep_weight; ?></td>
            </tr>

            <tr>
              <td width="100">Cut</td>
              <td width="350"><?php echo $data[0]->rep_cut; ?></td>
            </tr>

            <tr>
              <td width="100">Dimensions</td>
              <td width="350">
                <?php echo $data[0]->rep_gemWidth.' x '.$data[0]->rep_gemHeight. ' x '. $data[0]->rep_gemLength.' (mm) '; ?>
              </td>
            </tr>

            <tr>
              <td width="100">Shape</td>
              <td width="350"><?php echo $data[0]->rep_shape; ?></td>
            </tr>

            <tr>
              <td width="100">Color</td>
              <td width="350"><?php echo $data[0]->rep_color; ?></td>
            </tr>

            <tr>
              <td width="100"><strong>Comment</strong></td>
              <td width="350"><strong><?php echo $data[0]->rep_comment; ?></strong></td>
            </tr>

          </tbody>
        </table>
      </div>
      <div class="watermark">
        <img src="<?php echo base_url(); ?>assets/admin/images/gcl-watermark.png" alt="GCL watermark" width="100px" height="100px">
      </div>
      <div class="box box-2">
        <div style="text-align:center;">
          <div class="gem">
            <?php
                $image = $data[0]->rep_imagename;
                if(isset($image))
                {
                ?>
                <img src="<?php echo base_url(); ?>assets/admin/images/gem/<?php echo $image; ?>" alt="Gemstone" width="120px" height="120px">
                <?php
                }
                ?>
          </div>
          <div class="padding-2"></div>
          <div class="padding-4"></div>
          <div class="signature">
            <hr class="hr">
            <h4>Arjuna. K. Jayaweera GG</h4>
          </div>
          <div class="mem-logo">
            <img src="<?php echo base_url(); ?>assets/admin/images/gia-logo.png" alt="Gia Alumini Member">
          </div>
        </div>
        <div class="padding-4"></div>
          <div class="flex-wrap">
            <div class="qr-block">
              <img src="<?php echo base_url(); ?>assets/admin/images/qr/<?php echo $qrcode; ?>" alt="QRCode Image" width="100px" height="100px">
              <p>Verification</p>
              <span>Translation</span>
            </div>
            <div class="help-block">
              <p><strong>See Help</strong></p><br/>
              <a href="http://gemologycentral.com/">www.gemologycentral.com</a>
            </div>
          </div>
      </div>
    </div>
  </section>

  <a href="<?php echo base_url(); ?>admin/customer" class="back-btn">Go Back</a>
</body>
</html>
