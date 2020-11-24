

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/menus') ?>">Cooperatives</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      	<div class="card-header">
			<i class="fas fa-product"></i>
			<button class="btn btn-sm btn-primary back_btn"><i class="fas fa-arrow-left"></i></button> 
			Edit Admin Info 
			<a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/admins/all') ?>" style="float: right"> 
				Admin List
				<span class="fa fa-list"></span>
			</a>
		</div>
      <div class="card-body">
        <div class="row justify-content-center">
			<form class="col-md-6 form" msg="Updating Admin Data" action="<?php echo site_url('admin/admins/update') ?>" method="POST">
				<!-- <div class="form-group">
					<label>Select user</label>
					<?php //$cooperatives = $this->db->get_where('cooperatives', ['active' => 1])->result(); ?>
					<?php //$users = $this->db->get_where('users', ['active' => 1])->result(); ?>
          			<select class="form-control" name="user_id">
					  	<optgroup label="Cooperatives">
						  	<?php //foreach ($cooperatives as $key => $cooperative) { ?>
								<option 
									<?php //echo ($adminData->user_id == $cooperative->cooperative_id) ? ' selected ':''; ?>
									value="<?php //echo $cooperative->cooperative_id; ?>"><?php echo $cooperative->name; ?></option>
							<?php //} ?>
						</optgroup>

						<optgroup label="Users">
						  	<?php //foreach ($users as $key => $user) { ?>
								<option 
									<?php //echo ($adminData->user_id == $user->user_id) ? ' selected ':''; ?>
									value="<?php //echo $user->user_id; ?>"><?php echo $user->full_name; ?></option>
							<?php //} ?>
						</optgroup>
					</select>
        		</div> -->
				
				<div class='form-group'>
					<label>Email</label>
					<input type="email" name="email" class="form-control" placeholder="Admin Email" required value="<?php echo $adminData->email; ?>"/>
					<input type="hidden" name="id" class="form-control" placeholder="Admin Email" required value="<?php echo $adminData->id; ?>"/>
				</div>

				<div class='form-group'>
					<label>Password</label>
					<input type="password" name="password" class="form-control" placeholder="Admin Password" />
				</div>

				<!-- <div class="form-group">
					<label>Select Account Type</label>
          			<select class="form-control" name="acct_type">
					  	<option seleted>Select account type</option>
						<option value="admin">Admin</option>
						<option value="cooperative">Coooperative</option>
					</select>
        		</div> -->

				<div class='form-group'>
					<button class="btn btn-primary btn-sm">Update Admin</button>
				</div>
			</form>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
