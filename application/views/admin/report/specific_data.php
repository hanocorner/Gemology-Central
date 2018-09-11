<div class="cg-data">
  <?php foreach ($results as $data):?>
  <div class="cs-data mx-auto my-3">
    <div class="float-right cs-id">
       <h4>#<?php echo $data->custid; ?></h4>
    </div>
    <div class="d-flex align-items-center ">
      <div class="d-block mr-2">
        <img src="<?php echo base_url(); ?>assets/admin/images/user.png" alt="Customer">
      </div>
      <div class="d-block mx-4">
        <h4><?php echo ucwords($data->cus_firstname)." ".$data->cus_lastname; ?></h4>
        <h5><?php echo $data->cus_number; ?></h5>
        <p><?php echo $data->cus_email; ?></p>
        <div class="buttons">
          <a href="<?php echo base_url(); ?>admin/report" class="btn btn-sm btn-primary">Add</a>&nbsp;
          <a href="<?php echo base_url(); ?>admin/report" class="btn btn-sm btn-warning">Edit</a>&nbsp;
          <a href="Javascript void(0);" class="btn btn-sm btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>

  <?php endforeach; ?>
  <div class="gm-data mt-5 mx-auto">
    <?php if(empty($results)): ?>
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
      <?php foreach ($results as $data):?>
      <tr>
        <td><?php echo $data->memoid; ?></td>
        <td><?php echo $data->rep_object; ?></td>
        <td><?php echo $data->rep_weight; ?></td>
        <td><?php echo $data->rep_color; ?></td>
        <td><?php //echo $data->rep_identification; ?></td>
        <td>Paid</td>

        <td>
          <div class="d-flex">
            <div class="dropdown">
              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Preview</a>
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Delete</a>
              </div>

            </div>
            &nbsp;<a href="#" class="btn btn-dark btn-sm">Print</a>
          </div>
        </td>
      </tr
    <?php endforeach; ?>>

    </tbody>
  </table>

<?php endif; ?>
  </div>

  <div class="gm-data mt-4 mx-auto">
    <h5>Relavant Certificate Report Details</h5>
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
      <tr>
        <th scope="row"><?php echo $data->gsrid; ?></th>
        <td><?php echo $data->rep_object; ?></td>
        <td><?php echo $data->rep_weight; ?></td>
        <td><?php echo $data->rep_color; ?></td>
        <td><?php //echo $data->rep_identification; ?></td>

        <td>
          <div class="d-flex">
            <div class="dropdown">
              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Preview</a>
                <a class="dropdown-item" href="#">Edit</a>
                <a class="dropdown-item" href="#">Delete</a>
              </div>

            </div>
            &nbsp;<a href="#" class="btn btn-dark btn-sm">Print</a>
          </div>
        </td>
      </tr>

    </tbody>
  </table>
  </div>
</div>
