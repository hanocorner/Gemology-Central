<!-- Grid -->
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Contact Details</th>
            <th scope="col">Date</th>
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
                    <?php echo $result['custid']; ?>
                </td>

                <td style="width:20%;">
                    <?php echo $result['firstname'].' '.$result['lastname'] ?>
                </td>
                <td style="width:10%;">
                    <?php echo $result['number']; ?>
                </td>
                <td style="width:10%;">
                    <?php echo $result['created_date']; ?>
                </td>
                
                <td style="width:5%;">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="#" data-id="<?php echo $result['custid']; ?>" data-action="editModal" data-csrf="<?php echo $this->security->get_csrf_hash();?>" class="text-muted mx-2 buttonz edit"><i
                                class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                        <a href="#" data-id="<?php echo $result['custid']; ?>" data-action="deleteModal" class="text-muted mx-2 buttonz delete"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
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