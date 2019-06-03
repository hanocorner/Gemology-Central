<!-- Grid -->
<table class="table" id="tableDraft">
    <col width="15">
    <col width="60">
    <col width="140">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Published Date</th>
            <th scope="col">Modified Date</th>
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
                <td style="width:2%;">
                <?php echo $result['id'];?>
                </td>
            
                <td style="width:20%;">
                <?php echo $result['title']; ?>
                
                </td>

                <td style="width:10%;">
                    <?php echo $result['author']; ?>
                </td>
                <td style="width:10%;">
                    <?php echo $result['published_date']; ?>
                </td>
                <td style="width:10%;">
                    <?php echo $result['modified_date']; ?>
                </td>

                <?php  $p_status = $result['status']; ?>
                <?php if($p_status): ?>
                <td style="width:5%;"><span class="badge badge-success">Published</span></td>
                <?php else: ?>
                <td style="width:5%;"><span class="badge badge-info">Draft</span></td>
                <?php endif;?>
                
                <td style="width:5%;">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="<?php echo base_url('admin/blog/edit/'.$result['id']); ?>" class="text-muted mx-2 buttonz edit" title="Edit"><i
                                class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                        <a href="#" class="text-muted mx-2 buttonz delete" title="Delete this post"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></i></a>
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