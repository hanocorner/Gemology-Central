<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Report</li>
      <li class="breadcrumb-item active">Edit Gemstone</li>
    </ol>

        <form action="<?php echo base_url(); ?>admin/report/update-gemstone-data" method="post" enctype="multipart/form-data">
          <div class="padding-1"></div>
          <div class="row">
            <div class="col-md-6">
              <h2>Edit Gem Details</h2>
            </div>

          </div>
          <div class="padding-1"></div>
          <div class="row">
          <!-- First Column  -->
          <div class="col-md-6">
              <div class="form-group">
                <label for="gem-no">Gem No: </label>
                <input type="text" class="form-control"  value="<?php echo $data->cerno; ?>" disabled>
                <input type="hidden" name="gem-no" value="<?php echo $data->cerno; ?>">
              </div>
              <div class="form-group">
                <label for="date">Date: </label>
                <input type="date" class="form-control" name="date" value="<?php echo $data->cer_date; ?>">
              </div>
              <div class="form-group">
                <label for="object">Object: </label>
                <input type="text" class="form-control" name="object" value="<?php echo $data->cer_object; ?>">
              </div>
            <div class="form-group">
              <label for="identification">Identification: </label>
              <input type="text" class="form-control" name="identification" value="<?php echo $data->cer_identification; ?>">
            </div>
            <div class="form-group">
              <label for="gem-img">Gem Image*</label>
              <div id="image-preview" style="background-image: url(<?php echo base_url().'assets/img/'.$data->cer_imagename;?>);">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload"/>
                <span style="color: #000000"><?php echo form_error('image'); ?></span>
              </div>
            </div>
          <script type="text/javascript">
            $.uploadPreview({
              input_field: "#image-upload",   // Default: .image-upload
              preview_box: "#image-preview",  // Default: .image-preview
              label_field: "#image-label",    // Default: .image-label
              label_default: "Choose File",   // Default: Choose File
              label_selected: "Change File",  // Default: Change File
              no_label: false                 // Default: false
            });
          </script>

            <div style="display:flex;">
              <div class="col-sm-9" style="padding-left:0;">
                <div class="form-group">
                  <label for="Weight">Weight: </label>
                  <input type="text" class="form-control" name="weight" value="<?php echo $data->cer_weight; ?>">
                </div>
              </div>
              <div class="col-sm-3" style="padding-right:0;">
                <div class="form-group">
                  <label for="dimensions">Unit: </label>
                  <input type="text" class="form-control" value="ct" disabled>
                </div>
              </div>
            </div>
          </div>

          <!-- Second Column  -->
          <div class="col-md-6">
            <div style="display:flex;">
              <div class="col-sm-3" style="padding-left:0;">
                <div class="form-group">
                  <label for="dimensions">Width: </label>
                  <input type="text" class="form-control" name="gemWidth" value="<?php echo $data->cer_gemWidth; ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="dimensions">Height: </label>
                  <input type="text" class="form-control" name="gemHeight" value="<?php echo $data->cer_gemHeight; ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="dimensions">Length: </label>
                  <input type="text" class="form-control" name="gemLength" value="<?php echo $data->cer_gemLength; ?>">
                </div>
              </div>
              <div class="col-sm-3" style="padding-right:0;">
                <div class="form-group">
                  <label for="dimensions">Unit: </label>
                  <input type="text" class="form-control" value="mm" disabled>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="cut">Cut: </label>
              <input type="text" class="form-control" name="gemcut" value="<?php echo $data->cer_cut; ?>">
            </div>
            <div class="form-group">
              <label for="shape">shape: </label>
              <input type="text" class="form-control" name="shape" value="<?php echo $data->cer_shape; ?>">
            </div>
          <div class="form-group">
            <label for="color">Color: </label>
            <input type="text" class="form-control" name="color" value="<?php echo $data->cer_color; ?>">
            <span><?php echo form_error(''); ?></span>
          </div>

          <div class="form-group">
            <label for="comment">Comment: </label>
            <textarea name="comment"  class="form-control"  rows="8" cols="100" value="<?php echo $data->cer_comment; ?>"></textarea>
            <span><?php echo form_error(''); ?></span>
          </div>

          </div>
          <div class="col-md-6">
            <div class="padding-1"></div>
            <input type="submit" class="btn btn-primary" value="Update Report">
            <div class="padding-1"></div>
          </div>

       </div>
       <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $hash; ?>" />
       </div>
      </form>
  </div>
</div>
