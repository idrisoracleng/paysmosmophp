<?php
if ($this->session->userdata('user')->loggedinas == 'admin') {
  $products = $this->ProductModel->getAllProducts();
  $latest_products = $this->ProductModel->getLatestProducts();

  $users = $this->UserModel->getAllUsers();

  $categories = $this->CategoryModel->getAllCategories();
  $subcategories = $this->SubCategoryModel->getSubAllCategories();
}

if ($this->session->userdata('user')->loggedinas == 'seller') {
  $products = $this->ProductModel->getProductsBy('owner_id', $this->session->userdata('user')->user_id);
  $latest_products = $this->ProductModel->getLatestProductsBy('owner_id', $this->session->userdata('user')->user_id);

  // $users = $this->UserModel->getAllUsers();

  // $categories = $this->CategoryModel->getAllCategories();
  // $subcategories = $this->SubCategoryModel->getSubAllCategories();
}

if ($this->session->userdata('user')->loggedinas == 'cooperative') {
	$coopId = $this->session->userdata('user')->cooperative_id;
	$members = $this->db->get_where('cooperative_member', ['cooperative_id' => $coopId, 'approved' => 1])->result();
	$orders = $this->db->get_where('orders', ['isCooperative' => $this->session->userdata('user')->cooperative_id])->result();
  // $latest_products = $this->ProductModel->getLatestProductsBy('owner_id', $this->session->userdata('user')->user_id);

  // $users = $this->UserModel->getAllUsers();

  // $categories = $this->CategoryModel->getAllCategories();
  // $subcategories = $this->SubCategoryModel->getSubAllCategories();
}
  
?>

<div class="row justify-content-center">
		<?php if ($this->session->userdata('user')->loggedinas == 'admin') { ?>
			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-primary o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fas fa-fw fa-users"></i>
						</div>
						<div class="mr-5"><?php echo count($users) ?> Users</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/admin/user/all')?>">
						<span class="float-left">View All</span>
						<span class="float-right">
							<i class="fas fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-success o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fas fa-fw fa-tags"></i>
						</div>
						<div class="mr-5"><?php echo count($categories) ?> Category</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/admin/category')?>">
						<span class="float-left">View All</span>
						<span class="float-right">
							<i class="fas fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>

			<!-- <div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-danger o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fas fa-fw fa-list-alt"></i>
						</div>
						<div class="mr-5"><?php //echo count($subcategories) ?> Sub Category</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="#">
						<span class="float-left">View All</span>
						<span class="float-right">
							<i class="fas fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div> -->

			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-warning o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fab fa-product-hunt"></i>
						</div>
						<div class="mr-5"><?php echo count($products) ?> Products</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/admin/product/all') ?>">
						<span class="float-left">View All</span>
						<span class="float-right">
							<i class="fas fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>
		<?php } ?>



  	<?php if ($this->session->userdata('user')->loggedinas == 'seller') { ?>
			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-danger o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fas fa-fw fa-shopping-cart"></i>
						</div>
						<div class="mr-5"><?php echo 0 ?> Orders</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/'.$this->session->userdata('user')->loggedinas.'/orders/my_orders') ?>">
						<span class="float-left">View All</span>
						<span class="float-right">
							<i class="fas fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>
			
			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-warning o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fab fa-product-hunt"></i>
						</div>
						<div class="mr-5"><?php echo count($products) ?> Products</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/'.$this->session->userdata('user')->loggedinas.'/product/all') ?>">
						<span class="float-left">View All</span>
						<span class="float-right">
							<i class="fas fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>


			<div class="col-xl-3 col-sm-6 mb-3">
				<div class="card text-white bg-primary o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="mr-5"><?php echo 0 ?> Messages</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/'.$this->session->userdata('user')->loggedinas.'/message/all') ?>">
						<span class="float-left">View All</span>
						<span class="float-right">
							<i class="fas fa-angle-right"></i>
						</span>
					</a>
				</div>
			</div>
		<?php } ?>

	<?php if ($this->session->userdata('user')->loggedinas == 'cooperative') { ?>
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-primary o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-users"></i>
					</div>
					<div class="mr-5"><?php echo count($members) ?> Members</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/cooperative/members/members_list')?>">
					<span class="float-left">View All</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div>


		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-danger o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-shopping-cart"></i>
					</div>
					<div class="mr-5"><?php echo count($orders) ?> Orders</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/'.$this->session->userdata('user')->loggedinas.'/orders/order_list') ?>">
					<span class="float-left">View All</span>
					<span class="float-right">
						<i class="fas fa-angle-right"></i>
					</span>
				</a>
			</div>
		</div>
  <!-- <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-shopping-cart"></i>
        </div>
        <div class="mr-5"><?php echo 0 ?> Orders</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/'.$this->session->userdata('user')->loggedinas.'/orders/my_orders') ?>">
        <span class="float-left">View All</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fab fa-product-hunt"></i>
        </div>
        <div class="mr-5"><?php echo count($products) ?> Products</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/'.$this->session->userdata('user')->loggedinas.'/product/all') ?>">
        <span class="float-left">View All</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div> -->


  <!-- <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-envelope"></i>
        </div>
        <div class="mr-5"><?php echo 0 ?> Messages</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('/'.$this->session->userdata('user')->loggedinas.'/message/all') ?>">
        <span class="float-left">View All</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div> -->
  <?php } ?>

  
  
  
</div>
