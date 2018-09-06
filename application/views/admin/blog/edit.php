<style>
    .toggle-off{
        background-color: #cccccc;
        color: #ffffff;
    }
    .toggle-off{
        background-color: #cccccc;
        color: #ffffff;
    }
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
      <form id="form" action="<?php echo base_url(); ?>admin/blog/update-article" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
          <label for="article-title">Article Title<sup>&nbsp;*</sup></label>
          <input type="text" list="suggestions" name="title" class="form-control" id="title" placeholder="Enter Title" autocomplete="off" value="<?php echo $title; ?>">
          <div id="suggest"></div>
          <span>
        </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="basic-url">Article URL<sup>&nbsp;*</sup></label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3"><?php echo base_url(); ?></span>
              </div>
              <input type="text" class="form-control" aria-describedby="basic-addon3" value="<?php echo $url; ?>" disabled>
              <input type="hidden" name="blog-url" value="<?php echo $url; ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="editor">Article Body<sup>&nbsp;*</sup></label>
            <textarea id='froala-editor' name="body" style="margin-top: 50px;" placeholder="Type some text" ><?php echo $body; ?></textarea>
          </div>
        </div>
      </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <strong>Article Settings</strong>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="author">Author<sup>&nbsp;*</sup></label>
            <input type="text" name="author" class="form-control" id="author" placeholder="Name of the Author" value="<?php echo $author; ?>">
          </div>
          <div class="form-group">
            <label for="author">Tag</label>
            <input type="text" name="tag" class="form-control" id="tag" placeholder="Tag" value="<?php echo $tag; ?>">
          </div>
          <div style="display:flex;">

          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span id="topArticleTxt">Top Article</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="drop">
              <a class="dropdown-item" href="#" id="top">Top Article</a>
              <a class="dropdown-item" href="#" id="random">Random Article</a>
            </div>
          </div>&nbsp;&nbsp;&nbsp;

          <input type="hidden" name="topArticle" value="<?php echo $toparticle; ?>" id="topArticle">

            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Article Visibility
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="drop">
                <a class="dropdown-item" href="#" id="public">Publish Now</a>
                <a class="dropdown-item" href="#" id="private">Publish Later</a>
              </div>
            </div>

            <span class="input-group date publish_date" style="display: none;  margin-left:15px;">
              <label>Publishing Date</label>&nbsp;
              <div class="input-append date form_datetime" data-date="<?php echo date('Y-m-d'); ?>">
                <input size="18" type="text" value="" readonly name="toBePublished">
                <span class="add-on"><i class="fa fa-times" aria-hidden="true"></i></span>
                <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
              </div>
            </span>
            <input type="hidden" name="published" id="published" value="<?php echo $publishedDate; ?>">
          </div>

        </div>
      </div>
      <div class="mt-3"></div>
      <!-- SEO Inputs  -->
        <div class="card">
          <div class="card-header">
            <strong>Search Engine Optimization - SEO</strong>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="sub-title">Keywords<sup>&nbsp;*</sup></label>
              <input type="text" name="seokeys" class="form-control"  value="<?php echo $keywords; ?>">
            </div>
            <div class="form-group">
              <label for="sub-title">Description<sup>&nbsp;*</sup></label>
              <input type="text" name="seodescription" class="form-control"  value="<?php echo $description; ?>">
            </div>
          </div>
        </div>
        <!-- /. SEO Inputs  -->
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <strong>Article Image<sup>&nbsp;*</sup></strong>
          </div>
          <div class="card-body">
            <div class="form-group">
              <div id="image-preview" style="background-image:url(<?php echo base_url().'assets/public/images/blog/'.$image; ?>);">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload"/>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-3"></div>

        <div class="card">
          <div class="card-header">
            <strong>Update Settings</strong>
          </div>
          <div class="card-body">
            <input type="submit" name="save" value="Update Article" class="btn btn-primary" id="btnSub">

          </div>
        </div>

      </div>
    </div>

  </form>
  <div class="mb-4"></div>

  </div>
</div>
<?php if (isset($_SESSION['success']))
{
?>
<script type="text/javascript">
  swal("Updation Successful", "<?php echo $_SESSION['success']; ?>", "success");
  $(document).on('click', '.swal-button', function() {
    //window.location.href = "<?php //echo base_url(); ?>admin/blog";
  });
</script>
<?php
}
if (isset($_SESSION['error']))
{
?>
<script type="text/javascript">
  swal("Updation Failed", "<?php echo $_SESSION['error']; ?>", "error");
</script>
<?php
}
?>

<script type="text/javascript">
    $(document).ready(function (){
        $('.content-wrapper').on('click','#btnSub', function(){
            $('#publish').appendTo('#editor');
        });

     $(document).on('click','#public',function(event){
       event.preventDefault();
       $('#pstatus').addClass('badge-success').text('Now').removeClass('badge-danger');
       $('.publish_date').hide();
       $('#published').val(1);
     });

     $(document).on('click','#private',function(event){
       event.preventDefault();
       $('#pstatus').addClass('badge-danger').text('Later').removeClass('badge-success');
       $('.publish_date').show();
       $('#published').val(0);
     });


     //$('.publish_date').datetimepicker();
     $.uploadPreview({
       input_field: "#image-upload",   // Default: .image-upload
       preview_box: "#image-preview",  // Default: .image-preview
       label_field: "#image-label",    // Default: .image-label
       label_default: "Choose File",   // Default: Choose File
       label_selected: "Change File",  // Default: Change File
       no_label: false                 // Default: false
     });

     $(".form_datetime").datetimepicker({
        format: " yyyy-mm-dd HH:ii:ss",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
    });

    // Froala Editor
    $(function() {
     $('#froala-editor').froalaEditor({
       toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink', 'insertTable', '|', 'emoticons', 'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'undo', 'redo'],
       quickInsertTags: ['']
     })
    });

    $(document).on('click', '#top', function(event) {
      event.preventDefault();
      $('#topArticle').val(1);
      $('#topArticleTxt').text('Top Article');
    });

    $(document).on('click', '#random', function(event) {
      event.preventDefault();
      $('#topArticle').val(0);
      $('#topArticleTxt').text('Random Article');
    });

   });

</script>
