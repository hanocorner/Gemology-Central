<?php if(empty($results)): ?>
  <ul class="list-group">
    <li class="list-group-item disabled">
      <div class="d-flex justify-content-between align-items-center">
        <p>No Customers found</p>
        <span class="badge badge-danger badge-pill">Alert</span>
      </div>
    </li>
  </ul>
<?php else: ?>
<?php foreach ($results as $data):?>
<ul class="list-group">
  <li class="list-group-item">
    <small><?php echo "#".$data->custid; ?></small><br/>
    <div class="d-flex justify-content-between align-items-center">
        <h5><?php echo ucwords($data->cus_firstname)." ".$data->cus_lastname; ?></h5>
        <a href="#" id="cstgemAll" data-id="<?php echo $data->custid; ?>" data-action="cstgemData"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
    </div>
    <p>No.of Pending Certificates &nbsp;<span class="badge badge-primary badge-pill">14</span></p>
  </li>
</ul>
<?php endforeach; ?>
<?php endif; ?>

<div class="my-4">
  <nav aria-label="Page navigation example">
    <?php if(!is_null($links)):  ?>
    <?php echo $links; ?>
    <?php endif; ?>
  </nav>
</div>
