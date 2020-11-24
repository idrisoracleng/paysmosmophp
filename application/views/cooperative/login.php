<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <img style="width: 300px;" src="<?php echo site_url('public/images/system/sys/paysmosmo.png'); ?>"/>
            </div>
            <div class="col-md-9 col-lg-8 mx-auto">
						<?php //echo password_hash('dolapo2015', PASSWORD_DEFAULT); ?>
              <h3 class="login-heading mb-4 text-center">Cooperative Login</h3>
              <form class="form" action="<?php echo site_url('/cooperative/login') ?>" method="POST" msg="Logging In">
                <div class="form-group">
                  <label for="">Email address</label>
                  <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                </div>

                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
                <div class="text-center">
                  <a class="small" href="#">Forgot password?</a></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>