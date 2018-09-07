<div class="container-fluid my-5">
  <div class="row">
    <div class="col-md-2 offset-md-2"></div>
    <div class="col-md-2"><h3>Report Verified</h3></div>
  </div>
  <div class="row my-3">
      <div class="col-md-2 offset-md-2"></div>
      <div class="col-md-3">
    <div id="image-preview">
      <?php
          $image = $data->cer_imagename;
          if(isset($image)){
             echo "<img class='img-preview' src='".base_url()."assets/admin/images/gem/$image' width='240px' height='140px'>";
          }
      ?>
    </div>
      </div>

      </div>

    <div class="row">
        <div class="col-md-2 offset-md-2"></div>
        <div class="col-md-1">
           Gem No:
        </div>
        <div class="col-md-2">
            <strong><?php echo $data->cerno; ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Date:
        </div>
        <div class="col-md-2">
            <?php echo $data->cer_date; ?>
        </div>
    </div>
    <div class="row">
      <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Gem Object:
        </div>
        <div class="col-md-2">
            <?php echo $data->cer_object; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Identification:
        </div>
        <div class="col-md-2">
            <?php echo $data->cer_identification;?>
        </div>
    </div>
    <div class="row">
      <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Weight:
        </div>
        <div class="col-md-2">
            <?php echo $data->cer_weight." ct "; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Dimensions:
        </div>
        <div class="col-md-7">
            <?php echo $data->cer_gemWidth.' x '.$data->cer_gemHeight. ' x '. $data->cer_gemLength.' (mm) '; ?>
        </div>
    </div>

    <div class="row">
      <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Gem Cut:
        </div>
        <div class="col-md-2">
            <?php echo $data->cer_cut;?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Gem Shape:
        </div>
        <div class="col-md-2">
            <?php echo $data->cer_shape;?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Gem Color:
        </div>
        <div class="col-md-2">
            <?php echo $data->cer_color; ?>
        </div>
    </div>

    <div class="row">
      <div class="col-md-2 offset-md-2"></div>
         <div class="col-md-1">
           Comment:
        </div>
        <div class="col-md-7">
            <?php  echo $data->cer_comment;?>
        </div>
    </div>
</div>
