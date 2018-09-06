<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact us</h5>

      </div>
      <div class="modal-body">
        <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp; +94 112485560</p><br>
        <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; info@gemologycentral.com</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /. Modal  -->

<footer>
  <section class="footer-top bg-dark">
    <div class="padding-3"></div>
    <div class="wrapper">
      <div class="row">
        <div class="col-md-6 about-brief">
          <img src="<?php echo base_url()?>assets/public/images/gcl-white-logo.png" class="img-fluid" id="logo_footer"/>
          <p style="color: #fff;" class="mt-2 pr-4">
            Gemology Central Laboratory (GCL) is an independent international industry
            that provides professional colored Gemstones grading and gem identification service to gem and jewelry industry.
          </p>
        </div>

        <div class="col-md-4 contact-info">
          <p>For More Information</p>
          <ul>
            <li><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;  GTC NO.4, 44/2R China Fort Road, 44/2R Sheik Fassy Mawatha, Beruwala. Sri Lanka</li>
            <li><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp; +94 77 469 5151</li>
            <li><a href="mailto:info@gemologycentral.com?Subject=Enquire%20gem" target="_top"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp; info@gemologycentral.com</a></li>
          </ul>
        </div>

        <div class="col-md-2 social-media">
          <p>Keep In Touch</p>
          <ul>
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>&nbsp;&nbsp; facebook</a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i>&nbsp;&nbsp; twitter</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="footer-bottom">
    <div class="wrapper">
      <div class="padding-1"></div>
      <div class="row">
        <div class="col-md-7 copyright"><p>&copy; Copyrights 2018 <span>&nbsp; Designed by <a href="https://smartsoftware.lk/" target="_blank">smartsoftware.lk</a></span></p></div>
        <div class="col-md-5">
          <ul class="urls">
            <li><a href="#">Home</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Cookies</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</footer>
<a href="javascript:" class="scroll-top" id="return-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>


  <script src="<?php echo base_url(); ?>node_modules/slick-carousel/slick/slick.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var scrolltop = $("#return-to-top");
      $(window).scroll(function() {
        if ($(this).scrollTop() >= 600) {
          scrolltop.fadeIn(200); // Fade in the arrow
        } else {
          scrolltop.fadeOut(200); // Else fade out the arrow
        }
      });
      scrolltop.click(function() {
        // When arrow is clicked
        $("body,html").animate(
          {
            scrollTop: 0 // Scroll to top of body
          },
          500
        );
      });

      $(".slider-for").slick({
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        autoplay:true
      });

    });
  </script>


    </body>
</html>
