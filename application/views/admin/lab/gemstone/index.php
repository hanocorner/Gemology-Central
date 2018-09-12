<style>
input[type="search"]::-webkit-search-cancel-button {
  -webkit-appearance: searchfield-cancel-button;
}
.dropdown-menu li .dropdown-links {
  color: #454545;
}
.dropdown-menu li .dropdown-links:hover {
  color: #007bff;
  text-decoration: none;
}
.search-btn {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
.btn-print{
  background-color: #6434b3;
  color: #fff;
}
.img-preview {
  border: 1px solid #c6c6c6;
  box-shadow: 3px 2px rgb(203,203,203);
}
.form-control {
  margin-right: 15px;
}
</style>

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">
        All Customers
      </li>
    </ol>
    <!-- /. of Breadcrumbs-->



    <div class="padding-1"></div>


  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

<!--Delete modal-->
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this report ? </p>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-danger" data-id="" id="deltrue">Yes</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Don't</button>
            </div>
        </div>
    </div>
</div>

<!--  preview modal-->
  <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4>Gemstone Report</h4>
              </div>
              <div class="modal-body">
                <div id="preModalData"></div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-label="Close">Close</button>
              </div>
          </div>
      </div>
</div>

<!-- Js -->
<script type="text/javascript">
  $(document).ready(function() {


    // Preview Modal
    $(document).on('click', '#preID', function() {
      var crno = $(this).data('id');

      preview('<?php echo base_url(); ?>', crno, function (result) {
        $('#preModalData').html(result);
      });
    });

    // Payment Status - Paid
    $(document).on('click', '.paid', function(event) {
      event.preventDefault();
      var crno = $(this).data('id');
      var status = $('.paid').data('status');
      payment('<?php echo base_url(); ?>', crno, status);
    });

    // Payment Status - Unpaid
    $(document).on('click', '.unpaid', function(event) {
      event.preventDefault();
      var crno = $(this).data('id');
      var status = $('.unpaid').data('status');
      payment('<?php echo base_url(); ?>', crno, status);
    });

    // Append Data ID on 'Delete' button
    $(document).on('click', 'a.delete', function() {
      var crno = $(this).data('id');
      $('#deltrue').attr('data-id', crno);
    });

    //Delete Gemstone Report on 'Yes'
    $(document).on('click', '#deltrue', function(event) {
      event.preventDefault();
      var crno = $(this).data('id');
      var status = $('.unpaid').data('status');
      deleteReport('<?php echo base_url(); ?>', crno);
    });

  });
</script>
<!-- Alert box -->
<?php
if (isset($_SESSION['message']))
{
  if ($_SESSION['status'] == 'success')
  {
    ?>
    <script type="text/javascript">
      swal("Task Successful", "<?php echo $_SESSION['message']; ?>", "success");
    </script>
    <?php
  }

  if ($_SESSION['status'] == 'error')
  {
    ?>
    <script type="text/javascript">
      swal("Task Unsuccessful", "<?php echo $_SESSION['message']; ?>", "error");
    </script>
    <?php
  }
}
?>
<!-- /. Alert box -->
