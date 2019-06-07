<div class="container">
    <div class="card card-d-login mt-5 mx-auto">
        <div class="card-header text-center bg-dark text-white">Gemology Central Laboratory </div>
        <div class="card-body">
            <!-- Alert box -->
            <div id="alertBox"></div>
            <!-- /. Alert box -->

            <?php echo form_open('admin/dashboard/login/authenticate', array('id'=>'formLogin'));?>
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" id="username" type="text" name="username" autocomplete="off">

            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" id="password" type="password" name="password" autocomplete="off">
            </div>
            <button type="button" class="btn btn-primary mt-3" id='logMeIN'>Login</button>
            <?php echo form_close();?>
        </div>
    </div>
</div>