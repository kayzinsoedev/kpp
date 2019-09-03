<?php $this->view('inc/header') ?>

<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">
                    <strong>Change Password</strong>
                </h2>
                <hr>
                <form name="change_password" class="change_password" method="POST" action="<?=base_url('user/change_password/')?>">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                    </div>
                    <p class="help-block small"></p>
                    <button type="submit" class="btn btn-primary">Update Password <i class="fa fa-user-o" aria-hidden="true"></i> </button>
                    <a href="<?=base_url("/")?>" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <div class="push"></div>

</div>

<?php $this->view('inc/footer') ?>
