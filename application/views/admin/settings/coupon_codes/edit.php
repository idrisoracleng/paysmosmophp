

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
      <li class="breadcrumb-item">
        <a href="#">Coupon Codes</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      	<div class="card-header">
			<i class="fas fa-product"></i>
			<button class="btn btn-sm btn-primary back_btn"><i class="fas fa-arrow-left"></i></button> 
			Add New Coupon Code(s) 
			<a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/coupons/all_coupon') ?>" style="float: right"> 
				Coupon List
				<span class="fa fa-list"></span>
			</a>
		</div>
      <div class="card-body">
        <div class="row justify-content-center">
			<form class="col-md-6 form" msg="Updating coupon code..." action="<?php echo site_url('admin/coupons/update') ?>" method="POST">
				
				<div class='form-group'>
					<label>Coupon Code</label>
					<input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code" readonly value="<?php echo $coupon->coupon_code; ?>"/>
					<input type="hidden" name="id" class="form-control" required value="<?php echo $coupon->id; ?>"/>
				</div>

				<div class='form-group'>
					<label>Coupon Percentage</label>
					<input type="number" name="coupon_percentage" class="form-control" placeholder="Coupon Percentage" required value="<?php echo $coupon->percentage; ?>"/>
				</div>

				<div class='form-group'>
					<label>Generated For</label>
					<input type="text" name="generated_for" class="form-control" placeholder="Coupon Code Generated for" required value="<?php echo $coupon->generated_for; ?>"/>
				</div>

				<div class='form-group'>
					<label>Expiry Date and Time</label>
					<input type="datetime-local" name="expiry_date" class="form-control" placeholder="Coupon Expiry Date" required value="<?php echo $coupon->expiry_date; ?>"/>
				</div>

				<div class='form-group'>
					<button class="btn btn-primary btn-sm">Update Coupon Code</button>
				</div>
			</form>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
