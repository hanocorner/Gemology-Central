<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Receipt - </title>

    <style>
        @font-face {
            font-family: 'Times New Roman';
            src: url('<?php echo base_url(); ?>assets/admin/fonts/times/TimesNewRomanPSMT.woff2') format('woff2'),
                url('<?php echo base_url(); ?>assets/admin/fonts/times/TimesNewRomanPSMT.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        .d-flex {
            display:flex;
            align-items:center;
        }
        .d-block {
            display:block;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        h2 {
            text-align: center;
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
            size: A4
        }
    </style>
</head>

<body class="A4">
    <!-- onload="window.print();" -->
    <section class="sheet padding-10mm">
        <div class="d-flex">
            <img src="<?php echo base_url('images/gcl-logo.png'); ?>" alt="Logo">
            <div class="d-block">
                <h2>Gemology Central Labortary</h2>
                <p>+94 771234567</p>
                <p>info@gcl.com</p>
            </div>
        </div>

        <div class="d-print-block mx-auto">
            <p>GTC, No.4, 44/2R, Sheilk Fassy Mw, China Port, </p>
        </div>
        <hr>
        <h3 class="text-center">Cash Receipt</h3>
        <p>Customer Name <span>Hansaka Perera</span></p>
        <p>Contact No. <span>0773466141</span></p>
        <br />
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Description</th>
                    <th>Cert type</th>
                    <th>PCS</th>
                    <th>CTS</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!isset($results)): ?>
                <tr>No Results</tr>
                <?php return false; ?>
                <?php endif; ?>
                <?php foreach($results as $result): ?>
                <tr>
                    <td><?php echo 1; ?></td>
                    <td>Description</td>
                    <td>cert</td>
                    <td>pcs</td>
                    <td><?php echo $result['reportid']; ?></td>
                    <td><?php echo $result['unit_price']; ?></td>
                    <td><?php echo $result['unit_price'] * 1; ?> </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <a href="<?php echo base_url('admin/report/drafts'); ?>" class="back-btn">Go Back</a>
</body>

</html>