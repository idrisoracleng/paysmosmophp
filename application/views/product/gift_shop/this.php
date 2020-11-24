
<?php
  $product = (array) $item;
	$variants = null;
	$price = $item->reward_point;
?>
<?php $whoCanBuy = $this->db->get_where('reward_stages', ['id' => $product['reward_stage']])->row(); ?>
<style>
  .variants:hover {
    cursor: hand;
  }
</style>


<!-- start :: breadcrumb   -->
<div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a class="breadcrumb-item" href="http://www.cmacbeth.com/cm/index.php?route=common/home">Home</a>
      <a class="breadcrumb-item" href="#">Fashion</a>
      <a class="breadcrumb-item" href="#">Men's Fashion</a>
      <a class="breadcrumb-item" href="#">Shoes</a>
      <a class="breadcrumb-item" href="#">Fashion Sneakers</a>
      <span class="breadcrumb-item active">Men's SMART - 02 Sneakers MAROON</span>
    </li>
  </ol>
</div>


<!-- end :: breadcrumb   -->



<!-- Single Page -->
  <div class="banner-bootom-w3-agileits py-5">
    <div class="container py-xl-4 py-lg-2">

      <div class="row">
        <div class="col-lg-5 col-md-8 single-right-left ">
          <div class="grid images_3_of_2">
            <div class="flexslider">
              <ul class="slides">
                <?php $images = array_diff((array) scandir(APPPATH.'/../public/images/products/'.$product['code']), ['.', '..']);?>
                <?php foreach($images as $image){ ?>
                  <li data-thumb="<?php echo site_url('public/images/products/'.$product['code'].'/'.$image) ?>">
                    <div class="thumb-image">
                      <img src="<?php echo site_url('public/images/products/'.$product['code'].'/'.$image) ?>" data-imagezoom="true" class="img-fluid" alt="">
                    </div>
                  </li>
                <?php } ?>
              </ul>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>

        <div class="col-lg-7 single-right-left simpleCart_shelfItem">
          <h3 class="mb-3" style="font-variant: small-caps; text-transform: uppercase"><?php echo $product['name'] ?></h3>

        <div class="box-review" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
          <?php $this->load->view('layouts/product/product_rating', $product) ?>
          <a class="reviews_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo count($this->db->get_where('product_rating', ['product_id' => $product['product_id']])->result()) ?> reviews</a>
          <span class="order-num">
            <i class="fa fa-free-code-camp" aria-hidden="true"></i> 0 sold. Only <?php echo $product['quantity']?> remain
          </span>
        </div>

        <p class="mb-3">
          <span class="item_price" style="color:blue;font-weight:bold;"><span class="p"><?php echo $item->reward_point.' point'; ?></span></span><br>
          <span class="item_price" style="color:red;font-weight:bold;"><span class="p"><?php echo ($whoCanBuy) ? $whoCanBuy->name : ''; ?></span></span><br>
          <!-- <del class="mx-2 font-weight-light">₦ </del> -->
          <label>Free delivery</label>
        </p>
        <div class="model">
          <span>Brands: </span> <?php echo $product['brand'] ?>
        </div>
        <div class="model">
          <span>Product Code: </span> SKU-<?php echo $product['code'] ?>
        </div>
				<div class="stock"><span> Stock </span> <i class="fa fa-check-square-o"></i> In Stock</div>
				<?php unset($product['price']); ?>
        <?php $this->load->view('layouts/product/addToCart', $product+['means' => 'gift', 'price' => $price ]) ?>

        <?php if ($variants) { ?>
          <h5>Variants</h5>
          <div class="row">
            <?php foreach ($variants as $key => $variant) { ?>
              <?php $this->load->view('layouts/product/variant.php', $variant); ?>
            <?php } ?>
          </div>
        <?php } ?>

        </div>
      </div>
    </div>
  </div>
<!-- //Single Page -->

<div class="container-fluid">
  <div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header h5 bg-white" style="color:black;">
        Product Details
        </div>

        <div class="card-body">

        <p class="card-text text-dark">
          <?php echo $product['description']; ?>
        </p>

        </div>


      </div>
    </div>

  </div>
  <!-- end second column -->
  <!-- end row -->

</div>


<!-- <div class="container mt-5">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header h5 bg-white" style="color:black;">
          Recently Viewed
        </div>

        <div class="card-body">
        
        <div class="row flexiselDemo14">
          <div class="col"><img src="<?php echo base_url();?>resources/images/job1.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job2.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job3.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job4.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job5.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job6.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job7.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job8.jpg"/>
            <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job9.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job10.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          <div class="col"><img src="<?php echo base_url();?>resources/images/job11.jpg"/>
          <span style="color:black;">Lorem </span><br>
            <span style="color:black;">₦7,500</span><br>
            <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span>
          </div>

          </div>

        </div>

      </div>
    </div>
  </div>
</div> -->




<div class="container-fluid mt-5">
  <div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header h5 bg-white" style="color:black;">
        Customer Feedback
        </div>

        <div class="card-body">
        <p class="card-text">feed back</p>
        </div>

      </div>
    </div>


  <!-- end row -->

  </div>
