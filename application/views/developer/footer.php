<footer class="sticky-footer">
  <div class="container">
    <div class="text-center">
      <small>Copyright © Gemology 2018</small>
    </div>
  </div>
</footer>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url();?>assets/js/sb-admin.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/froala_editor.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/align.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/draggable.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/link.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/lists.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/paragraph_format.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/paragraph_style.min.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/notify.js"></script>

  <script>
      $(function(){
        $('#edit')
          .on('froalaEditor.initialized', function (e, editor) {
            $('#edit').parents('form').on('submit', function () {
              console.log($('#edit').val());
              //return false;
            })
          })
          .froalaEditor({enter: $.FroalaEditor.ENTER_P, placeholderText: null})
      });
  </script>

  <?php
    if (isset($message))
    {

    ?>
    <script>
      $(".breadcrumb").notify(<?php echo $message; ?>, <?php echo $status; ?>);
    </script>
    <?php
    }
    ?>

</body>

</html>
