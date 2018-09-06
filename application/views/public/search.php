<div class="py-3"></div>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1><?php echo ucwords($title); ?></h1>

      <div class="py-3"></div>

      <div class="blog-img">
        <a href="#" title="click here to visit image site">
          <img width="750" height="420" class="img-fluid" src="<?php echo base_url(); ?>assets/images/blog/<?php echo $image; ?>" alt="<?php echo $url; ?>">
        </a>
      </div>

      <div class="py-1"></div>

      <div class="meta-data">
        <span><?php echo $date; ?>&nbsp;By <?php echo $author; ?> - Category <?php echo $tag; ?></span>
      </div>

      <div class="py-3"></div>

      <div class="body">
        <?php echo $body; ?>
      </div>
    </div>

    <div class="col-md-4 col-sm-6">
      <div class="input-group mb-3">
        <input type="text" name="search" id="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div id="result"></div>
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
        </div>
      </div>
      <div class="py-3"></div>

      <div class="social-media">
        <h5 class="text-center">Follow Us</h5>
        <a href="#" class="fa facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="fa twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="fa google"><i class="fab fa-google-plus-g"></i></a>
        <a href="#" class="fa instagram"><i class="fab fa-instagram"></i></a>
      </div>
      <div class="py-4"></div>

      <img class="card-img-top img-fluid" src="<?php echo base_url(); ?>assets/images/blog_1.png" alt="Card image cap">

      <div class="recent my-4">
        <p>Related Articles</p>
      </div>

      <?php foreach ($related as $key) { ?>
        <div style="display:block;">
          <a class="rel-img" href="<?php echo base_url(); ?>blog/<?php echo $key->post_url; ?>">
            <div style="display:flex;">
              <img width="60" height="50" src="<?php echo base_url(); ?>assets/images/blog/<?php echo $key->post_image; ?>" alt="<?php echo $key->post_url; ?>">&nbsp;&nbsp;
              <?php echo $key->post_title; ?>
            </div>
          </a>
        </div>
      <?php } ?>
    </div>

  </div>
</div>
