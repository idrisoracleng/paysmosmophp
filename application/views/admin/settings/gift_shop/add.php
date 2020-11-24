

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/gift_shop'); ?>">Gift Shop Items</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fas fa-arrow-left back-btn" href="#"> back</a>
        <i class="fas fa-product"></i>
        Add Gift Shop Item <a href="<?php echo site_url('/admin/settings/gift_shop') ?>" style="float: right" class="btn btn-sm btn-primary"><i class="fas fa-list"></i> All Gift Item <span class="fa fa-product"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
						<tr>
							<th>Name</th>
							<th>Image</th>
							<th>Price</th>
							<th>Point to pay</th>
							<th>Reward Stage</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Actions</th>
						</tr>
                    </thead>
                    <tfoot>
						<tr>
							<th>Name</th>
							<th>Image</th>
							<th>Price</th>
							<th>Point to pay</th>
							<th>Reward Stage</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Actions</th>
						</tr>
                    </tfoot>
                    <tbody>
						<?php foreach ($products as $key => $product) { ?>
							<?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product['product_id']])->result(); ?>
							<tr>
								<form action="<?php echo site_url('admin/settings/gift_shop/store') ?>" method="post" msg="Adding <?php echo $product['name'] ?> to gift shop">
									<input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>"/>
									<td><?php echo $product['name'] ?></td>
									<td><img style="height: 30px; width: 30px" src="<?php echo site_url('/public/images/products/'.$product['code'].'/01.jpg') ?>"/></td>
									<td><?php echo ($variants) ? $variants[0]->price : $product['price'] ?></td>
									<td><input type="number" name="reward_point" class="form-control" min="0"/></td>
									<td>
										<?php $stages = $this->db->get_where('reward_stages')->result(); ?>
										<select class="form-control custom-select-sm" name="reward_stage">
											<option selected disabled>Select Reward Stage</option>
											<?php foreach ($stages as $key => $stage) { ?>
												<option value="<?php echo $stage->id ?>"><?php echo $stage->name; ?></option>
											<?php } ?>
										</select>
									</td>
									<td><input type="datetime-local" name="start_time" class="form-control"/></td>
									<td><input type="datetime-local" name="end_time" class="form-control" /></td>
									<td><button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add</button></td>
								</form>
							</tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
      </div>
      <div class="card-footer small text-muted">
          <?php //$this->DealsOfTheDayModel->getActiveDealsOfTheDay(); ?>
      </div>
    </div>

  </div>
