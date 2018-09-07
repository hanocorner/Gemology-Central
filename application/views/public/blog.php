<div class="py-3"></div>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6">
      <div class="card">
        <img class="card-img-top" src="<?php echo base_url(); ?>assets/public/images/blog/<?php echo $image; ?>" alt="<?php echo $url; ?>">
        <div class="card-body top-article">
          <h3 class="card-title"><a href="<?php echo $url; ?>"><?php echo ucwords($title); ?></a></h3>
          <div id="topArtPara" class="mr-5">
            <p class="card-text">
              <?php echo $body; ?>
            </p>
          </div>
          <script type="text/javascript">
            var divPara = $('#topArtPara');
            divPara.text(divPara.text().substring(0,300)+'...');
          </script>
          <div class="mt-3">
            <a href="<?php echo base_url(); ?>blog/<?php echo $url; ?>" class="btn">Continue Reading</a>
          </div>
        </div>
      </div>

      <div class="recent my-4 bg-dark">
        <p>Recent Post</p>
      </div>

      <div class="card-deck">
        <?php foreach ($recent as $key) { ?>
        <div class="card" style="width: 18rem;">
          <a href="<?php echo base_url(); ?>blog/<?php echo $key->post_url; ?>" title="<?php echo ucwords($key->post_title); ?>">
            <img class="card-img-top" src="<?php echo base_url(); ?>assets/public/images/blog/<?php echo $key->post_image; ?>" alt="<?php echo $key->post_url; ?>">
          </a>
          <div class="card-body">
            <h5 class="card-title"><?php echo ucwords($key->post_title); ?></h5>
            <div id="relPara" class="mr-5">
              <p class="card-text">
                <?php echo $key->post_body; ?>
              </p>
              <script type="text/javascript">
                var divPara = $('#relPara');
                divPara.text(divPara.text().substring(0,300)+'...');
              </script>
            </div>
            <div class="mt-3">
              <a href="<?php echo base_url(); ?>blog/<?php echo $key->post_url; ?>" class="btn">Continue Reading</a>
            </div>
          </div>
        </div>
        <div class="py-4"></div>
      <?php } ?>

      </div>

      <div class="py-4"></div>

    </div>
    <div class="col-md-4 col-sm-6">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
    </div>

  </div>
</div>
<div class="py-3"></div>
