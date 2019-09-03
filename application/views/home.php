<?php $this->view('inc/header') ?>

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">
                    <strong>Sign In</strong>
                </h2>
                <hr>
                  <form name="sign_in" class="sign_in" method="POST" action="<?=base_url('Home/sign_in/')?>">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email ID" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <p class="help-block small"></p>
                    <button type="submit" class="btn btn-primary">Sign In <i class="fa fa-sign-in" aria-hidden="true"></i> </button>
                </form>
            </div>
        </div>
    </div>
    <div class="push"></div>

</div>

<?php $this->view('inc/footer') ?>
