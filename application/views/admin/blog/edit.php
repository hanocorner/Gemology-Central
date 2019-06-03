<style>
    sup {
      color: red;
    }
</style>
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item">Blog</li>
      <li class="breadcrumb-item active">Edit Article</li>
    </ol>
    <!-- /. of Breadcrumbs-->

    <!-- Update form  -->
    <?php echo form_open_multipart('admin/blog/handler/update-article', array('id'=>'editPost')); ?>
    <input type="hidden" name="id" value="<?php echo $result->id; ?>">
    <div class="row">

      <div class=" col-12 col-md-7">
        <div class="form-group">
          <label for="article-title">Article Title<sup>&nbsp;*</sup></label>
          <input type="text" list="suggestions" name="title" class="form-control" placeholder="Enter Title"
            autocomplete="off" value="<?php echo $result->title; ?>">
          <div id="suggest"></div>
          <span>
        </div>
        <div class="form-group">
          <label for="article-title">Article Body<sup>&nbsp;*</sup></label>
          <div id="editor"><?php echo $result->body; ?></div>
        </div>

        
      </div>
      <div class="col-5">
      <div class="card">
          <div class="card-header">
            <strong>Article Image<sup>&nbsp;*</sup></strong>
          </div>
          <div class="card-body">
            <div class="form-group">
              <div class="target"></div>
            </div>
            <img src="<?php echo base_url('images/blog/'.$result->path.$result->gemstone);?>" alt="Default image" id="postImage" class="img-fluid img-thumbnail">
            <input type="hidden" name="image_path" id="imgPath"  value="<?php echo $result->path; ?>">
            <input type="hidden" name="image_name" id="imgName"  value="<?php echo $result->gemstone; ?>">
          </div>
        </div>
        <div class="card my-3">
          <div class="card-header">
            <strong>Article Settings</strong>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-6">
                  <label for="author">Author<sup>&nbsp;*</sup></label>
                  <select class="form-control form-control-sm" name="author">
                    <option><?php echo $result->author; ?></option>
                    <option>Arjuna Jayaweera</option>
                  </select>
              </div>
              <div class="form-group col-6">
                <label for="author">Tags<sup>&nbsp;*</sup></label>
                <select class="form-control form-control-sm" name="tags">
                    <option><?php echo $result->tags; ?></option>
                    <option>Ruby</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        
        <div class="dropdown show">
          <a class="btn btn-primary dropdown-toggle" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Update
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" id="updateDraft" href="#" data-status="0">Update Draft</a>
            <a class="dropdown-item" id="updatePublish" href="#" data-status="1">Update and Publish</a>
            
          </div>
        </div>
      </div>

    </div>
    <?php echo form_close(); ?>
