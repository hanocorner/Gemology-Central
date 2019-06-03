<?php $var = '';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Receipt - </title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        html,
        body {
            font-family: 'Open Sans', sans-serif;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content:space-around;
            margin-bottom: 30px;
        }

        .d-block {
            display: block;
        }

        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .back-btn {
            width: 150px;
            display: block;
            margin: auto;
            background-color: rgb(46, 101, 204);
            color: #fff;
            padding: 5px;
            text-decoration: none;
            text-align: center;
            border: 1px solid rgb(46, 101, 204);
            border-radius: 5px;
        }

        .back-btn:hover {
            text-decoration: none;
        }

        .pt-10 {
            padding-top: 10px;
        }

        @media print {
            .back-btn {
                display: none;
            }

            .grid-container {
                display: grid;
                grid-template-columns: auto auto;
                grid-gap: 20px;
                padding: 20px;
            }

            .grid-container>div {
                border: 1px solid black;
            }
        }

        h3 {
            margin: 32px 0 50px 0;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto;
            grid-gap: 20px;
            padding: 20px;
        }

        .grid-inside {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 10px;
            padding: 5px;
            border: 1px solid #d6d6d6;
            position: relative;
        }
        .watermark{
            position: absolute;
            top: 36%;
            left: 41%;
        }
        .seal-1{
            position: absolute;
            left: 0;
            bottom: -10px;
        }
        .seal-2{
            position: absolute;
            top: -2%;
            right: 0;
        }
        .grid-inside .item-1 img {
            display: block;
            margin: 8px auto;
        }

        .grid-inside .item-1 table {
            margin-left: 10px;
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .grid-inside .item-1 table td {
            font-size: 13px;
        }
        .grid-inside .item-2 .image {
            padding: 32px;
            margin-left:68px;
            margin-right:68px;
            margin-top:38px;
            margin-bottom:48px;
        }
        .grid-inside .item-2 .image img {
            display:block;
            margin:0 auto;
        }
        .grid-inside .item-2 .image .signature {
            width: 100%;
            display: block;
            max-width: 250px;
            border-top: 1px solid black;
            margin-left:auto;
            margin-right:auto;
            margin-top: 130px;
        }
        .grid-inside .item-2 .image .signature p{
            margin-top:2px;
        }
        .grid-inside .item-2 .qr {
            position: relative;
        }
        .grid-inside .item-2 .qr p:nth-child(1) {
            position: relative;
            top: 18px;
            left: 20px;
            font-size: 14px;
        }
        .grid-inside .item-2 .qr p:nth-child(2) {
            position: absolute;
            transform: rotate(-90deg);
            left: -43px;
            top: 88px;
            font-size: 14px;
        }
        .grid-inside .item-2 .qr img {
            width: 120px;
            max-height:auto;
        }
        .grid-inside .item-2 .help-text p {
            margin:0;
        }
        .grid-inside .item-2 .help-text p:nth-child(1) {
            font-size:12px;
            color:#d6d6d6;
        }
        .grid-inside .item-2 .help-text p:nth-child(2) {
            font-size:13px;
            color:#000;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/print/paper.css'); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        @page {
            size: A4 Landscape
        }
    </style>
</head>
<body class="A4 landscape" onload="window.print();">
    <section class="sheet">
        <div class="grid-container">
            <div class="grid">
                <div class="grid-inside">
                    <div class="item-1">
                        <img src="<?php echo base_url('images/print-full-report-logo.png'); ?>" alt="Logo">
                        <h3 style="text-align:center;">GEM IDENTIFICATION REPORT</h3>

                        <table cellspacing="5" cellpadding="2">
                            <tbody>
                                <tr>
                                    <td width="200" class="text-uppercase">report no</td>
                                    <td>
                                        <?php echo $result->repoid; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase">Date</td>
                                    <td><?php echo $result->date; ?></td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase">Object</td>
                                    <td id="object"><?php echo $result->object; ?></td>
                                </tr>
                                <tr>
                                    <td><br /></td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase"><strong>Variety</strong></td>
                                    <td><strong><?php echo $result->variety; ?></strong></td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase"><strong>Species/Group</strong></td>
                                    <td id="spgroup"><strong><?php echo $result->spgroup; ?></strong></td>
                                </tr>
                                <tr>
                                    <td><br /></td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase">Weight</td>
                                    <td id="weight"><?php echo $result->weight; ?></td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase">Dimensions</td>
                                    <td><?php echo $result->dimensions; ?></td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase">Shape & Cut</td>
                                    <td><?php echo $result->shapecut; ?></td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase">Color</td>
                                    <td><?php echo $result->color; ?></td>
                                </tr>
                                <tr>
                                    <td><br /></td>
                                </tr>
                                <tr>
                                    <td width="200" class="text-uppercase"><strong>Comments</strong></td>
                                    <td><strong><?php echo $result->comment; ?></strong></td>
                                </tr>
                                <tr>
                                    <td><br /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <img src="<?php echo base_url('images/watermark.png');?>" class="watermark">
                    <img src="<?php echo base_url('images/seal.png');?>" class="seal-1">
                    <img src="<?php echo base_url('images/seal.png');?>" class="seal-2">
                    <div class="item-2">
                        <div class="image">
                            <img src="<?php echo base_url('images/gem/'.$result->imgpath.$result->gemstone);?>">
                            <p class="text-center"><small>This photo is for representational purpose only. Color and/or size may vary from original</small></p>

                            <div class="signature">
                                <p class="text-center">Arjuna K Jayweera GG</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="qr">
                            <p>Verification</p>
                            <p>Verification</p>
                            <img src="<?php echo base_url('assets/images/qr/'.$result->repoid.'.png');?>" >
                            
                            </div>
                            <div class="help-text">
                            <p class="text-center">See Help</p>
                            <p class="text-center">www.gemologycentral.com</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

    </section>
    <a href="<?php echo base_url('admin/report/published'); ?>" class="back-btn">Go Back</a>
</body>

</html>