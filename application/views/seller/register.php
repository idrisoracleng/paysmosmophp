<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CMACBETH Onboarding</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo site_url('/public/reg/assets/bootstrap/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('/public/reg/assets/font-awesome/css/font-awesome.min.css') ?>">
		<link rel="stylesheet" href="<?php echo site_url('/public/reg/assets/css/form-elements.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('/public/reg/assets/css/style.css') ?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link href="<?php echo site_url('public/images/system/sys/logo.png')?>" rel="shortcut icon">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo site_url('/public/reg/assets/ico/apple-touch-icon-144-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo site_url('/public/reg/assets/ico/apple-touch-icon-114-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo site_url('/public/reg/assets/ico/apple-touch-icon-72-precomposed.png') ?>">
        <link rel="apple-touch-icon-precomposed" href="<?php echo site_url('/public/reg/assets/ico/apple-touch-icon-57-precomposed.png') ?>">

    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>CMACBETH</strong> Onboarding</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
							<?php if ($this->session->flashdata('msg')) { ?>
								<div class="alert alert-<?php echo $this->session->flashdata('flag'); ?>">
									<?php echo $this->session->flashdata('msg'); ?>
								</div>
							<?php } ?>
                        	<div class="registration-form">
                        		<?php if ($step == 1) { ?>
									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>Step 1 / 5</h3>
												<p>Tell us who you are:</p>
											</div>
											<div class="form-top-right">
												<i class="fa fa-user"></i>
											</div>
										</div>
										<div class="form-bottom">
											<form action='<?php echo site_url('seller/registration/1') ?>' method="POST" msg ="Please wait...">
												<div class="form-group">
													<label class="sr-only">Full Name</label>
													<input type="text" name="full_name" placeholder="Full Name..." class="form-email form-control" id="full_name">
												</div>

												<div class="form-group">
													<label class="sr-only">Email</label>
													<input type="text" name="email" placeholder="Email..." class="form-email form-control" id="email">
													<input type="hidden" name="acct_type" class="form-email form-control" value="seller">
												</div>

												<div class="form-group">
													<label class="sr-only">Password</label>
													<input type="password" name="password" placeholder="Phone Number..." class="form-email form-control" id="password">
												</div>

												<div class="form-group">
													<label class="sr-only">About You</label>
													<textarea type="text" name="about" placeholder="Tell us about yourself..." class="form-email form-control" id="about" rows="6"></textarea>
												</div>
												<button type="submit" class="btn">Next</button>
											</form>
											
										</div>
									</fieldset>
								<?php } ?>

								<?php if ($step == 2 && $this->session->userdata('user_id')) { ?>
									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>Step 2 / 5</h3>
												<p>Set your contact detail:</p>
											</div>
											<div class="form-top-right">
												<i class="fa fa-key"></i>
											</div>
										</div>
										<div class="form-bottom">
											<form action='<?php echo site_url('seller/registration/2') ?>' method="POST" class="form-row" msg ="Please wait...">
												<div class="form-group col-md-12">
													<label class="sr-only">Email</label>
													<input type="text" name="email" placeholder="Email..." class="form-email form-control" id=>
												</div>

												<div class="form-group col-md-12">
													<label class="sr-only">Phone Number</label>
													<input type="text" name="phone_number" placeholder="Phone Number..." class="form-email form-control">
												</div>

												<div class="form-group col-md-6">
													<label>Select State</label>
													<?php $states = $this->db->get('states')->result(); ?>
													<select class="form-control custom-select-sm" name="state_id" id="state">
														<option selected disabled>Select State</option>
														<?php foreach ($states as $key => $state) { ?>
															<option 
																value="<?php echo $state->id ?>"><?php echo $state->name; ?></option>
														<?php } ?>
													</select>
												</div>

												<div class="form-group col-md-6">
													<label>Select Local Government</label>
													<select class="form-control custom-select-sm" name="local_id" id="locals">
														<option selected disabled>Select Local Government</option>
													</select>
												</div>

												<div class="form-group col-md-12">
													<label class="sr-only">Address</label>
													<textarea type="text" name="address" placeholder="Address..." class="form-email form-control"></textarea>
												</div>

												<div class="form-group col-md-12">
													<label class="sr-only">Billing Address</label>
													<textarea type="text" name="address" placeholder="Billing Address..." class="form-email form-control"></textarea>
												</div>
												
												<?php if ($step != 2) { ?>
													<button type="button" class="btn btn-previous">Previous</button>
												<?php } ?>
												<button type="submit" class="btn">Next</button>
											</form>
										</div>
									</fieldset>
								<?php } ?>

								<?php if ($step == 3 && $this->session->userdata('user_id')) { ?>
									<?php
										$banks = array(
											'Access Bank Plc','Fidelity Bank Plc','First City Monument Bank Plc','First Bank of Nigeria Limited','Guaranty Trust Bank Plc','Union Bank of Nigeria Plc',
											'United Bank for Africa Plc','Zenith Bank Plc','Ecobank Nigeria Plc','Polaris Bank Limited','Heritage Banking Company Limited','Citibank Nigeria Limited',
											'Keystone Bank Limited','Stanbic IBTC Bank Plc','Sterling Bank Plc','Unity Bank Plc','Wema Bank Plc'
										);	
									?>
									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>Step 3 / 5</h3>
												<p>Bank Account Detail:</p>
											</div>
											<div class="form-top-right">
												<i class="fa fa-building"></i>
											</div>
										</div>
										<div class="form-bottom">
											<!-- <div class="form-group">
												<label class="sr-only" form-email">Email</label>
												<input type="text" name="form-email" placeholder="Email..." class="form-email form-control" id="form-email">
											</div> -->
											<form action='<?php echo site_url('seller/registration/3') ?>' method="POST" msg ="Please wait...">
												<div class="form-group">
													<label class="sr-only">Bank Name</label>
													<select name="bank_name" class="form-email form-control">
														<option selected disabled>Select a bank name</option>
														<?php foreach ($banks as $key => $bank) { ?>
															<option value="<?php echo strtolower($bank) ?>"><?php echo $bank; ?></option>
														<?php } ?>
													</select>
												</div>

												<div class="form-group">
													<label class="sr-only">Bank Account Name</label>
													<input type="text" name="bank_account_name" placeholder="Bank Account Name..." class="form-email form-control" id="bank_account_name">
												</div>

												<div class="form-group">
													<label class="sr-only">Bank Account Number</label>
													<input type="text" name="bank_account_number" placeholder="Bank Account Number..." class="form-email form-control" id="bank_account_number">
												</div>
												
												<?php if ($step != 3) { ?>
													<button type="button" class="btn btn-previous">Previous</button>
												<?php } ?>
												<button type="submit" class="btn">Next</button>
											</form>
											
										</div>
									</fieldset>
								<?php } ?>

								<?php if ($step == 4 && $this->session->userdata('user_id')) { ?>
									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>Step 4 / 5</h3>
												<p>Business Info:</p>
											</div>
											<div class="form-top-right">
												<i class="fa fa-twitter"></i>
											</div>
										</div>
										<div class="form-bottom">
											<form action='<?php echo site_url('seller/registration/4') ?>' method="POST" msg ="Please wait..." enctype="multipart/form-data">

												<div class="form-group">
													<label>Store/Business Name</label>
													<input name="company_name" placeholder="Business Name" type="text" class="form-control"/>
												</div>

												<!-- <div class="form-group">
													<label>Company/Business Name</label>
													<input name="company_name" placeholder="Business Name" type="text" class="form-control"/>
												</div> -->

												<div class="form-group">
													<label class="sr-only">Upload a file for your logo</label>
													<input type="file" name="logo" class="form-twitter form-control" id="form-twitter">
												</div>

												<div class="form-group">
													<label>Location</label>
													<input name="location" type="text" placeholder="Business Location..." class="form-control"/>
												</div>

												<?php if ($step != 4) { ?>
													<button type="button" class="btn btn-previous">Previous</button>
												<?php } ?>
												<button type="submit" class="btn">Next</button>
											</form>
										</div>
									</fieldset>
								<?php } ?>

								<?php if ($step == 5 && $this->session->userdata('user_id')) { ?>
									<?php
										$credentials = array(
											'International Passport', 'Driver\'s License', 'Permanent Voters Card'
										);	
									?>
									
									<fieldset>
										<div class="form-top">
											<div class="form-top-left">
												<h3>Step 5 / 5</h3>
												<p>Credentials and IDs:</p>
											</div>
											<div class="form-top-right">
												<i class="fa fa-twitter"></i>
											</div>
										</div>
										<div class="form-bottom">
											<form action='<?php echo site_url('seller/registration/5') ?>' method="POST" msg ="Please wait..." enctype="multipart/form-data">
												<div class="form-group">
													<label class="sr-only">Credential Name</label>
													<select name="credential_name" class="form-email form-control">
														<option selected disabled>Select a credential you want to submit</option>
														<?php foreach ($credentials as $key => $credential) { ?>
															<option value="<?php echo strtolower($credential) ?>"><?php echo $credential; ?></option>
														<?php } ?>
													</select>
												</div>

												<div class="form-group">
													<label class="sr-only">Upload a file</label>
													<input type="file" name="credential" class="form-twitter form-control" id="form-twitter">
												</div>

												<div class="form-group">
													<label>Date Issued</label>
													<input name="issued_date" type="date" class="form-control"/>
												</div>

												<div class="form-group">
													<label>Expiry Date</label>
													<input name="expiry_date" type="date" class="form-control"/>
												</div>
												<?php if ($step != 4) { ?>
													<button type="button" class="btn btn-previous">Previous</button>
												<?php } ?>
												<button type="submit" class="btn">Finalize</button>
											</form>
										</div>
									</fieldset>
								<?php } ?>
		                    
							</div>
		                    
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?php echo site_url('/public/reg/assets/js/jquery-1.11.1.min.js') ?>"></script>
        <script src="<?php echo site_url('/public/reg/assets/bootstrap/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo site_url('/public/reg/assets/js/jquery.backstretch.min.js') ?>"></script>
        <script src="<?php echo site_url('/public/reg/assets/js/retina-1.1.0.min.js') ?>"></script>
        <script src="<?php echo site_url('/public/reg/assets/js/scripts.js') ?>"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
		<![endif]-->
		
		<script>
			$(document).ready(function () {
				$("#state").change(function () {
					// alert($(this).val());
					var state_id = $(this).val();
					$.get("<?php echo site_url('api/getLocals/') ?>"+state_id, {}, (data) => {
						// console.log(data);
						$("#locals").html(data);
					});
				});
			});
		</script>

    </body>

</html>
