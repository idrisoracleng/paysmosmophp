 <style type="text/css">
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
</style>
<div id="content" class="site-content">
                <div class="col-full">
                    <div class="row">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="col-md-12">
                                <p class="alert alert-<?php echo $this->session->flashdata('flag'); ?> text-center">
                                    <?php echo $this->session->flashdata('msg'); ?>
                                </p>
                            </div>
                        <?php } ?>
                        <nav class="woocommerce-breadcrumb">
                            <a href="<?php echo base_url();?>">Home</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>My Account
                        </nav>
                        <!-- .woocommerce-breadcrumb -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <div class="entry-content">
                                        <div class="woocommerce">
                                            <div class="customer-login-form">
                                                <span class="or-text">or</span>
                                                <div id="customer_login" class="u-columns col2-set">
                                                    <div class="u-column1 col-1">
                                                        <h2>Login</h2>
                                <form method="post" class="woocomerce-form woocommerce-form-login login" action="<?php echo site_url('/buyer/login') ?>" msg="Logging In">
                                                             
                                                            <p class="form-row form-row-wide">
                                                                <label for="username">Email address
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <input class="input-text" type="email" name="email" id="username" value="" required/>
                                                            </p>
                                                            <p class="form-row form-row-wide">
                                                                <label for="password">Password
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <input class="input-text" type="password" name="password" id="password-login" required/>
																<span toggle="#password-login" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                            </p>
															<p class="form-row" style="text-align: right;" >
                                                               
                                                                <a style="color:red; text-align:right;" href="#" data-toggle="modal" data-target="#forgetPassword">Forget Password</a>
                                                            </p>
                                                            <p class="form-row">
                                                                <input class="woocommerce-Button button m-3" type="submit" value="Login" name="login">
                                                               <!-- <a href="#" type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#forgetPassword">Forget Password</a>-->
                                                            </p>
                                                        </form>
                                                        <!-- .woocommerce-form-login -->
                                                    </div>
                                                    <!-- .col-1 -->
                                                    <div class="u-column2 col-2">
                                                        <h2>Register</h2>
                                                       
                                                        <form class="register" action="<?php echo site_url('/account/register') ?>" method="POST" msg="Registration in progress..." enctype="multipart/form-data">
                                                           
                                                            <p class="form-row form-row-wide">
                                                                <label for="reg_email">First Name
                                                                    <span class="required">*</span>
                                                                </label>
                                                                
                                                                <input 
                                                                    type="text" 
                                                                    name="first_name" 
                                                                    class="woocommerce-Input woocommerce-Input--text input-text" required >
                                                            </p>
                                                            <p class="form-row form-row-wide">
                                                                <label for="reg_email">Last Name
                                                                    <span class="required">*</span>
                                                                </label>
                                                                
                                                                <input 
                                                                    type="text" 
                                                                    name="last_name" 
                                                                    class="woocommerce-Input woocommerce-Input--text input-text" required >
                                                                <input type="hidden" name="acct_type" class="form-control" value="buyer" readonly>
                                                            </p>
                                                            <p class="form-row form-row-wide">
                                                                <label for="reg_email">Email address
                                                                    <span class="required">*</span>
                                                                </label>
                                                                
                                                                <input 
                                                                    type="email" 
                                                                    name="email" 
                                                                    id="reg_email" 
                                                                    class="woocommerce-Input woocommerce-Input--text input-text" required >
                                                            </p>
                                                            <p class="form-row form-row-wide">
                                                                <label for="reg_password">Password
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <input 
                                                                    type="password" 
                                                                    name="password" 
                                                                    id="reg_password" 
                                                                    class="input-text" required>
																	<span toggle="#reg_password" class="fa fa-fw fa-eye field-icon toggle-password">
                                                            </p>
                                                            <p class="form-row form-row-wide">
                                                                <label for="reg_email">Organization
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <select name="cooperative_id" class="" id="cooperatives" required>
                                                                   <option selected disabled>Select organization</option>
                                                                    <option value="no_cooperative">My organization is not here</option>
                                                                    <?php
                                                                    $cooperatives = $this->db->get_where('cooperatives', ['active' => 1])->result(); 
                                                                    foreach ($cooperatives as $Key => $cooperative) { ?>
                                                                      <option value="<?php echo $cooperative->cooperative_id; ?>"><?php echo $cooperative->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </p>
                                                            <p class="form-row form-row-wide">
                                                                <label for="reg_password">Referral Code
                                                                </label>
                                                                <input 
                                                                    type="text" 
                                                                    name="referred_by" 
                                                                    id="referred_by" 
                                                                    class="woocommerce-Input woocommerce-Input--text input-text" 
                                                                    value="<?php echo $ref ?>" />
                                                            </p>
                                                            <div id="no_cooperative_credentials" style="display: none">
                                                                <p>Please upload the following documents</p>
                                                                <p class="form-row form-row-wide">
                                                                    <label for="reg_email">Id Card
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <input type="file" name="id_card" />
                                                                </p>
                                                                <p class="form-row form-row-wide">
                                                                    <label for="reg_email">Bank Statement
                                                                        <span class="required">*</span>
                                                                    </label>
                                                                    <input type="file" name="bank_statement" />
                                                                </p>
                                                            </div>
                                                            
                                                            
                                                            <p class="form-row">
                                                                <input type="submit" class="woocommerce-Button button" name="register" value="Register" />
                                                            </p>
                                                            <div class="register-benefits">
                                                                <h3>Sign up today and you will be able to :</h3>
                                                                <ul>
                                                                    <li>Speed your way through checkout</li>
                                                                    <li>Track your orders easily</li>
                                                                    <li>Keep a record of all your purchases</li>
                                                                </ul>
                                                            </div>
                                                        </form>
                                                        <!-- .register -->
                                                    </div>
                                                    <!-- .col-2 -->
                                                </div>
                                                <!-- .col2-set -->
                                            </div>
                                            <!-- .customer-login-form -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    <!-- .entry-content -->
                                </div>
                                <!-- .hentry -->
                            </main>
                            <!-- #main -->
                        </div>
                        <!-- #primary -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .col-full -->
            </div>

<div class="modal fade" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="forgetPasswordTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Forget Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form msg="Requesting Password Reset..." method="POST" action="<?php echo site_url('account/request_password_reset'); ?>">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Email"  />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary">Retrieve Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
 $(document).ready(function () {
     $("#no_cooperative_credentials").hide();
     $("#cooperatives").change(function () {
        if ($(this).val() == 'no_cooperative') {
            $("#no_cooperative_credentials").show();
        } else {
            $("#no_cooperative_credentials").hide();
        }
     });
	$(".toggle-password").click(function() {

	  $(this).toggleClass("fa-eye fa-eye-slash");
	  var input = $($(this).attr("toggle"));
	  if (input.attr("type") == "password") {
		input.attr("type", "text");
	  } else {
		input.attr("type", "password");
	  }
	});
});
</script>