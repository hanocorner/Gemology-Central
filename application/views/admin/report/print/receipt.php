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
        }
        img {
            margin: 0 12px;
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
                padding: 27px 10px;
            }

            .grid-container > div {
                border: 1px solid #e6e6e6;
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
            border-top: 0.5px solid #e6e6e6;
        }

        th,
        td {
            font-size:12px;
            padding: 7px;
            text-align: left;
        }
        .no-border tbody  td {
            border:none;
        }
        h2 {
            font-size:21px;
            text-align: center;
            margin: 4px 0;
        }
        h3 {
            font-size:17px;
            margin: 5px 0;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 20px;
            padding: 27px 10px;
        }

        .grid-container > div {
            border: 1px solid #e6e6e6;
        }
        p{
            font-size:13px;
            margin:5px 0;
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
                size: 5.83in 8.27in;
            }
        }
    </style>
    <script>
        var arr = [];
        var customer = '';
        var number = null;
    </script>
</head>

<body class="A5 landscape" onload="window.print();" >
    
    <section class="sheet">
        <div class="grid-container">
            <div class="item1">
                    <div class="d-flex">
                        <img src="<?php echo base_url('images/symbol.png'); ?>" alt="Logo">
                        <div class="d-block">
                            <h2>Gemology Central Labortary</h2>
                            <p><strong>Phone:</strong>&nbsp; +94 771234567</p>
                            <p><strong>Email:</strong>&nbsp;&nbsp;&nbsp; info@gemologycentral.com</p>
                            <p><strong>Web:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; www.gemologycentral.com</p>
                        </div>
                    </div>
                    <p class="text-center">GTC, No.4, 44/2R, Sheilk Fassy Mw, China Port, Beruwala</p>                    
                <hr style="margin-top:18px; border: 0.5px solid #e6e6e6;">
                <h3 class="text-center">Invoice</h3>
                <table class="no-border" style="margin:15px 0;">
                            <tbody>
                                <tr>
                                    <td style="width:1%;">Customer:</td>
                                    <td id="invCustomer" style="width:42%;"></td>
                                    <td style="width:15%;">Inv No:</td>
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
                <table class="table" style="margin-top:14px">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
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
                            <?php if($result['quantity'] > 1): ?>
                            <td style="width:45%;"><?php echo $result['quantity']; ?> Stones</td>
                            <?php else: ?>
                            <td style="width:45%;"><?php echo $result['color']; ?> Stone</td>
                            <?php endif; ?>
                            <td style="width:3%;"><?php echo ucwords($result['repotype']); ?></td>
                            <td style="width:20%;"><?php echo $result['unit_price']; ?></td>
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
                <div class="d-flex" style="justify-content:space-between; padding:15px; margin-top:30px; margin-right:15px; margin-left:15px; margin-bottom:10px;">
                    <p style="border-top: 0.5px dashed #5555;">GCL</p>    
                    <p style="border-top: 0.5px dashed #5555;">Customer</p>
                </div>
            </div>
            
            <div class="item2">
            <div class="d-flex">
                        <img src="<?php echo base_url('images/symbol.png'); ?>" alt="Logo">
                        <div class="d-block">
                            <h2>Gemology Central Labortary</h2>
                            <p><strong>Phone:</strong>&nbsp; +94 771234567</p>
                            <p><strong>Email:</strong>&nbsp;&nbsp;&nbsp; info@gemologycentral.com</p>
                            <p><strong>Web:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; www.gemologycentral.com</p>
                            
                        </div>
                    </div>
            

                <div class="d-print-block mx-auto">
                    <p class="text-center">GTC, No.4, 44/2R, Sheilk Fassy Mw, China Port, Beruwala</p>       
                </div>
                <hr style="margin-top:18px; border: 0.5px solid #e6e6e6;">
                <h3 class="text-center">Cash Receipt</h3>
                <table class="no-border" style="margin:15px 0;">
                            <tbody>
                                <tr>
                                    <td style="width:1%;">Customer:</td>
                                    <td id="recCustomer" style="width:42%;"></td>
                                    <td style="width:16%;">Rec No:</td>
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
                        <table class="table" id="tableinvoice" style="margin-top:14px">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
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
                            <?php if($result['quantity'] > 1): ?>
                            <td style="width:45%;"><?php echo $result['quantity']; ?> Stones</td>
                            <?php else: ?>
                            <td style="width:45%;"><?php echo $result['color']; ?> Stone</td>
                            <?php endif; ?>
                            <td style="width:3%;"><?php echo ucwords($result['repotype']); ?></td>
                            <td style="width:20%;"><?php echo $result['unit_price']; ?></td>
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
                <div class="d-flex" style="justify-content:space-between; padding:15px; margin-top:30px; margin-right:15px; margin-left:15px; margin-bottom:10px;">
                    <p style="border-top: 0.5px dashed #5555;">GCL</p>    
                    <p style="border-top: 0.5px dashed #5555;">Customer</p>
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