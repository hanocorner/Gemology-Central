<?php $var = '';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Memocard - <?php echo $result->repoid; ?> </title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        html,
        body {
            font-family: 'Open Sans', sans-serif;
        }

        header,
        footer,
        aside,
        nav,
        form,
        iframe,
        .menu,
        .hero,
        .adslot {
            display: none;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .d-flex>h4 {
            margin: 1px 0;
            font-size: 10px;
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

        .border-top {
            padding-bottom: 4px;
            border-bottom: 2px solid;
        }

        .border-bottom {
            padding-bottom: 2px;
            border-bottom: 10px solid;
        }

        .border-blue {
            border-color: #00adee;
        }

        

        @media print {
            .d-flex > h4 {
                margin: 6px 0;
                font-size: 9.5px;
                line-height:12px;
            }
            .back-btn {
                display: none;
            } 
            .border-top {
                padding-bottom: 7px;
            }
            .border-bottom {
                padding-bottom: 2px;
            }
            .sheet {
                border: 0.5px solid #e8e8e8;
                border-radius: 5px;
            }

        }

        table {
            margin-top: 4px;
            margin-left: 6px;
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        table td {
            font-size: 11px;
        }

        .image {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .image> .gem-img-box {
            width: 74px;
            height: 68px;
            padding: 1px;
            background: #fff;
            border: 1px solid #00adee;
            border-radius: 1px;
            margin: 6px 8px 2px 0;
            display: flex;
            align-items: center;
        }

        .image> .gem-img-box> .gem {
            margin-top: 0;
            width: 100%;
            max-width: 68px;
            padding: 1px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .image>.qr {
            width: 54px;
            margin-top: 5px;
            padding: 1px;
            margin: 2px 8px 2px 0;
            border: 1px solid #00adee;
            border-radius: 1px;
        }

        p {
            margin: 0;
        }
        @media print{
            .image>.gem {
                width: 72px;
            }
            .image >.qr {
                width: 48px;
            }
            table td {
                font-size: 10.6px;
            }
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
        <div class="d-flex border-top border-blue">
            <img src="<?php echo base_url('images/print-memo-logo.png');?>">
            <!-- <img src="<?php echo base_url('images/print-memo-al-logo.png');?>"> -->
            <h4 style="text-transform:uppercase;">GEM <br>Identification  <br> Report</h4>
        </div>

        <!-- <div class="line blue line-2" style="margin-top: 5px;"></div> -->
        <div class="d-flex border-bottom border-blue">
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
                        <td width="9" class="text-uppercase">Color</td>
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
            <div class="gem-img-box">
                <img class="gem" src="<?php echo base_url('images/gem/'.$result->imgpath.$result->gemstone);?>">
            </div>
                
                <img class="qr" src="<?php echo base_url('assets/images/qr/'.$result->repoid.'.png');?>">
            </div>
        </div>
        <!-- <div class="line blue line-4"></div> -->
    </section>
    <a href="<?php echo base_url('admin/report/published'); ?>" class="back-btn">Go Back</a>
</body>

</html>