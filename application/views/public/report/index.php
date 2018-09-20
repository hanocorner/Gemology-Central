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
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <h1>GCL Online Report Verification</h1>
        <h4 id="noData"></h4>
        <div class="my-3 img-gem">
          <img src="" alt="" class="img-fluid" id="imgGem" width="80px" height="80px">
        </div>
        <table class="table borderless">
          <tbody>
            <tr>
              <td width="100">No.</td>
              <td id="repno"></td>
            </tr>
            <tr>
              <td width="100">Date</td>
              <td id="date"></td>
            </tr>
            <tr>
              <td width="100">Object</td>
              <td id="object"></td>
            </tr>
            <tr>
              <td width="100">Identification</td>
              <td id="identification"></td>
            </tr>
            <tr>
              <td width="100">Weight</td>
              <td id="weight"></td>
            </tr>
            <tr>
              <td width="100">Dimensions</td>
              <td id="dimension"></td>
            </tr>
            <tr>
              <td width="100">Cut</td>
              <td id="cut"></td>
            </tr>
            <tr>
              <td width="100">Shape</td>
              <td id="shape"></td>
            </tr>
            <tr>
              <td width="100">Color</td>
              <td id="color"></td>
            </tr>
            <tr>
              <td width="100">Comment</td>
              <td id="comment"></td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" value="<?php echo $reportno; ?>" id="reportid">
      </div>
    </div>
  </div>

</section>
<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
  report();
</script>
