

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/reward_stages') ?>">Reward Point Stages</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			New Reward Point Stages <a href="<?php echo site_url('admin/settings/reward_stages') ?>" style="float: right" class="btn btn-sm btn-primary">All <span class="fa fa-list"></span></a></div>
		<div class="card-body">
			<div class="row">
				<div class="offset-3 col-md-6">
					<form msg="Creating New Shipping Location" action="<?php echo site_url('admin/settings/reward_stages/store'); ?>" method="POST">
						<div class="form-group">
							<label>Reward Stages</label>
							<input name="name" placeholder="Reward Stage Name" class="form-control"/>
						</div>

						<div class="form-group">
							<label>Point to attain</label>
							<input name="point_to" placeholder="Point to attain" class="form-control"/>
						</div>

						<div>
							<button class="btn btn-primary btn-sm">Create</button>
						</div>
					</form>
				</div>
			</div>
		</div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
