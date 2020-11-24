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
                                                <!-- <span class="or-text">or</span> -->
                                                <div id="customer_login" class="u-columns col2-set">
                                                    <div class="u-column1 col-1">
                                                        <h2>Reset Password</h2>
                                <form method="post" class="woocomerce-form woocommerce-form-login login" action="<?php echo site_url('/account/reset') ?>" msg="Resetting password...">
                                                             
                                                            <p class="form-row form-row-wide">
                                                                <label for="username">New Password
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <input class="input-text" type="password" name="new_password" id="username" value="" required/>
                                                                <input type="hidden" name="user_id" value="<?php echo bin2hex($user_id); ?>"/>
                                                            </p>
                                                            <p class="form-row form-row-wide">
                                                                <label for="password">Confirm New Password
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <input class="input-text" type="password" name="confirm_password" id="password" required/>
                                                            </p>
                                                            <p class="form-row">
                                                                <input class="woocommerce-Button button m-3" type="submit" value="Reset Password" name="reset_password">
                                                            </p>
                                                        </form>
                                                        <!-- .woocommerce-form-login -->
                                                    </div>
                                                    <!-- .col-1 -->
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