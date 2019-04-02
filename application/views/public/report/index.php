<style media="screen">
  .borderless td,
  .borderless th {
    border: none;
  }

  .table td {
    padding: .45rem;
  }

  .img-gem img {
    margin: 0 10px;
  }
</style>
<section class="report mt-3">
  <div class="wrapper">
    <div class="row">
      <div class="col-md-4">
        <h3>Gemology Central Laboratory Report</h3>
        <?php $temp = (array) $result; ?>
        <?php if(empty($temp)): ?>
        <div class="alert alert-danger" role="alert"><strong><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp; Report not found</strong></div>
        <?php else: ?>
        <div class="alert alert-success" role="alert"><strong><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;&nbsp; Your report is verfied</strong></div>

        <div class="my-3 img-gem">
          <img src="<?php echo base_url('images/gem/'.$result->imgpath.$result->gemstone);?>" alt="" class="img-fluid" id="imgGem" width="80px" height="80px">
        </div>
        <table class="table borderless" id="table">
          <tbody>
            <tr>
              <td width="120"><strong>Number:</strong></td>
              <td id="repno">
                <?php echo $result->id; ?>
              </td>
            </tr>
            <tr>
              <td width="120"><strong>Date:</strong></td>
              <td id="date"><?php echo $result->date; ?></td>
            </tr>
            <tr>
              <td width="120"><strong>Object:</strong></td>
              <td id="object"><?php echo $result->object; ?></td>
            </tr>
            <tr>
              <td width="120"><strong>Variety:</strong></td>
              <td id="variety"><?php echo $result->variety; ?></td>
            </tr>
            <tr>
              <td width="120"><strong>Species/Group:</strong></td>
              <td id="spgroup"><?php echo $result->spgroup; ?></td>
            </tr>
            <tr>
              <td width="120"><strong>Weight:</strong></td>
              <td id="weight"><?php echo $result->weight; ?></td>
            </tr>
            <tr>
              <td width="120"><strong>Dimensions:</strong></td>
              <td id="dimension"><?php echo $result->dimensions; ?></td>
            </tr>
            <tr>
              <td width="120"><strong>Shape & Cut:</strong></td>
              <td id="shapecut"><?php echo $result->shapecut; ?></td>
            </tr>
            <tr>
              <td width="120"><strong>Color:</strong></td>
              <td id="color"><?php echo $result->color; ?></td>
            </tr>
            <tr>
              <td width="120"><strong>Comments:</strong></td>
              <td id="comment"><?php echo $result->comment; ?></td>
            </tr>
          </tbody>
        </table>
        <?php endif; ?>
        <div class="my-4"></div>

      </div>
    </div>
  </div>

</section>