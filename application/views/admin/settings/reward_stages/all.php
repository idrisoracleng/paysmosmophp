


  

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
			All Reward Stages <a href="<?php echo site_url('admin/settings/reward_stages/create') ?>" style="float: right" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a>
		</div>
		<div class="card-body">
			<div class="row justify-content-between">
				<?php if ($reward_stages) { ?>
					<?php foreach ($reward_stages as $key => $reward_stage) { ?>
						<div class="col-md-3 p-3 border border-primary rounded shadow">
							<p>Stage Name: <?php echo $reward_stage->name; ?></p>
							<p>Point To Attain: <?php echo $reward_stage->point_to; ?></p>
							<div>
								<a 
									href="<?php echo site_url('admin/settings/reward_stages/edit/'.$reward_stage->id) ?>" 
									class="btn btn-sm btn-primary rounded-circle"><i class="fas fa-edit"></i></a>
								<a 
									href="<?php echo site_url('admin/settings/reward_stages/delete/'.$reward_stage->id) ?>" 
									class="btn btn-sm btn-danger rounded-circle delete_btn"><i class="fas fa-trash"></i></a>
							</div>
						</div>
					<?php } ?>
				<?php } else { ?>
					<div class="alert alert-info text-center">
						No Reward Stage Have Been Created
					</div>
				<?php } ?>
			</div>
		</div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
