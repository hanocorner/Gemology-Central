<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            Gem No:
        </div>
        <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <strong><?php echo $data->cerno; ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            Date
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php echo $data->cer_date; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            Gem Object
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php echo $data->cer_object; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            Identification
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php echo $data->cer_identification;?>
        </div>
    </div>
    <div class="padding-1"></div>
    <div class="row">
        <div class="col-md-4">
            Image
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
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
        <div class="padding-1"></div>
    <div class="row">
        <div class="col-md-4">
            Weight
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php echo $data->cer_weight." ct "; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            Dimensions
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php echo $data->cer_gemWidth.' x '.$data->cer_gemHeight. ' x '. $data->cer_gemLength.' (mm) '; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            Gem Cut
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php echo $data->cer_cut;?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            Gem Shape
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php echo $data->cer_shape;?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            Gem Color
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php  echo $data->cer_color; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            Comment
        </div>
         <div class="col-md-1">
           :
        </div>
        <div class="col-md-7">
            <?php  echo $data->cer_comment;?>
        </div>
    </div>
</div>
