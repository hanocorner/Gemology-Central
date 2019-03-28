<!-- Grid -->
<table class="table">
    <col width="15">
    <col width="60">
    <col width="140">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th scope="col">Report</th>
            <th scope="col">Customer</th>
            <th scope="col">Weight</th>
            <th scope="col">Color</th>
            <th scope="col">Width</th>
            <th scope="col">Shape</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
    </thead>

    <?php if(!isset($results)): ?>
        <tr>No Results</tr>
    <?php return false; ?>
    <?php endif; ?>
        <?php foreach($results as $result): ?>
            <tr class="grid-tr" data-id="121">
                <td style="width:5%;">
                    <?php echo $result['reportid']; ?>
                </td>
                <?php if($result['type'] == 'verb'): ?>
                <td style="width:10%;"><span class="badge badge-pill badge-secondary">Verbal</span>
                    </td>
                <?php elseif ($result['type'] == 'repo'):  ?>
                <td style="width:10%;"><span class="badge badge-pill badge-info">Full Report</span>
                    </td>
                <?php elseif($result['type'] == 'memo'):  ?>
                <td style="width:10%;"><span class="badge badge-pill badge-primary">Memocard</span></td>
                    
                <?php endif;?>

                <td style="width:20%;">
                    <?php echo $result['customer']; ?>
                </td>
                <td style="width:10%;">
                    <?php echo $result['weight']; ?>
                </td>
                <td style="width:10%;">
                    <?php echo $result['color']; ?>
                </td>
                <td style="width:10%;">
                    <?php echo $result['gemWidth']; ?>
                </td>
                <td style="width:10%;">
                    <?php echo$result['shapecut']; ?>
                </td>
                <?php  $status = (int) $result['reportStatus']; ?>
                <?php if($status == 0): ?>
                <td style="width:10%;"><span class="badge badge-danger">Unpaid</span></td>
                <?php elseif($status == 1): ?>
                <td style="width:10%;"><span class="badge badge-warning">Paid</span></td>
                <?php elseif($status == 2): ?>
                <td style="width:10%;"><span class="badge badge-success">Paid</span></td>
                <?php endif;?>
                <td style="width:10%;">
                    <div class="d-flex align-items-center justify-content-center">
                        <?php $report = $result['type'].'/'.$result['reportid'];?>
                        <!-- Payment status -->
                        <a href="#" id="plus" data-toggle="modal" data-target="#paymentModal" class="text-muted mx-2 buttonz add"><i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i></a>
                        <!-- /. of Payment status -->
                        <a href="<?php echo base_url('admin/report/edit/'.$report); ?>" class="text-muted mx-2 buttonz edit"><i
                                class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                        <a href="#" class="text-muted mx-2 buttonz delete"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
                        <a href="#" class="text-muted mx-2 buttonz"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        <a href="#" class="text-muted mx-2 buttonz"><i class="fa fa-external-link fa-lg" aria-hidden="true"></i></a>
                        
                        
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    

</table>
<!-- /. of grid  -->

<div class="my-4">
  <nav aria-label="Page navigation example">
    <?php if(!is_null($links)):  ?>
    <?php echo $links; ?>
    <?php endif; ?>
  </nav>
</div>