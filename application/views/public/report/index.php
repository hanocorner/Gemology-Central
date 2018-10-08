<style media="screen">
.borderless td, .borderless th {
  border: none;
}
.table td {
  padding: .45rem;
}
.img-gem img {
  margin: 0 10px;
}
</style>
<section class="report mt-3">
  <div class="wrapper">
    <div class="row">
      <div class="col-md-4">
        <h3>Gemology Central Laboratory Report</h3>
        <div class="my-3" id="messageBox"></div>

        <div class="my-3 img-gem">
          <img src="" alt="" class="img-fluid" id="imgGem" width="80px" height="80px">
        </div>
        <table class="table borderless" id="table">
          <tbody>
            <tr>
              <td width="120"><strong>Number:</strong></td>
              <td id="repno"></td>
            </tr>
            <tr>
              <td width="120"><strong>Date:</strong></td>
              <td id="date"></td>
            </tr>
            <tr>
              <td width="120"><strong>Object:</strong></td>
              <td id="object"></td>
            </tr>
            <tr>
              <td width="120"><strong>Variety:</strong></td>
              <td id="variety"></td>
            </tr>
            <tr>
              <td width="120"><strong>Species/Group:</strong></td>
              <td id="spgroup"></td>
            </tr>
            <tr>
              <td width="120"><strong>Weight:</strong></td>
              <td id="weight"></td>
            </tr>
            <tr>
              <td width="120"><strong>Dimensions:</strong></td>
              <td id="dimension"></td>
            </tr>
            <tr>
              <td width="120"><strong>Shape & Cut:</strong></td>
              <td id="shapecut"></td>
            </tr>
            <tr>
              <td width="120"><strong>Color:</strong></td>
              <td id="color"></td>
            </tr>
            <tr>
              <td width="120"><strong>Comments:</strong></td>
              <td id="comment"></td>
            </tr>
          </tbody>
        </table>
        <div class="my-4"></div>
        <input type="hidden" value="<?php echo $reportno;?>" id="reportid">
      </div>
    </div>
  </div>

</section>
<?php if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443): ?>
  <script type="text/javascript">
    var baseurl = "<?php echo 'https://gemologycentral.com/'; ?>";
  </script>
<?php else: ?>
  <script type="text/javascript">
    var baseurl = "<?php echo 'http://gemologycentral.com/'; ?>";
  </script>
<?php endif; ?>

<script type="text/javascript">
  var csrfname = '<?php echo $csrfname; ?>';
  var csrfhash = '<?php echo $csrfhash; ?>';
  report();
</script>