</div>


<?php $other_seller_products = $this->db->get_where('products', ['owner_id' => $product['owner_id'], 'product_id != ' => $product['product_id']])->result(); ?>
<?php if ($other_seller_products) { ?>
  <div class="container-fluid mt-5">
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header h5 bg-white" style="color:black;">
            More items from this seller
          </div>

          

          <div class="card-body">
          <div class="row flexiselDemo14">
            <?php foreach ($other_seller_products as $key => $seller_other_product) { ?>
              <div class="col">
              <a href="<?php echo site_url('/product/'.str_replace([' '], ['-'], $seller_other_product->name)) ?>">
                    <img class="card-img-top" src="<?php echo site_url('public/images/products/'.$seller_other_product->code.'/01.jpg') ?>" alt="<?php echo $seller_other_product->name ?>">
                  </a>
                <span style="color:black;"><?php echo $seller_other_product->name; ?> </span><br>
                <?php if ($seller_other_product->discount_price) { ?>
                  <span style="color:black;">₦<?php echo $this->cart->format_number($seller_other_product->discount_price); ?></span><br>
                  <span class="item-price"  style="color:gray;"><strike>₦<?php echo $this->cart->format_number($seller_other_product->price); ?></strike></span>
                <?php } else { ?>
                  <span style="color:black;">₦<?php echo $seller_other_product->price; ?></span>
                <?php } ?>
              </div>
            <?php } ?>

            </div>
            
        
          </div>

        </div>
      </div>


    <!-- end row -->

    </div>
  </div>
<?php } ?>



<?php $featured_products = $this->db->get_where('products', ['featured' => 1])->result(); ?>
<?php if ($featured_products) { ?>
  <div class="container-fluid mt-5">
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header h5 bg-white" style="color:black;">
            Featured Products
          </div>

          <div class="card-body">
            <div class="row flexiselDemo14">
              <?php foreach ($featured_products as $key => $featured_product) { ?>
                <div class="col">
                  
                  <a href="<?php echo site_url('/product/'.str_replace([' '], ['-'], $featured_product->name)) ?>">
                    <img class="card-img-top" src="<?php echo site_url('public/images/products/'.$featured_product->code.'/01.jpg') ?>" alt="<?php echo $featured_product->name ?>">
                  </a>
                  <br>
                  <?php if ($featured_product->discount_price) { ?>
                    <span style="color:black;">₦<?php echo $this->cart->format_number($featured_product->discount_price); ?></span><br>
                    <span class="item-price"  style="color:gray;"><strike>₦<?php echo $this->cart->format_number($featured_product->price); ?></strike></span>
                  <?php } else { ?>
                    <span style="color:black;">₦<?php echo $featured_product->price; ?></span>
                  <?php } ?>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>


    <!-- end row -->

    </div>
  </div>
<?php } ?>




<?php $related_products = $this->db->get_where('products', ['category_id' => $product['category_id']])->result(); ?>
<?php if($related_products){ ?>
  <div class="container-fluid mt-5 mb-5">
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header h5 bg-white" style="color:black;">
            Related Products
          </div>

            <ul id="flexiselDemo16">
              <?php foreach($related_products as $related_product){ ?>
                <?php if($related_product->code != $product['code']){ ?>
                  <li>

                      <a href="<?php echo site_url('/product/'.str_replace([' '], ['-'], $related_product->name)) ?>">
                        <img class="card-img-top" src="<?php echo site_url('public/images/products/'.$related_product->code.'/01.jpg') ?>" alt="<?php echo $related_product->name ?>">
                      </a>
                      <div class="card-body" style="background:#f7f7f7;">
                        <!-- here -->
                        <div class="thumb-content">
                          <div class="star-rating text-center">
                            <ul class="list-inline">
                              <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
                              <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
                              <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
                              <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star"></i></li>
                              <li class="list-inline-item" style="font-size:10px;"><i class="fa fa-star-o"></i></li>
                            </ul>
                          </div>
                            <h4 class="text-center"><?php echo $related_product->name; ?></h4>
                            <p class="item-price text-center"> <span style="color:blue;"><b>₦ <?php echo $this->cart->format_number($related_product->price); ?></b></span></p>
                        </div>
                        <!-- here -->
                      </div>

                  </li>
                <?php } ?>
              <?php } ?>
              
            </ul>
        </div>
      </div>
      


    </div>
  </div>
<?php } ?>





<!-- /.modal -->


<script src="<?php echo site_url('public/js/this_product.js') ?>"></script>
<script src="<?php echo site_url('public/js/rating.js') ?>"></script>
<script src="<?php echo site_url('public/js/add_to_cart.js') ?>"></script>
<script>
  $(document).ready(function () {
    $('.select_variant').click(function () {
		var item_price = $(".p");
		var checkout_price = $('#pprice');
		var oto = $('#oto');

		var size = $(this).attr('size');
		let price = $(`#${size}_price`).val();
		let otto = $(`#${size}_size`).val();

		item_price.text(price);
		checkout_price.val(price);
		oto.val(`size: ${otto}`);
		// alert(size);
    });
  });
</script>




