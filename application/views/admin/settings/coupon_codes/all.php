

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Coupon Code</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-product"></i>
				All Coupon Codes 
				<div class="float-right">
					<a href="<?php echo site_url('admin/coupons'); ?>" class="btn btn-sm btn-primary float-right mr-2"> All Coupon Code </a>
					<a href="<?php echo site_url('admin/coupons/used'); ?>" class="btn btn-sm btn-primary float-right mr-2"> Used Coupon Code </a>
					<a href="<?php echo site_url('admin/coupons/unused'); ?>" class="btn btn-sm btn-primary float-right mr-2"> Unused Coupon Code </a>
					<a href="<?php echo site_url('admin/coupons/expired'); ?>" class="btn btn-sm btn-primary float-right mr-2"> Expired Coupon Code </a>
					<a href="<?php echo site_url('admin/coupons/create'); ?>" class="btn btn-sm btn-primary float-right mr-2"><span class="fa fa-plus"></span> New Coupon Code </a>
				</div>
			</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Coupon Code</th>
                <th>Generated For</th>
                <th>No of Usage</th>
                <th>Percentage</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Expiry Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <!-- <tfoot>
              <tr>
                <th>Name</th>
                <th>Url</th>
                <th>Sub Menus</th>
                <th>Accessor</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot> -->
            <tbody>
				<?php if (isset($coupons) && count($coupons) > 0) { ?>
					<?php foreach($coupons as $key => $menu){ ?>
						<tr>
							<td><?php echo $menu->coupon_code ?></td>
							<td><?php echo $menu->generated_for ?></td>
							<td><?php echo $menu->notu; ?></td>
							<td><?php echo $menu->percentage; ?></td>
							<td><?php echo $menu->created_by; ?></td>
							<td><?php echo $menu->created_at; ?></td>
							<td><?php echo $menu->expiry_date; ?></td>
							<td>
								<a class="btn-sm btn btn-primary" href="#">view</a>
								<a class="btn-sm btn btn-primary" href="<?php echo site_url('admin/coupons/edit/'.$menu->id); ?>">Edit</a>
							</td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<div class="alert alert-info">
						No Coupon, <a href="<?php echo site_url('admin/coupons/create'); ?>">Create here to create coupon</a>
					</div>
				<?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

  </div>
