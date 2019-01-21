<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a>
            </li>
        </ol>

        <div class="card-deck mt-4">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h3>Quick Access</h3>
                    <p>
                        Your search did not match any documents. Please make sure that all
                        words are spelled correctly and that you've selected enough
                        categories.
                    </p>

                    <div class="d-flex flex-row mt-3">
                        <a href="<?php echo base_url('admin/report/add'); ?>" class="btn btn-primary mr-3">Add Report</a>
                        <a href="<?php echo base_url('admin/customer/add'); ?>" class="btn btn-outline-primary">Add
                            Customer</a>
                    </div>
                </div>
            </div>
            <div class="card dashboard-card">
                <div class="card-body">
                    <h3>From the blog</h3>
                    <p>
                        Your search did not match any documents. Please make sure that all
                        words are spelled correctly and that you've selected enough
                        categories.
                    </p>

                    <div class="d-flex flex-row align-items-center mt-3">
                        <p class="mr-3"><i class="fa fa-bell fa-fw"></i> <span>You have (0) comments(s)</span></p>
                        <a href="" class="btn btn-primary">See Comments</a>
                    </div>
                </div>
            </div>

            <div class="card dashboard-card">
                <div class="card-body">
                    <h3>Latest activities</h3>
                    <div class="d-block mx-auto mt-3" id="spinner"></div>
                    <div id="latestActivity"></div>
                </div>
            </div>

        </div>
    </div>
</div>