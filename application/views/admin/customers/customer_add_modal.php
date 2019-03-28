<!-- Customer add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mx-auto" id="ajaxLoader"></div>
                <?php $attributes = array('id' => 'formAddCustomer'); ?>
                <?php echo form_open('admin/customers/customer/add', $attributes); ?>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="firstname" placeholder="First name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="lastname" placeholder="Last name">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <input type="text" class="form-control" name="number" placeholder="Number">
                    </div>
                    <div class="col">
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Email (optional)">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal" onclick="document.getElementById('formAddCustomer').reset();">Cancel</button>
                <a href="#" class="btn btn-primary" data-action="adCustomer">Submit</a>
            </div>
        </div>
    </div>
</div>