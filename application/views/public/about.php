<style media="screen">
  .hero-banner {
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?php echo base_url(); ?>assets/images/about2_GCL.png);
    height: 200px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
  }
</style>
<!-- Hero  Banner -->
<section class="hero-banner">
  <div class="wrapper">
    <h1>About Gemology Central</h1>
  </div>
</section>
<!-- /. Hero  Banner -->

<div class="padding-2"></div>

<!-- Description Area -->
<section class="about-txt">
  <div class="wrapper">
    <div class="row">
      <h2>
        Why Gemology Central Laboratory (GCL) ?
      </h2>
      <br/><br/><br/>
      <p>
        Gemology Central Laboratory (GCL) is an independent international industry
        that provides professional colored Gemstones grading and gem identification service to gem and jewelry industry
      </p>
      <p>
        GCL is an independent gemological firm providing professional gem identification and grading services with reliability and economy to the gem and jewelry industry. Situated in a very bustling gem market, “Beruwala, Sri Lanka” we are able to render our services to a more client base.
         With hopes to enter into more markets we encourage our gemologist to pursue more professional knowledge on gemology and to consistently update with the gem and jewelry industry.
      </p>
    </div>
  </div>
</section>
<!-- /. Description Area -->

<!-- Related Artcles -->
<section class="my-2 rel-articles">
  <div class="wrapper">
    <div class="row">
      <div class="my-4">
        <h2>Few Articles Regarding Gemology</h2>
      </div>
      <div class="card-deck">
        <?php foreach ($recent as $key) { ?>
        <div class="card">
          <img class="card-img-top" src="<?php echo base_url(); ?>assets/public/images/blog/<?php echo $key->post_image; ?>" alt="<?php echo $key->post_url; ?>">
          <div class="card-body">
            <h5 class="card-title">
              <a class="abt-post-title" href="<?php echo base_url(); ?>blog/<?php echo $key->post_url; ?>">
                <?php echo ucwords($key->post_title); ?>
              </a>
            </h5>
            <div id="div-para" class="mr-5">
              <p>
                <?php echo $key->post_body; ?>
              </p>
            </div>
            <a href="<?php echo base_url(); ?>blog/<?php echo $key->post_url; ?>" class="btn mt-4">Continue Reading</a>
          </div>
        </div>
      <?php }  ?>
      </div>
    </div>
  </div>
</section>
<div class="padding-4"></div>
