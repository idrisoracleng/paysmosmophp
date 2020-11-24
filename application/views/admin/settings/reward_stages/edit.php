

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/reward_stages') ?>">Reward Stages</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			Edit <b><?php echo $reward_stage->name; ?></b> <a href="<?php echo site_url('admin/settings/reward_stages') ?>" style="float: right" class="btn btn-sm btn-primary"><span class="fa fa-list"></span> All Reward Stages </a></div>
		<div class="card-body">
			<div class="row">
				<div class="offset-3 col-md-6">
					<form msg="Updating Shipping Location" action="<?php echo site_url('admin/settings/reward_stages/update/'.$reward_stage->id); ?>" method="POST">
						<div class="form-group">
							<label>Reward Stage Name</label>
							<input name="name" placeholder="Shipping Location Name" class="form-control" value="<?php echo $reward_stage->name; ?>"/>
						</div>

						<div class="form-group">
							<label>Point to Attain</label>
							<input name="point_to" placeholder="Point To Attain" class="form-control" value="<?php echo $reward_stage->point_to; ?>"/>
						</div>

						<div>
							<button class="btn btn-primary btn-sm">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
