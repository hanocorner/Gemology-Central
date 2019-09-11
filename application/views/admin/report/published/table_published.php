<!-- Grid -->
<table class="table">
    <col width="15">
    <col width="60">
    <col width="140">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th scope="col">Report</th>
            <th scope="col">ID</th>
            <th scope="col">Customer</th>
            <th scope="col">Weight</th>
            <th scope="col">Color</th>
            <th scope="col">Width</th>
            <th scope="col">Shape</th>
            <th scope="col">Variety</th>
            <th scope="col">Payment</th>
            <th scope="col"></th>
        </tr>
    </thead>

    <?php if(!isset($results)): ?>
        <tr>No Results</tr>
    <?php return false; ?>
    <?php endif; ?>
        <?php foreach($results as $result): ?>
            <tr class="grid-tr">
                <td style="width:2%;">
                    <?php echo $result['reportno']; ?>
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

                <td style="width:13%;">
                    <?php echo $result['reportid']; ?>
                </td>

                <td style="width:15%;">
                    <?php echo $result['customer']; ?>
                </td>
                <td style="width:5%;">
                    <?php echo $result['weight']; ?>
                </td>
                <td style="width:15%;">
                    <?php echo $result['color']; ?>
                </td>
                <td style="width:5%;">
                    <?php echo $result['gemWidth']; ?>
                </td>
                <td style="width:15%;">
                    <?php echo$result['shapecut']; ?>
                </td>
                <td style="width:15%;">
                    <?php echo$result['variety']; ?>
                </td>

                <?php  $p_status = $result['payment']; ?>
                <?php if($p_status == 'unpaid'): ?>
                <td style="width:10%;"><span class="badge badge-danger">Unpaid</span></td>
                <?php elseif($p_status == 'paid-advance'): ?>
                <td style="width:10%;"><span class="badge badge-warning">Paid</span></td>
                <?php elseif($p_status == 'paid-full'): ?>
                <td style="width:10%;"><span class="badge badge-success">Paid</span></td>
                <?php endif;?>
  
                <td style="width:10%;">
                    <div class="d-flex align-items-center justify-content-center">
                        <?php $report = $result['type'].'/'.$result['reportno'];?>
                        <a href="<?php echo base_url('admin/report/edit/'.$report); ?>" class="text-muted mx-2 buttonz edit"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                        <a href="<?php echo base_url('admin/report/print/card/'.$result['type'].'/'.$result['reportno']); ?>" class="text-muted mx-2 buttonz add" title="Print"><i
                                class="fa fa-print fa-lg" aria-hidden="true"></i></a>
                        <a href="<?php echo base_url('report/'.$result['qrtoken']); ?>" target="_blank" class="text-muted mx-2 buttonz delete"><i class="fa fa-external-link fa-lg"></i></a>
                        <a href="<?php echo base_url('admin/report/draft/handler/download/'.$result['reportid'].'.png'); ?>" class="text-muted mx-2 buttonz delete" title="Download qr"><i class="fa fa-download" aria-hidden="true"></i></a>
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