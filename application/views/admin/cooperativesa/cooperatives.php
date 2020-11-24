

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
        <button class="btn btn-sm btn-primary back_btn"><i class="fas fa-arrow-left"></i></button> All Cooperative <a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/cooperatives/create') ?>" style="float: right"> Add New Cooperative <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Active</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Active</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($cooperatives as $key => $cooperative){ ?>
              <tr>
                <td><?php echo $cooperative->name ?></td>
                <td><?php echo $cooperative->email; ?></td>
                <td><?php echo $cooperative->phone_number; ?></td>
                <td><?php echo ($cooperative->active == 1) ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Not Active</span>"; ?></td>
                <td><?php echo $cooperative->created_at; ?></td>
                <td>
                    <div class="dropdown">
											<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Options
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<!-- <i class="btn btn-sm btn-primary dropdown-item" data-toggle="modal" data-target="#newSubMenu" href="#"><i class="fas fa-plus"></i></a> -->
												<a class="btn btn-sm btn-warning dropdown-item" href="<?php echo site_url('/admin/cooperatives/view/'.$cooperative->cooperative_id) ?>"><i class="fas fa-eye"></i> View Cooperative</a>
												<a class="btn btn-sm btn-warning edit_btn dropdown-item" href="<?php echo site_url('/admin/cooperatives/edit/'.$cooperative->cooperative_id) ?>"><i class="fa fa-edit"></i> Edit Cooperative</a>
												<?php if ($cooperative->active == 1) { ?>
													<a 
														class="btn btn-sm btn-warning edit_btn dropdown-item slink" 
														msg="Do you want to suspend this cooperative?"
														href="<?php echo site_url('/admin/cooperatives/deactivate/'.$cooperative->cooperative_id) ?>"><i class="fa fa-window-close"></i> Suspend Cooperative</a>
												<?php } else if ($cooperative->active == 0) { ?>
													<a 
														class="btn btn-sm btn-warning edit_btn dropdown-item slink" 
														msg="Do you want to approve this cooperative?"
														href="<?php echo site_url('/admin/cooperatives/approve/'.$cooperative->cooperative_id) ?>"><i class="fa fa-flash"></i> Approve Cooperative</a>
												<?php } ?>
												<a class="btn btn-sm btn-warning delete_btn dropdown-item" href="<?php echo site_url('/admin/cooperatives/delete/'.$cooperative->cooperative_id) ?>"><i class="fa fa-trash"></i> Delete Cooperative</a>
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
