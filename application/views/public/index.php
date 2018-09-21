<!-- Hero Carousel  -->
<section class="hero-carousel">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="<?php echo base_url(); ?>assets/public/images/slide-1.jpg" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h2>Welcome to Gemology Central Laboratory</h2>
          <p>We are an independent international industry that provides professional colored Gemstones grading and gem identification service to gem and jewelry industry</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="<?php echo base_url(); ?>assets/public/images/slide-2.jpg" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h2>GCL Report Verification</h2>
          <p>Verfiy your GCL Report quick and easy with our online system</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="<?php echo base_url(); ?>assets/public/images/slide-3.jpg" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h2>GCL Report Verification</h2>
          <p>Verfiy your GCL Report quick and easy with our online system</p>
        </div>
      </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
      <span class="sr-only">Next</span>
    </a>
  </div>
</section>
<!-- ./ Hero Carousel -->

<!-- Alumni Logos  -->
<section class="alumni">
  <div class="container-fluid">
    <div class="padding-1"></div>
    <div class="row">
      <div class="d-mb-bf mx-auto">
        <img class="img-fluid" src="<?php echo base_url()?>assets/public/images/gia-logo.png" />
        <img class="ml-5 img-fluid" src="<?php echo base_url()?>assets/public/images/gasl.png"/>
      </div>
    </div>
  </div>
  <div class="padding-1"></div>
</section>
<div class="py-5"></div>
<!-- Alumni Logos  -->

<!-- certificate -->
<section class="certificate">
  <div class="wrapper">
    <div class="row">
        <div class="col-md-6 d-flex bd-right">
            <img src="<?php echo base_url();?>assets/public/images/img_book.jpg" class="ml-auto mr-auto img-fluid"/>
        </div>
        <div class="py-2">
          <hr class="hr d-xs-block d-sm-block d-md-none d-lg-none d-xl-none">
        </div>
        <div class="col-md-6 d-flex align-items-center">
          <div class="px-md-4 px-sm-0">
          <div class="d-flex">
            <div class="cert-ball">
              <div class="cert-txt">
                <img src="<?php echo base_url();?>assets/public/images/medal.png" class="img-fluid"/>
              </div>
            </div>
            <h4 class="mt-2 ml-3">Verify your report for higher level of assurance</h4>
          </div>
            <div class="py-2"></div>
            <p>
              GCL provides the service of report verification for a higher assurance, by using this service you will be able to quickly confirm that the details on your report matches to the details  in GCL report database
            </p>
            <div class="py-1"></div>
            <a href="<?php echo base_url();?>report-verification" class="btn btn-primary">Click Here</a>
          </div>
        </div>
    </div>
  </div>
</section>
<!-- /. certificate -->
<div class="py-5"></div>

<section class="blog">
  <div class="py-4"></div>
  <div class="wrapper">
    <div class="row">

      <div class="col-md-6">
        <div class="float-right">
          <img width="500" height="300" class="img-fluid" src="<?php echo base_url();?>assets/public/images/blog/<?php echo $image; ?>" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="align-self-center ml-md-3 ml-sm-0 title">
          <h2><span class="headline left">From the blog</span></h2>
          <div class="py-2"></div>
          <h4><?php echo ucwords($title); ?></h4>
          <div id="charLimit" class="mr-5">
            <?php echo $body; ?>
          </div>
          <script type="text/javascript">
            var divPara = $('#charLimit');
            divPara.text(divPara.text().substring(0,300)+'...');
          </script>
          <div class="mt-3">
            <a href="<?php echo base_url(); ?>blog/<?php echo $url; ?>" class="btn btn-primary" style="letter-spacing:0.6px;">READ MORE</a>
          </div>
        </div>

      </div>

    </div>
  </div>
  <div class="py-4"></div>
</section>

<!-- Customer feedback  -->
<div class="py-3"></div>
<section class="feedback">
  <div class="container">
    <div class="row">
        <div class="block-text mx-auto">
          <h2 class="text-center headline center">What our Clients say</h2>
          <div class="py-2">
            <div>
              <p class="quote">
                Sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
              </p>
              <div class="py-3"></div>
              <div class="text-center">
                <h5>David Gomez</h5>
                <span class="client">
                  From USA - 20th July 2018
                </span>
              </div>
            </div>

          </div>
        </div>
    </div>
  </div>
</section>
<!-- Customer feedback -->
<div class="py-4"></div>
