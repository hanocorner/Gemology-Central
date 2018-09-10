<div class="cg-data">
  <div class="cs-data mx-auto my-3">
    <div class="d-flex justify-content-between">
      <h3><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Mr.Mudir</h3>
      <h5><i class="fa fa-phone" aria-hidden="true"></i>&nbsp; 0771234567</h5>
    </div>
    <?php  ?>
    <div class="d-flex justify-content-between">

      <p>#0001</p>
      <div class="buttons">
        <a href="#" class="btn btn-primary">Add</a>&nbsp;
        <a href="#" class="btn btn-warning">Edit</a>&nbsp;
        <a href="#" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
  <div class="gm-data mt-4 mx-auto">
    <?php if(empty($results)): ?>
      <h5>No matching records for Memo Card</h5>
    <?php else: ?>
      <h5>Relavant Memo Card Details</h5>
    <?php foreach ($results as $data):?>

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
        <th scope="row"><?php echo $data->cerno; ?></th>
        <td><?php echo $data->cer_object; ?></td>
        <td><?php echo $data->cer_weight; ?></td>
        <td><?php echo $data->cer_color; ?></td>
        <td><?php echo $data->cer_identification; ?></td>
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
      </tr>

    </tbody>
  </table>
<?php endforeach; ?>
<?php endif; ?>
  </div>

  <div class="gm-data mt-4 mx-auto">
    <h4>Relavant Certificate Report Details</h4>
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
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>Otto</td>

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
