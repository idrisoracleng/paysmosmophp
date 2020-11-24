

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/menus') ?>">Admin</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      	<div class="card-header">
			<i class="fas fa-product"></i>
			<button class="btn btn-sm btn-primary back_btn"><i class="fas fa-arrow-left"></i></button> 
			Add New Admin 
			<a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/admins/all') ?>" style="float: right"> 
				Admin List
				<span class="fa fa-list"></span>
			</a>
		</div>
      <div class="card-body">
        <div class="row justify-content-center">
			<form class="col-md-6 form" msg="Adding New Admin" action="<?php echo site_url('admin/admins/store') ?>" method="POST">
				<!-- <div class="form-group">
					<label>Select user</label>
					<?php //$cooperatives = $this->db->get_where('cooperatives', ['active' => 1])->result(); ?>
          			<select class="form-control" name="user_id" id="user_id">
					  	<option value="admin">Admin Account</option>
						<optgroup label="Cooperatives">
							<?php //foreach ($cooperatives as $key => $cooperative) { ?>
								<option value="<?php //echo $cooperative->cooperative_id; ?>"><?php //echo $cooperative->name; ?></option>
							<?php //} ?>
						</optgroup>
					</select>
				</div> -->
				
				<div id="admin_account_info" class="form-group">
					<label>Full Name</label>
					<input name="full_name" class="form-control" placeholder="Admin Full Name"/>
				</div>
				
				<div class='form-group'>
					<label>Email</label>
					<input type="email" name="email" class="form-control" placeholder="Admin Email" required/>
				</div>

				<div class='form-group'>
					<label>Password</label>
					<input type="password" name="password" class="form-control" placeholder="Admin Password" required/>
				</div>

				<!-- <div class="form-group">
					<label>Select Account Type</label>
          			<select class="form-control" name="acct_type">
					  	<option selected>Select account type</option>
						<option value="admin">Admin</option>
						<option value="cooperative">Cooperative</option>
					</select>
        		</div> -->

				<div class='form-group'>
					<button class="btn btn-primary btn-sm">Add Admin</button>
				</div>
			</form>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>

  <script>
	  $(document).ready(function() {
		$('#user_id').change(function () {
			var value = $(this).val();
			if (value != 'admin') {
				$("#admin_account_info").hide();
			} else {
				$("#admin_account_info").show();
			}
		})
	  })
  </script>