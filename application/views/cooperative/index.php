<?php //$latest_products = $this->db->limit(5)->order_by('created_at', 'DESC')->get('products')->result_array(); ?>
<?php //$latest_order = $this->db->limit(5)->order_by('created_at', 'DESC')->get('seller_order')->result_array(); ?>
<?php 
	$coopId = $this->session->userdata('user')->cooperative_id;
	$latest_members = $this->cooperativeModel->getActiveCooperativeMembers($coopId)->result();
?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <?php include APPPATH.'/views/layouts/admin/dashtabs.php' ?>

        <!-- DataTables Example -->
		
		<div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Recent Members</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
					<th>Status</th>
                    <th>Joined At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
					<th>Status</th>
                    <th>Joined At</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach($latest_members as $key => $member){ ?>
					<?php $memberData = $this->db->get_where('users', ['user_id' => $member->member_id])->row(); ?>
					<tr>
						<td><?php echo $memberData->full_name; ?></td>
						<td><?php echo $memberData->email; ?></td>
						<td>
							<?php 
								if ($memberData->step == 1) {
									echo "Awaiting Cooperative Admin Approval";
								} else if ($memberData->step == 2) {
									echo "Awaiting Admin Final Approval";
								} else if ($memberData->step == 3) {
									echo "Account is suspended";
								} else if ($memberData->step == 0) {
									echo "Account is active";
								} else if ($memberData->step == 4) {
									echo "Account is suspended by cooperative admin";
								} else if ($memberData->step == 5) {
									echo "Account is declined by cooperative admin";
								}
							?>
						</td>
						<td><?php echo $member->created_at; ?></td>
						<!-- <td><?php //echo Carbon\Carbon::create($latest_user['created_at'])->diffForHumans(); ?></td> -->
						<td>
							<div class="dropdown">
								<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Options
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<!-- <a class="btn btn-sm btn-primary dropdown-item" href="<?php //echo site_url('/admin/user/view/'.$member->member_id) ?>"><i class="fas fa-eye"></i></a> -->
									<!-- <a class="btn btn-sm btn-warning dropdown-item " href="<?php //echo site_url("/admin/user/edit/".$member->member_id) ?>"><i class="fas fa-edit"></i></a> -->
									<?php if ($memberData->step == 1) { ?>
										<a 
											class="btn btn-sm btn-warning dropdown-item slink" 
											msg="Do you want to approve this user as a member?"
											href="<?php echo site_url("/cooperative/members/approve/".$member->member_id) ?>"><i class="fas fa-bolt"></i> Approve</a>
                    <a 
											class="btn btn-sm btn-warning dropdown-item slink" 
											msg="Do you want to decline this user as a member?"
											href="<?php echo site_url("/cooperative/members/decline/".$member->member_id) ?>"><i class="fas fa-window-close"></i> Deline</a>
									<?php } else if ($memberData->step == 4) { ?>
										<a 
											class="btn btn-sm btn-warning dropdown-item slink" 
											msg="Do you want to activate this member?"
											href="<?php echo site_url("/cooperative/members/activate/".$member->member_id) ?>"><i class="fas fa-bolt"></i> Activate</a>
									<?php } else if ($member->approved == 1) { ?>
										<a 
											class="btn btn-sm btn-warning dropdown-item slink" 
											msg="Do you want to suspend this member?"
											href="<?php echo site_url("/cooperative/members/suspend/".$member->member_id) ?>"><i class="fas fa-bolt"></i> Suspend</a>
									<?php } ?>
									<!-- <a class="btn btn-sm btn-danger delete_btn dropdown-item" href="<?php //echo site_url("/admin/user/delete/".$member->member_id) ?>"><i class="fas fa-trash"></i></a> -->
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
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->


