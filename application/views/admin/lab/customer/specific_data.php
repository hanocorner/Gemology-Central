<!-- Relavant Customer Report -->
<div class="cg-data">
  <?php if(isset($empty)): ?>
    <div class="d-flex align-items-center">
      <p style="margin-bottom:0;"><?php echo $empty; ?></p>&nbsp;&nbsp; <a href="<?php echo base_url(); ?>admin/report" class="btn btn-sm btn-primary">
        <i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp; Add Report
      </a>
      <?php return false; ?>
    </div>
  <?php endif; ?>
  <?php foreach ($customers as $customer):?>
  <div class="cs-data mx-auto my-3">
    <div class="float-right cs-id">
       <h4>#<?php echo $customer->custid; ?></h4>
       <a href="<?php echo base_url(); ?>admin/report" class="btn btn-sm btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Add Report</a>
    </div>
    <div class="d-flex align-items-center ">
      <div class="d-block mr-2">
        <img src="<?php echo base_url(); ?>assets/admin/images/user.png" alt="Customer">
      </div>
      <div class="d-block mx-4">
        <h4><?php echo ucwords($customer->cus_firstname)." ".$customer->cus_lastname; ?></h4>
        <h5><?php echo $customer->cus_number; ?></h5>
        <p><?php echo $customer->cus_email; ?></p>
        <div class="buttons">
          <a href="<?php echo base_url(); ?>admin/customer/edit" class="btn btn-sm btn-warning">Edit Customer</a>&nbsp;
          <a href="Javascript void(0);" class="btn btn-sm btn-danger">Delete Customer</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="gm-data mt-5 mx-auto">
    <?php if(empty($mdata)): ?>
      <h5>No matching records for Memo Card</h5>
    <?php else: ?>
      <h5>Relavant Memo Card Details</h5>

    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#memoid</th>
        <th scope="col">Object</th>
        <th scope="col">Weight</th>
        <th scope="col">Color</th>
        <th scope="col">Identification</th>
        <th scope="col">Payment Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($mdata as $memo):?>
      <tr>
        <td><?php echo $memo->memoid; ?></td>
        <td><?php echo $memo->rep_object; ?></td>
        <td><?php echo $memo->rep_weight; ?></td>
        <td><?php echo $memo->rep_color; ?></td>
        <td><?php echo $memo->rep_identification; ?></td>
        <?php if($memo->mem_paymentStatus == '0'): ?>
          <td style="color:rgb(209,70,83);"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp; Unpaid</td>
        <?php endif; ?>
        <?php if($memo->mem_paymentStatus == '1'): ?>
          <td style="color:rgb(57,159,67);"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Paid</td>
        <?php endif; ?>

        <td>
          <div class="d-flex">
            <!-- <div class="dropdown">
              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Preview</a>
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Delete</a>
              </div>
            </div> -->
            <a href="<?php echo base_url(); ?>admin/report/edit/memocard/<?php echo $memo->memoid; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp; Edit</a>
            &nbsp;<a href="<?php echo base_url(); ?>admin/printp/memocard/<?php echo $memo->memoid; ?>" class="btn btn-dark btn-sm"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</a>
          </div>
        </td>
      </tr
    <?php endforeach; ?>>

    </tbody>
  </table>

<?php endif; ?>
  </div>

  <div class="gm-data mt-4 mx-auto">
    <?php if(empty($cdata)): ?>
      <h5> No matching records for Certificate Report </h5>
    <?php else: ?>
    <h5>Relavant Certificate Report Details </h5>

    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#reportid</th>
        <th scope="col">Object</th>
        <th scope="col">Weight</th>
        <th scope="col">Color</th>
        <th scope="col">Identification</th>
        <th scope="col">Payment Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cdata as $cert):?>
      <tr>
        <td><?php echo $cert->gsrid; ?></td>
        <td><?php echo $cert->rep_object; ?></td>
        <td><?php echo $cert->rep_weight; ?></td>
        <td><?php echo $cert->rep_color; ?></td>
        <td><?php echo $cert->rep_identification; ?></td>
        <?php if($cert->gsr_paymentStatus == '0'): ?>
          <td style="color:rgb(209,70,83);"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp; Unpaid</td>
        <?php endif; ?>
        <?php if($cert->gsr_paymentStatus == '1'): ?>
          <td style="color:rgb(57,159,67);"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp; Paid</td>
        <?php endif; ?>
        <td>
          <div class="d-flex">
            <!-- <div class="dropdown">
              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Preview</a>
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Delete</a>
              </div>

            </div> -->
            <a href="<?php echo base_url(); ?>admin/report/edit/certificate/<?php echo $cert->gsrid; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp; Edit</a>
            &nbsp;<a href="<?php echo base_url(); ?>admin/printp/certificate/<?php echo $cert->gsrid; ?>" class="btn btn-dark btn-sm"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  </div>
<?php endif; ?>
</div>
