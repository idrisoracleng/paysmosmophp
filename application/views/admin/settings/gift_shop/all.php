

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/gift_shop'); ?>">Gift Items</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fas fa-arrow-left back-btn" href="#"> back</a>
        <i class="fas fa-product"></i>
        All Gift Item <a href="<?php echo site_url('/admin/settings/gift_shop/add') ?>" style="float: right" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add Gift Shop Item<span class="fa fa-product"></span></a></div>
      <div class="card-body">
        <div class="row justify-content-center">
            
					<?php foreach ($gift_shop_items as $key => $gift_shop_item) { ?>
						<div class="col-md-3 shadow rounded border border-primary">
							<div class="row">
								<div class="col-md-6">
									<img style="height: 150px; max-width: 250px;" src="<?php echo site_url('/public/images/products/'.$gift_shop_item['code'].'/01.jpg') ?>"/>
								</div>
								<div class="col-md-6">
									<h5><a href="<?php echo site_url('admin/product/view/'.$gift_shop_item['code']); ?>"><?php echo $gift_shop_item['name'] ?></a></h5>
									<p style="font-weight: bolder;"><?php echo $gift_shop_item['reward_point']; ?> Points</p>
									<p style="font-weight: bolder;"><?php echo $this->db->get_where('reward_stages', ['id' => $gift_shop_item['reward_stage']])->row()->name; ?> Stage</p>
								</div>
								<form 
										class="col-md-12 form-row" 
										action="<?php echo site_url('admin/settings/gift_shop/update/'.$gift_shop_item['id']) ?>" 
										method="post" msg="Updating <?php echo $gift_shop_item['name'] ?> in Gift Shop Data">
									<input type="hidden" name="id" value="<?php echo $gift_shop_item['id'] ?>"/>
									<input type="hidden" name="product_id" value="<?php echo $gift_shop_item['product_id'] ?>"/>
									<div class="form-group col-md-6 mt-2">
										<input type="number" name="reward_point" class="form-control" min="0" value="<?php echo $gift_shop_item['reward_point'] ?>"/>
									</div>
									<div class="form-group col-md-6 mt-2">
										<?php $stages = $this->db->get_where('reward_stages')->result(); ?>
										<select class="form-control" name="reward_stage">
											<option selected disabled>Select Reward Stage</option>
											<?php foreach ($stages as $key => $stage) { ?>
												<option 
													<?php echo ($gift_shop_item['reward_stage'] == $stage->id) ? 'selected' : ''; ?>
													value="<?php echo $stage->id; ?>"><?php echo $stage->name; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group col-md-12">
										<label>Start Time: <?php echo $gift_shop_item['start_time']; ?></label>
										<input type="datetime-local" name="start_time" class="form-control" value="<?php echo $gift_shop_item['start_time']; ?>"/>
									</div>

									<div class="form-group col-md-12">
										<label>End Time: <?php echo $gift_shop_item['start_time']; ?></label>
										<input type="datetime-local" name="end_time" class="form-control" value="<?php echo $gift_shop_item['start_time']; ?>"/>
									</div>
									
									<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-sync"></i> Update Gift Shop</button>
									<a 
										href="<?php echo site_url('admin/settings/gift_shop/delete/'.$gift_shop_item['id']); ?>" 
										class="btn btn-sm btn-danger delete_btn"><i class="fas fa-trash"></i> Delete</a>
								</form>
							</div>
						</div>
					<?php } ?>
        </div>
      </div>
    </div>

  </div>
