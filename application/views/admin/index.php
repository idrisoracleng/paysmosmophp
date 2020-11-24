<?php $latest_products = $this->db->limit(5)->order_by('created_at', 'DESC')->get('products')->result_array(); ?>
<?php $latest_order = $this->db->limit(5)->order_by('created_at', 'DESC')->get('seller_order')->result_array(); ?>
<?php $latest_users = $this->db->limit(5)->order_by('created_at', 'DESC')->get('users')->result_array(); ?>

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
            <i class="fab fa-product-hunt"></i>
            Recent Products</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
									<?php foreach($latest_products as $latest_product){ ?>
										<?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $latest_product['product_id']])->result(); ?>
                    <?php $images = (file_exists(APPPATH.'../public/images/products/'.$latest_product['code'])) ? array_diff(scandir(APPPATH.'../public/images/products/'.$latest_product['code']), ['.', '..']) : null; ?>
                  <tr>
                    <td><?php echo $latest_product['name'] ?></td>
                    <td><img style="height: 50px; width: 50px;" src="<?php echo site_url('/public/images/products/'.$latest_product['code'].'/'.$images[2]) ?>" /></td>
                    <td>
											<?php echo ($variants) ? $this->cart->format_number($variants[0]->price) : $this->cart->format_number($latest_product['price']) ?>	
										</td>
                    <td><?php echo $this->db->get_where('category', ['id' => $latest_product['category_id']])->row()->name; ?></td>
                    <td><?php echo $latest_product['created_at']; ?></td>
                    <td>
											<div class="dropdown">
												<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Options
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a
														class="btn btn-sm dropdown-item btn-primary" 
														href="<?php echo site_url('/admin/product/view/'.$latest_product['code']) ?>"
														title="View Product"><i class="fas fa-eye"></i> View</a>
													<?php if($latest_product['status'] == 'pending'){ ?>
														<a
															class="btn btn-sm dropdown-item btn-secondary slink" 
															msg="Do you want to approve <?php echo $latest_product['name']; ?>?" 
															href="<?php echo site_url("/admin/product/approve/".$latest_product['code']) ?>"
															title="Approve Product"><i class="fa fa-bolt"></i> Approve</a>
													<?php } ?>
													<?php if($latest_product['status'] == 'approved'){ ?>
														<a
															class="btn btn-sm dropdown-item btn-warning slink" 
															msg="Do you want to unapprove <?php echo $latest_product['name']; ?>?" 
															href="<?php echo site_url("/admin/product/unapprove/".$latest_product['code']) ?>"
															title="Disapprove Product"><i class="fas fa-window-close"></i> Disapprove</a>
													<?php } ?>
													<?php //if($this->session->userdata('user')->loggedinas == 'admin'){ ?>
														<a
															class="btn btn-sm dropdown-item btn-warning" 
															href="<?php echo site_url("/admin/product/edit/".$latest_product['code']) ?>"
															title="Edit Product"><i class="fas fa-edit"></i> Edit</a>
														<a
															class="btn btn-sm dropdown-item btn-info" 
															href="<?php echo site_url("/admin/product/clone/".$latest_product['code']) ?>"
															title="Clone Product"><i class="fas fa-copy"></i> Clone</a>
													<?php //} ?>
													<a
															class="btn btn-sm dropdown-item btn-danger delete_btn" 
															href="<?php echo site_url("/admin/product/delete/".$latest_product['code']) ?>"
															title="Delete Product"><i class="fas fa-trash"></i> Delete</a>
												</div>
											</div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
				</div>

				<!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Recent Users</div>
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
                  <?php foreach($latest_users as $latest_user){ ?>
                  <tr>
                    <td><?php echo $latest_user['full_name'] ?></td>
                    <td><?php echo $latest_user['email'] ?></td>
										<!-- <td> -->
										<td>
                      <?php 
                        // $cooperativeData = ($latest_user['cooperative_id'] != 'no_cooperative') ? $this->cooperativeModel->getCooperative(['cooperative_id' => $latest_user['cooperative_id']])->row() : null;
                        // if ($latest_user['step'] == 1) {
                        //   echo "Awaiting ".$cooperativeData->name." Cooperative Admin Approval";
                        // } else if ($latest_user['step'] == 2) {
                        //   echo "Awaiting Admin Final Approval";
                        // } else if ($latest_user['step'] == 3) {
                        //   echo "Account is suspended";
                        // } else if ($latest_user['step'] == 0) {
                        //   echo "Account is active";
                        // } else if ($latest_user['step'] == 4) {
                        //   echo "Account is suspended by ".$cooperativeData->name." cooperative admin";
                        // } else if ($latest_user['step'] == 5) {
                        //   echo "Account is declined by ".$cooperativeData->name." cooperative admin";
                        // }
                        echo $this->UserModel->getUserStatus($latest_user);
                      ?>
										</td>
										</!-->
                    <td><?php echo $latest_user['created_at']; ?></td>
                    <td>
						<div class="dropdown">
							<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Options
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="btn btn-sm btn-primary dropdown-item" href="<?php echo site_url('/admin/user/view/'.$latest_user['user_id']) ?>"><i class="fas fa-eye"></i> View User</a>
								<a class="btn btn-sm btn-warning dropdown-item" href="<?php echo site_url('/admin/user/edit/'.$latest_user['user_id']) ?>"><i class="fa fa-edit"></i> Edit User</a>
								<?php if ($latest_user['step'] == 2) { ?>
									<a 
										msg="Do you want to approve this user?"
										class="btn btn-sm btn-danger slink dropdown-item" 
										href="<?php echo site_url('/admin/user/approve/'.$latest_user['user_id']) ?>"><i class="fas fa-bolt"></i> Approve</a>
								<?php } ?>
								<?php if ($latest_user['step'] == 0) { ?>
									<a 
										msg="Do you want to susend this user?"
										class="btn btn-sm btn-danger slink dropdown-item" 
										href="<?php echo site_url('/admin/user/suspend/'.$latest_user['user_id']) ?>"><i class="fa fa-window-close"></i> Suspend</a>
								<?php } ?>
								<?php if ($latest_user['step'] == 3) { ?>
									<a 
										msg="Do you want to susend this user?"
										class="btn btn-sm btn-danger slink dropdown-item" 
										href="<?php echo site_url('/admin/user/activate/'.$latest_user['user_id']) ?>"><i class="fas fa-bolt"></i> Activate</a>
								<?php } ?>
								<a class="btn btn-sm btn-danger delete_btn dropdown-item" href="<?php echo site_url('/admin/user/delete/'.$latest_user['user_id']) ?>"><i class="fa fa-window-close"></i> Delete</a>
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


