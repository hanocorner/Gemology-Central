
<div class="content-wrapper">
    <div class="container-fluid">

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">Report</li>
            <li class="breadcrumb-item active">Drafts</li>
        </ol>
    </div>

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-4">
                <?php echo form_open('admin/report/draft/handler/add', array('id'=>'addReportDraft')); ?>
                <h4 class="mb-3">Add Draft</h4>
                <!-- <div class="form-row mt-3"> -->
                <div class="form-group">
                    <div class="ui-widget">
                        <input id="customer" autocomplete="off" class="form-control form-control-sm"
                            placeholder="Customer">
                        <input type="hidden" id="customerID" name="cstid" value="">
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="form-group col-6">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-primary" id="option1" data-value="memo">
                                <input type="radio" name="options"> Memocard
                            </label>
                            <label class="btn btn-sm btn-primary" id="option2" data-value="repo">
                                <input type="radio" name="options"> Full Report
                            </label>
                            <label class="btn btn-sm btn-primary" id="option3" data-value="verb">
                                <input type="radio" name="options"> Verbal
                            </label>
                        </div>
                        <input type="hidden" name="repotype" id="repotype" value="">
                    </div>
                    <div class="form-group col-6">
                        <input type="text" name="reportid" id="repid" class="form-control form-control-sm"
                            aria-describedby="helpId" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <input type="text" class="form-control form-control-sm" name="weight" placeholder="Weight">
                    </div>
                    <div class="form-group col-6">
                        <input type="text" class="form-control form-control-sm" name="shapecut" id="shapecutField"
                            autocomplete="off" placeholder="Shapecut">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-sm" name="color" id="colorField"
                        autocomplete="off" placeholder="color">
                </div>
                <div class="form-group">
                    <a href="#" class="btn btn-sm btn-primary px-3 btn-save" data-action="saveDraft"> <i
                            class="fa fa-floppy-o fa-fw"></i> Save </a>
                </div>
                <!-- </div> -->
                <?php echo form_close(); ?>
            </div>
            <div class="col-4 offset-4">
                <div class="d-flex flex-column align-items-center">
                    <img src="<?php echo base_url('images/qr-code.png'); ?>" class="img-fluid" alt="qr">
                    <div id="downlaodQrBtn"></div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid my-2">
        <!-- Grid nav -->
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
            
            <a href="#" class="text-primary ml-2" data-action="reload"><i class="fa fa-refresh fa-fw"
                    aria-hidden="true"></i>
                Refresh</a>
            <input type="text" class="mx-3" id="searchId" autocomplete="off" placeholder="Search by id, customer">
            
            <a target="_blank" href="" id="btnPrint" class="btn btn-dark btn-sm mx-2"> <i class="fa fa-print fa-fw"
                    aria-hidden="true"></i> Print Receipt</a>


            <a href="/admin/report/add/" class="btn btn-primary btn-sm ml-auto"><i class="fa fa-plus fa-fw"></i> Add
                Report</a>

        </div>
        <!-- /. of Grid nav -->
    </div>

    <div class="container-fluid">
        <div id="draftTable"></div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?php echo base_url('images/wallet.png');?>" class="img-fluid d-block mx-auto" alt="wallet">
                <p class="text-center">Select payment status and fill the required field(s) </p>
                <?php echo form_open('admin/report/draft/handler/payment', array('id'=>'paymentForm')); ?>
                <input type="hidden" id="pRepId" value="" name="p_repid">
                <input type="hidden" id="pRepType" value="" name="p_reptype">
                <div class="form-row align-items-center justify-content-center">
                    <div class="form-group col-5">
                        <select class="form-control" id="pStatus" name="p_status">
                            <option value="unpaid">Unpaid</option>
                            <option value="paid-advance">Paid - Advance</option>
                            <option value="paid-full">Paid - Full amount</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <input type="text" class="form-control" id="" placeholder="Amount" name="price" autocomplete="off" />
                    </div>
                    <div class="form-group col-3" style="display:none;" id="adField">
                        <input type="text" class="form-control"  placeholder="Advance" name="advance" autocomplete="off" />
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <div class="modal-footer">
                <a href="#" class="btn btn-light" data-dismiss="modal"> Cancel</a>
                <a href="#" data-action="saveAmount" class="btn btn-primary" id="payBtnSave">Save</a>
            </div>

        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?php echo base_url('images/trash.png');?>" class="img-fluid d-block mx-auto mb-2" alt="wallet">
                <p class="text-center mb-1">Do you wish to delete this record? </p>
                <p class="text-center font-weight-bold" id="spRepId"></p>
                <input type="hidden" id="dRepId" value="">
                <input type="hidden" id="dRepType" value="">
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-light" data-dismiss="modal"> Cancel</a>
                <a href="#" data-action="deleteReport" class="btn btn-danger" id="">Yes</a>
            </div>

        </div>
    </div>
</div>