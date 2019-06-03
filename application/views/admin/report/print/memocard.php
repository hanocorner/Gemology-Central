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
            justify-content: space-around;
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

        @media print {
            .back-btn {
                display: none;
            }
        }

        .line {
            width: 100%;
        }

        .blue {
            background: #00adee
        }

        .line-2 {
            height: 2px;
        }

        .line-4 {
            height: 10px;
            position: relative;
            top: 12px;
        }

        table {
            margin-top: 4px;
            margin-left: 2px;
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        table td {
            font-size: 11px;
        }
        .image {
            display:flex;
            flex-direction: column;
            align-items: center;
        }
        .image img {
            margin:2px 12px 2px 0;
            width:70px;
        }
        p {
            margin:0;
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
        @media print {
            @page {
                size: 3.37in 2.12in;
            }
        }
    </style>
</head>

<body class="legal" onload="window.print();">
    <section class="sheet">
        <div class="d-flex">
            <img src="<?php echo base_url('images/print-memo-logo.png');?>">
            <img src="<?php echo base_url('images/print-memo-al-logo.png');?>">
        </div>
        <div class="line blue line-2" style="margin-top: 5px;"></div>
        <div class="d-flex">
            <table cellspacing="0" cellpadding="0">
                <tbody>

                    <tr>
                        <td width="85" class="text-uppercase">Date</td>
                        <td><?php echo $result->date; ?></td>
                    </tr>
                    <tr>
                        <td width="85" class="text-uppercase">GCL Memo No</td>
                        <td>
                            <?php echo $result->repoid; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="85" class="text-uppercase">Color</td>
                        <td><?php echo $result->color; ?></td>
                    </tr>
                    <tr>
                        <td width="85" class="text-uppercase">Shape</td>
                        <td><?php echo $result->shapecut; ?></td>
                    </tr>
                    <tr>
                        <td width="85" class="text-uppercase">Weight</td>
                        <td id="weight"><?php echo $result->weight; ?></td>
                    </tr>
                    <tr>
                        <td width="85" class="text-uppercase">Measurements</td>
                        <td><?php echo $result->dimensions; ?></td>
                    </tr>
                    <tr>
                        <td width="85" class="text-uppercase"><strong>Variety</strong></td>
                        <td><strong><?php echo $result->variety; ?></strong></td>
                    </tr>
                    <tr>
                        <td width="85" class="text-uppercase"><strong>Species/Group</strong></td>
                        <td id="spgroup"><strong><?php echo $result->spgroup; ?></strong></td>
                    </tr>

                    <tr>
                        <td width="85" class="text-uppercase"><strong>Comments</strong></td>
                        <td><strong><?php echo $result->comment; ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <div class="image">
                <img src="<?php echo base_url('images/gem/'.$result->imgpath.$result->gemstone);?>">
                <img src="<?php echo base_url('assets/images/qr/'.$result->repoid.'.png');?>" >
            </div>
        </div>
        <div class="line blue line-4"></div>
    </section>
    <a href="<?php echo base_url('admin/report/published'); ?>" class="back-btn">Go Back</a>
</body>

</html>