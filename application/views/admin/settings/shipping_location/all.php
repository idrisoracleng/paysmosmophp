

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/shipping_location') ?>">Shipping Locations</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			All Shipping Location <a href="<?php echo site_url('admin/settings/shipping_location/create') ?>" style="float: right" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a>
		</div>
		<div class="card-body">
			<div class="row">
				<?php foreach ($shipping_locations as $key => $shipping_location) { ?>
					<div class="col-md-3 p-3 border border-primary rounded shadow">
						<p>State: <?php echo $this->db->get_where('states', ['id' => $shipping_location->state_id])->row()->name; ?></p>
						<p>Local Government: <?php //echo $this->db->get_where('locals', ['local_id' => $shipping_location->local_id])->row()->local_name; ?></p>
						<?php if ($shipping_location->name != '') { ?>
							<p>Location Name: <?php echo $shipping_location->name; ?></p>
						<?php } ?>
						
						<div>
							<a 
								href="<?php echo site_url('admin/settings/shipping_location/edit/'.$shipping_location->id) ?>" 
								class="btn btn-sm btn-primary rounded-circle"><i class="fas fa-edit"></i></a>
							<a 
								href="<?php echo site_url('admin/settings/shipping_location/delete/'.$shipping_location->id) ?>" 
								class="btn btn-sm btn-danger rounded-circle delete_btn"><i class="fas fa-trash"></i></a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>







