<div class="container">
    <div class="card card-d-login mt-5 mx-auto">
        <div class="card-header text-center bg-dark text-white">Gemology Central Laboratory </div>
        <div class="card-body">
            <!-- Alert box -->
            <div id="messageBox"></div>
            <!-- /. Alert box -->

            <?php $attr = array('id'=>'formLogin', 'method'=>'post'); ?>
            <?php echo form_open('admin/dashboard/login/authenticate', $attr);?>
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" id="username" type="text" name="username" autocomplete="off">

            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" id="password" type="password" name="password" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary mt-3" id='login'>Login</button>
            <?php echo form_close();?>
        </div>
    </div>
</div>