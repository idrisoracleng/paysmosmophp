
<?php
    if(!$product) redirect(site_url('/admin/product/all'));
    $product_rating = $this->db->query("SELECT * FROM product_rating WHERE product_id = '".$product['product_id']."'")->result_array();
    $avg_rating = $this->db->where('product_id', $product['product_id'])->select('AVG(rate) as avg_rating')->from('product_rating')->get()->row()->avg_rating;
    $seller_avg_rating = $this->db->where('seller_id', $product['user_id'])->select('AVG(rate) as avg_rating')->from('seller_rating')->get()->row()->avg_rating;
		$seller_rating = $this->db->query("SELECT * FROM seller_rating WHERE seller_id = '".$product['user_id']."'")->result_array();
		$variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product['product_id']])->result(); 
?>
  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/product/all') ?>">Products</a>
      </li>
      <li class="breadcrumb-item active">#<?php echo $product['code'] ?></li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a href="#" class="back-btn fas fa-arrow-left"> back</a>
        <i class="fas fa-product"></i>
				<?php echo $product['name'] ?>
				<?php $this->load->view('layouts/product/product_actions.php', $product); ?>
      </div>
      <div class="card-body">
        <div class="row">
          <!-- <div class="col-md-3 text-center">
              <h4>Seller Info</h4>
              <hr/>
              <div>
                <img style="width: 100px; height: 100px; border-radius: 100%;" src="<?php //echo site_url('/public/images/users/p.png') ?>"/>
              </div>
              <div class="mt-5">
                <p><?php //echo $product['full_name'] ?></p>
                <p><?php //echo $product['email'] ?></p>
                <p><?php //echo count($seller_rating).' rating' ?></p>
                <?php //$i = 0; while($i < 5){ ?>
                  <?php //if($seller_avg_rating > $i){ ?>
                      <span class="fa fa-star text-success"></span>
                  <?php //}else{ ?>
                      <span class="fa fa-star"></span>
                  <?php //} ?>
              <?php //$i++; } ?>
              </div>
              
          </div> -->
          <div class="col-md-5">
            <h4>Gallery</h4>
            <hr/>
            <?php $product_images = array_diff(scandir(APPPATH.'../public/images/products/'.$product['code']), ['.', '..']) ?>
            <div class="row">
                <?php foreach($product_images as $pimage){ ?>
                    <div class="col-md-4 p-3 shadow">
                        <img style="height: 100px; width: 100%" src="<?php echo site_url('public/images/products/'.$product['code'].'/'.$pimage) ?>"/>
                    </div>
                <?php } ?>
            </div>
          </div>
          <div class="col-md-7">
            <h4><?php echo $product['name'] ?></h4>
            Rating: <?php echo count($product_rating) ?> &nbsp;
            <?php $i = 0; while($i < 5){ ?>
                <?php if($avg_rating > $i){ ?>
                    <span class="fa fa-star text-success"></span>
                <?php }else{ ?>
                    <span class="fa fa-star"></span>
                <?php } ?>
            <?php $i++; } ?>
            <hr/>
            <?php
                $subcat = $this->CategoryModel->getCategory($product['category_id']);
                $cat = $this->CategoryModel->getCategory($subcat['parent_id']);
            ?>
            <p>Price: <?php echo ($variants) ? $this->cart->format_number($variants[0]->price) : $this->cart->format_number($product['price']); ?> &nbsp; Category: <?php echo $cat['name'].' > '.$subcat['name'] ?></p>
            <hr/>
            <h5>Description</h5>

            <p><?php echo $product['description'] ?></p>
					</div>
        </div>
			</div>
			<?php if ($variants) { ?>
				<div class="">
					<?php $this->load->view('layouts/product/product_variant_admin.php', array('name' => $product['name'],'variants'=> $variants)); ?>
				</div>
			<?php } ?>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
