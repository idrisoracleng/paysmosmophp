<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/user') ?>">Users</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-product"></i>
        All Users <a href="<?php echo site_url('/admin/user/create') ?>" style="float: right" class="btn btn-sm btn-primary"> Add New User <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($userslist as $user){ ?>
              <tr>
                <td><?php echo $user->full_name ?></td>
                <td><?php echo $user->email ?></td>
                <td><img style="height: 50px; width: 50px" src="<?php echo $user->image ?>"/></td>
								<td>
                  <?php 
                    $cooperativeData = ($user->cooperative_id != 'no_cooperative') ? $this->cooperativeModel->getCooperative(['cooperative_id' => $user->cooperative_id])->row() : null;
										if ($user->step == 1) {
											echo "Awaiting ".$cooperativeData->name." Cooperative Admin Approval";
										} else if ($user->step == 2) {
											echo "Awaiting Admin Final Approval";
										} else if ($user->step == 3) {
											echo "Account is suspended";
										} else if ($user->step == 0) {
											echo "Account is active";
										} else if ($user->step == 4) {
											echo "Account is suspended by ".$cooperativeData->name." cooperative admin";
										} else if ($user->step == 5) {
											echo "Account is declined by ".$cooperativeData->name." cooperative admin";
										}
									?>
								</td>
                <td><?php echo $user->created_at; ?></td>
                <td>
									<div class="dropdown">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Options
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="btn btn-sm btn-primary dropdown-item" href="<?php echo site_url('/admin/user/view/'.$user->user_id) ?>"><i class="fas fa-eye"></i> View User</a>
											<a class="btn btn-sm btn-warning dropdown-item" href="<?php echo site_url('/admin/user/edit/'.$user->user_id) ?>"><i class="fa fa-edit"></i> Edit User</a>
											<?php if ($user->step == 2) { ?>
												<a 
													msg="Do you want to approve this user?"
													class="btn btn-sm btn-danger slink dropdown-item" 
													href="<?php echo site_url('/admin/user/approve/'.$user->user_id) ?>"><i class="fas fa-bolt"></i> Approve</a>
											<?php } ?>
											<?php if ($user->step == 0) { ?>
												<a 
													msg="Do you want to susend this user?"
													class="btn btn-sm btn-danger slink dropdown-item" 
													href="<?php echo site_url('/admin/user/suspend/'.$user->user_id) ?>"><i class="fa fa-window-close"></i> Suspend</a>
											<?php } ?>
											<?php if ($user->step == 3) { ?>
												<a 
													msg="Do you want to susend this user?"
													class="btn btn-sm btn-danger slink dropdown-item" 
													href="<?php echo site_url('/admin/user/activate/'.$user->user_id) ?>"><i class="fas fa-bolt"></i> Activate</a>
											<?php } ?>
											<a class="btn btn-sm btn-danger delete_btn dropdown-item" href="<?php echo site_url('/admin/user/delete/'.$user->user_id) ?>"><i class="fa fa-window-close"></i> Delete</a>
										</div>
									</div>
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
