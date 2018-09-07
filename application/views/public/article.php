<div class="py-3"></div>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1><?php echo ucwords($title); ?></h1>

      <div class="py-3"></div>

      <div class="blog-img">
        <a href="#" title="click here to visit image site">
          <img width="750" height="420" class="img-fluid" src="<?php echo base_url(); ?>assets/public/images/blog/<?php echo $image; ?>" alt="<?php echo $url; ?>">
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

      <div class="py-5"></div>
      <div class="recent my-4 bg-dark">
        <p>Social Media</p>
      </div>

      <div class="py-5"></div>

      <div class="comment-top">
        <h4>Leave a Reply</h4>
        <p>Your email address will not be published. Required fields are marked *</p>
      </div>
      <div class="col-md-6 pl-0">
        <div class="py-3"></div>
        <form method="post">
          <div class="form-group">
            <label for="customername">Comment<sup>*</sup></label>
            <textarea id="ccomment" rows="8" cols="100"></textarea>
          </div>
          <div class="form-group">
            <label for="customername">Name<sup>*</sup></label>
            <input type="text" class="form-control" id="cname" >
          </div>
          <div class="form-group">
            <label for="email">Email<sup>*</sup></label>
            <input type="email" class="form-control" id="cmail" >
          </div>
          <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
      </div>
      <div class="py-4"></div>
    </div>

    <div class="col-md-4 col-sm-6">
      <div class="input-group mb-3">
        <input type="text" name="search" id="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div id="result"></div>
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
      <div class="py-3"></div>

      <div class="blog-social-media">
        <h5 class="text-center">Follow Us</h5>
        <a href="#" class="fa facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="fa twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="fa google"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        <a href="#" class="fa instagram"><i class="fa fa-instagram"></i></a>
      </div>
      <div class="py-4"></div>

      <img class="card-img-top img-fluid" src="<?php echo base_url(); ?>assets/public/images/blog_1.png" alt="Card image cap">

      <div class="recent my-4 bg-dark">
        <p>Related Articles</p>
      </div>

      <?php foreach ($related as $key) { ?>
        <div class="rl-articles">
          <a class="rel-img" href="<?php echo base_url(); ?>blog/<?php echo $key->post_url; ?>">
            <div class="d-flex my-3 align-items-center">
              <img width="60" height="50" src="<?php echo base_url(); ?>assets/public/images/blog/<?php echo $key->post_image; ?>" alt="<?php echo $key->post_url; ?>">&nbsp;&nbsp;
              <h6><?php echo ucwords($key->post_title); ?></h6>
            </div>
          </a>
        </div>
      <?php } ?>
    </div>

  </div>
</div>
