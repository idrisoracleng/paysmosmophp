

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
			New Shipping Location <a href="<?php echo site_url('admin/settings/shipping_location') ?>" style="float: right" class="btn btn-sm btn-primary">All <span class="fa fa-list"></span></a></div>
		<div class="card-body">
			<div class="row">
				<div class="offset-3 col-md-6">
					<form class="form-row" msg="Updating Shipping Location" action="<?php echo site_url('admin/settings/shipping_location/update/'.$shipping_location->id); ?>" method="POST">
						<div class="form-group col-md-6">
							<label>Select State</label>
							<?php $states = $this->db->get_where('states')->result(); ?>
							<select class="form-control custom-select-sm" name="state_id" id="state">
								<option selected disabled>Select State</option>
								<?php foreach ($states as $key => $state) { ?>
									<option 
										<?php echo ($shipping_location->state_id == $state->id) ? 'selected' : '' ?> 
										value="<?php echo $state->id ?>"><?php echo $state->name; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label>Select Local Government</label>
							<?php $locals = ($shipping_location->state_id)? $this->db->get_where('locals', ['state_id' => $shipping_location->state_id])->result() : []; ?>
							<select class="form-control custom-select-sm" name="local_id" id="locals">
								<option selected disabled>Select Local Government</option>
								<?php foreach ($locals as $key => $local) { ?>
									<option 
										<?php echo ($shipping_location->local_id == $local->local_id) ? 'selected' : '' ?> 
										value="<?php echo $local->local_id ?>"><?php echo $local->local_name; ?></option>
								<?php } ?>
							</select>
						</div>	
						<div class="col-md-12">

							<div class="form-group">
								<label>Shipping Location Name</label>
								<input name="name" placeholder="Shipping Location Name" class="form-control" value="<?php echo $shipping_location->name; ?>"/>
							</div>

							<!-- <div class="form-group">
								<label>Shipping Fee</label>
								<input name="fee" placeholder="Shipping Location Fee" class="form-control" value="<?php echo $shipping_location->fee; ?>"/>
							</div> -->

							<div>
								<button class="btn btn-primary btn-sm">Update</button>
							</div>
						</div>
						
						
					</form>
				</div>
			</div>
		</div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
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
