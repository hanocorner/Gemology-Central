<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                Customers
            </li>
        </ol>
        <!-- /. of Breadcrumbs-->

        <div class="grid-nav">
            <div class="form-group mb-0">
                <span class="mr-2">Show</span>
                <select id="rowCount" style="width:3rem;">
                    <option selected="selected">10</option>
                    <option>15</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span class="mx-2">entries</span>
            </div>

            <a href="#" class="text-primary" data-action="reloadCustomer"><i class="fa fa-refresh fa-fw" aria-hidden="true"></i>
                Refresh</a>
            <input type="text" class="mx-3" id="searchCst" autocomplete="off" placeholder="Search by name or number..." style="width:15rem;">

            <a href="#" class="btn btn-primary btn-sm ml-auto" data-action="add"><i class="fa fa-plus fa-fw"
                    aria-hidden="true"></i> Add Customer</a>
        </div>

        <div id="allCustomerData"></div>

    </div>
</div>

<?php echo $add_modal; ?>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mx-auto" id="eLoader"></div>
                <?php $attributes = array('id' => 'formEditCustomer'); ?>
                <?php echo form_open('admin/customers/customer/update', $attributes); ?>
                <input type="hidden" name="custid" value="" id="customerEditId">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" id="eFname" name="firstname" placeholder="First name">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="eLname" name="lastname" placeholder="Last name">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <input type="text" class="form-control" id="eNumber" name="number" placeholder="Number">
                    </div>
                    <div class="col">
                        <input type="email" class="form-control" id="eEmail" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Email (optional)">
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal" onclick="document.getElementById('formEditCustomer').reset();">Cancel</button>
                <a href="#" data-action="editCustomer" data-id="" class="btn btn-warning update">Update</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delModalLabel">Delete Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <span class="text-danger"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                    Are you sure you want to delete this customer?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <a href="#" id="deleteCustomerBtn" data-action="deleteCustomer" data-id="" data-csrf="<?php echo $this->security->get_csrf_hash();?>"
                    class="btn btn-danger delete">Delete</a>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="cstid" value="" id="cstid">