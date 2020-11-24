

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/menus') ?>">Cooperatives</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			<button class="btn btn-sm btn-primary back_btn"><i class="fas fa-arrow-left"></i></button> 
			All Cooperative 
			<a class="btn btn-sm btn-primary ml-2" href="<?php echo site_url('admin/cooperatives/create') ?>" style="float: right"> Add New Cooperative <span class="fa fa-plus"></span></a>
			<a class="btn btn-sm btn-primary mr-2" href="<?php echo site_url('admin/cooperatives/edit/'.$cooperative->cooperative_id) ?>" style="float: right"> Edit Cooperative <span class="fa fa-edit"></span></a>
		</div>
		<div class="card-body">
			<ul class="list-group">
				<li class="list-group-item"><strong>Cooperative Name: <?php echo $cooperative->name; ?></strong></li>
				<li class="list-group-item"><strong>Cooperative Email: <?php echo $cooperative->email; ?></strong></li>
				<li class="list-group-item"><strong>Cooperative Phone Number: <?php echo $cooperative->phone_number; ?></strong></li>
			</ul>
		</div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-product"></i>
        Members of <?php echo $cooperative->name ?> Cooperative</div>
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
                <!-- <th>Actions</th> -->
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Active</th>
                <th>Created At</th>
                <!-- <th>Actions</th> -->
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($cooperativeMembers as $key => $cooperative_member){ ?>
            <?php 
              $sql = "SELECT u.*,c.phone_number FROM users as u LEFT JOIN contacts as c On u.user_id = c.user_id WHERE u.user_id = '".$cooperative_member->member_id."' LIMIT 1";
              $memberData = $this->db->query($sql)->row();  ?>
              <tr>
                <td><?php echo $memberData->full_name ?></td>
                <td><?php echo $memberData->email; ?></td>
                <td><?php echo $memberData->phone_number; ?></td>
                <td><?php echo ($cooperative_member->approved == 1) ? "<span class='badge badge-success'>Approved</span>" : "<span class='badge badge-danger'>Not Approved</span>"; ?></td>
                <td><?php echo $cooperative_member->created_at; ?></td>
                <!-- <td>
                    <div class="dropdown">
						<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Options
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="btn btn-sm btn-warning dropdown-item" href="<?php echo site_url('/admin/cooperatives/view/'.$cooperative_member->cooperative_id) ?>"><i class="fas fa-eye"></i> View Cooperative</a>
							<a class="btn btn-sm btn-warning edit_btn dropdown-item" href="<?php echo site_url('/admin/cooperatives/edit/'.$cooperative_member->cooperative_id) ?>"><i class="fa fa-edit"></i> Edit Cooperative</a>
							<a class="btn btn-sm btn-warning delete_btn dropdown-item" href="<?php echo site_url('/admin/cooperatives/delete/'.$cooperative_member->cooperative_id) ?>"><i class="fa fa-trash"></i> Delete Cooperative</a>
						</div>
					</div>
								 </td> -->
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
