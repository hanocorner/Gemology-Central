<style media="screen">
  .list-group a:hover{
    text-decoration: none;
  }
</style>
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">My Dashboard</li>
    </ol>
    <!-- /. of Breadcrumbs-->

    <div class="padding-1"></div>

    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Hello <?php echo ucwords($username); ?></h5>
            <p class="card-text">Welcome to the administrtaion area. Please make a selection from the links on your left.</p>
            <a href="#" id="linkShow"class="btn btn-primary">Go to Links</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Need Help ?</h5>
            <p class="card-text">If you have any questions, Simply hit the "Open a Ticket" and we are happy to assist you. </p>
            <a href="#" data-toggle="modal" data-target="#mailModal" data-whatever="support@smartsoftware.lk" class="btn btn-dark">Open a Ticket</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Comments from the Blog</h5>
            <p class="card-text">You have some new comments&nbsp;&nbsp;
              <span class="badge badge-danger"><?php //echo $noOfComments; ?></span>
            </p><br/>
            <a href="<?php echo base_url(); ?>admin/comment" class="btn btn-primary">Go to comments</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pending Certificates</h5>
            <p class="card-text">No.of unpaid certificates&nbsp;&nbsp; <span class="badge badge-danger"><?php //echo $total_unpaid_certificates; ?></span> </p><br/>
            <a href="<?php echo base_url(); ?>admin/report" class="btn btn-dark">Verify it Now</a>
          </div>
        </div>
      </div>

    </div>

    <div class="padding-3"></div>

    </div>
  </div>
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->

  <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" value="support@smartsoftware.lk">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#linkShow', function(event) {
      event.preventDefault();
      $("#exampleAccordion").notify(
        "I'm to the right of this box",
        { position:"right top" }
      );
    });
  });
</script>
