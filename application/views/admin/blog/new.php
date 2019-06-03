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
      <li class="breadcrumb-item active">New Article</li>
    </ol>

    <!-- /. of Breadcrumbs-->

    <!-- Form -->
    <?php echo form_open_multipart('admin/blog/handler/add-article', array('id'=>'addPost')); ?>

    <div class="row">

      <div class=" col-12 col-md-7">
        <div class="form-group">
          <label for="article-title">Article Title<sup>&nbsp;*</sup></label>
          <input type="text" list="suggestions" name="title" class="form-control" placeholder="Enter Title"
            autocomplete="off">
          <div id="suggest"></div>
          <span>
        </div>
        <div class="form-group">
          <label for="article-title">Article Body<sup>&nbsp;*</sup></label>
          <div id="editor"></div>
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
            <img src="<?php echo base_url('images/default-blog-img.png');?>" alt="Default image" id="postImage" class="img-fluid img-thumbnail">
            <input type="hidden" name="image_path" id="imgPath"  value="">
            <input type="hidden" name="image_name" id="imgName"  value="">
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
                    <option>Choose</option>
                    <option>Arjuna Jayaweera</option>
                  </select>
              </div>
              <div class="form-group col-6">
                <label for="author">Tags<sup>&nbsp;*</sup></label>
                <select class="form-control form-control-sm" name="tags">
                    <option>Choose</option>
                    <option>Ruby</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        
        <div class="dropdown show">
          <a class="btn btn-primary dropdown-toggle" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Publish
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" id="saveDraft" href="#" data-status="0">Save Draft</a>
            <a class="dropdown-item" id="savePublish" href="#" data-status="1">Save and Publish</a>
            
          </div>
        </div>
      </div>

    </div>
    <?php echo form_close(); ?>

  </div>
</div>