

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/admins/all') ?>">Admin List</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-product"></i>
        <button class="btn btn-sm btn-primary back_btn"><i class="fas fa-arrow-left"></i></button> Admin List <a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/admins/create') ?>" style="float: right"> Add New Admin <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Account</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Account</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($admins as $key => $admin){ ?>
				<?php $userData = ($admin->acct_type == 'cooperative') ? $this->db->get_where('cooperatives', ['cooperative_id' => $admin->user_id])->row() : $this->db->get_where('users', ['user_id' => $admin->user_id])->row() ; ?>
              <tr>
                <td><?php echo ($admin->acct_type == 'cooperative') ? $userData->name : $userData->full_name; ?></td>
                <td><?php echo $admin->email; ?></td>
                <td><?php echo ($admin->acct_type == 'cooperative') ? $userData->phone_number : ''; ?></td>
                <td><?php echo $admin->acct_type; ?></td>
                <td><?php echo $admin->created_at; ?></td>
                <td>
									<div class="dropdown">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Options
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="btn btn-sm btn-warning edit_btn dropdown-item" href="<?php echo site_url('/admin/admins/edit/'.$admin->id) ?>"><i class="fa fa-edit"></i> Edit Admin</a>
											<a class="btn btn-sm btn-warning delete_btn dropdown-item" href="<?php echo site_url('/admin/admins/delete/'.$admin->id) ?>"><i class="fa fa-trash"></i> Delete Admin</a>
										</div>
									</div>
										<!--
                    <a class="btn btn-sm btn-danger delete_btn" href="<?php //echo site_url('/admin/menu/delete/'.$cooperative->id) ?>"><i class="fa fa-trash"></i></a>-->
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
