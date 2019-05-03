<?php $var = '';?>
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
            display: flex;
            align-items: center;
        }
        img {
            margin-right:15px;
        }
        .d-block {
            display: block;
        }
        .text-center {
            text-align:center;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table,
        th,
        td {
            font-size: 14px;
            border-top: 0.5px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }
        .no-border tbody  td {
            border:none;
        }
        h2 {
            text-align: center;
            margin: 4px 0;
        }
        h3{
            margin: 5px 0;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 20px;
            padding: 10px;
        }

        .grid-container>div {
            border: 1px solid black;
        }
        p{
            margin:2px 0;
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
    <script>
        var arr = [];
        var customer = '';
        var number = null;
    </script>
</head>

<body class="A4" onload="window.print();" >
    <a href="<?php echo base_url('admin/report/drafts'); ?>" class="back-btn">Go Back</a>
    <section class="sheet">
        <div class="grid-container">
            <div class="item1">
                    <div class="d-flex">
                        <img src="<?php echo base_url('images/symbol.png'); ?>" alt="Logo">
                        <div class="d-block">
                            <h2>Gemology Central Labortary</h2>
                            <p>Phone: +94 771234567</p>
                            <p>Email: info@gemologycentral.com</p>
                            <p>Web: www.gemologycentral.com</p>
                            
                        </div>
                    </div>
                    <p class="text-center">GTC, No.4, 44/2R, Sheilk Fassy Mw, China Port, Beruwala</p>                    
                <hr>
                <h3 class="text-center">Invoice</h3>
                <table class="no-border">
                            <tbody>
                                <tr>
                                    <td style="width:1%;">Customer:</td>
                                    <td id="invCustomer" style="width:30%;"></td>
                                    <td style="width:22%;">Ref No:</td>
                                    <td><?php echo $receipt_num; ?></td>
                                </tr>
                                <tr>
                                    <td style="width:1%;">Contact:</td>
                                    <td id="invCstNumb"></td>
                                    <td style="width:1%;">Date:</td>
                                    <td><?php echo $receipt_date; ?></td>
                                </tr>
                            </tbody>
                        </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Report<br/> type</th>
                            <th>Unit<br/> Price</th>
                            <th>Qty</th>
                            <th>Total<br/> Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!isset($results)): ?>
                        <tr>No Results</tr>
                        <?php return false; ?>
                        <?php endif; ?>
                        <?php foreach($results as $result): ?>
                        <tr>
                            <td style="width:60%;"><?php echo 'text des...'; ?></td>
                            <td style="width:3%;"><?php echo ucwords($result['repotype']); ?></td>
                            <td style="width:10%;"><?php echo $result['unit_price']; ?></td>
                            <td style="width:3%;"><?php echo $result['quantity']; ?></td>
                            <td style="width:20%;"><?php echo $result['total_amount']; ?></td>
                        </tr>
                        <script>
                        customer = '<?php echo $result['customer']; ?>';
                        number = '<?php echo $result['number']; ?>';
                        </script>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" style="text-align:right;">TOTAL</td>
                            <td id="grandInvoiceTotal"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex" style="justify-content:space-between; padding:15px;">
                <p>GCL</p>    
                <p>Customer</p>
        </div>
            </div>
            
            <div class="item2">
            <div class="d-flex">
                        <img src="<?php echo base_url('images/symbol.png'); ?>" alt="Logo">
                        <div class="d-block">
                            <h2>Gemology Central Labortary</h2>
                            <p>Phone: +94 771234567</p>
                            <p>Email: info@gemologycentral.com</p>
                            <p>Web: www.gemologycentral.com</p>
                            
                        </div>
                    </div>
            

                <div class="d-print-block mx-auto">
                    <p class="text-center">GTC, No.4, 44/2R, Sheilk Fassy Mw, China Port, Beruwala</p>       
                </div>
                <hr>
                <h3 class="text-center">Cash Receipt</h3>
                <table class="no-border">
                            <tbody>
                                <tr>
                                    <td style="width:1%;">Customer:</td>
                                    <td id="recCustomer" style="width:30%;"></td>
                                    <td style="width:22%;">Ref No:</td>
                                    <td><?php echo $receipt_num; ?></td>
                                </tr>
                                <tr>
                                    <td style="width:1%;">Contact:</td>
                                    <td id="recCstNumb"></td>
                                    <td style="width:1%;">Date:</td>
                                    <td><?php echo $receipt_date; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table" id="tableinvoice">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Report<br/> type</th>
                            <th>Unit<br/> Price</th>
                            <th>Qty</th>
                            <th>Total<br/> Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!isset($results)): ?>
                        <tr>No Results</tr>
                        <?php return false; ?>
                        <?php endif; ?>
                        <?php foreach($results as $result): ?>
                        <tr>
                            <td style="width:60%;"><?php echo 'text des...'; ?></td>
                            <td style="width:3%;"><?php echo ucwords($result['repotype']); ?></td>
                            <td style="width:10%;"><?php echo $result['unit_price']; ?></td>
                            <td style="width:3%;"><?php echo $result['quantity']; ?></td>
                            <td style="width:20%;"><?php echo $result['total_amount']; ?></td>
                        </tr>
                        <script>
                         arr.push(<?php echo $result['total_amount'];  ?>);
                        </script>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" style="text-align:right;">TOTAL</td>
                            <td id="grandReceiptTotal"></td>
                        </tr>
                    </tbody>
                </table>
            <div class="d-flex" style="justify-content:space-between; padding:15px;">
                <p>GCL</p>    
                <p>Customer</p>
        </div>
        </div>



    </section>
    <a href="<?php echo base_url('admin/report/drafts'); ?>" class="back-btn">Go Back</a>
</body>
<script>
var grandInvTotal = document.getElementById("grandInvoiceTotal");
var grandRecTotal = document.getElementById("grandReceiptTotal");
var sum = arr.reduce(function(a, b) { return a + b; }, 0);
grandInvTotal.innerText = 'Rs. '+sum;
grandRecTotal.innerText = 'Rs. '+sum;

// Customer name
var invCustomer = document.getElementById("invCustomer");
var recCustomer = document.getElementById("recCustomer");
invCustomer.innerText = customer;
recCustomer.innerText = customer;

// Customer number
var invCstNumb = document.getElementById("invCstNumb");
var recCstNumb = document.getElementById("recCstNumb");
invCstNumb.innerText = number;
recCstNumb.innerText = number;

</script>
</html>