
<?php
  $variants = null;
  $price = 0;
  if (isset($_GET['from']) && ($_GET['from'] == 'deal')) {
		$variants = $this->db->get_where('variants', ['product_id' => $product['product_id']])->result_array();
    if ($deal = $this->db->limit(1)->get_where('product_deals_of_the_day', ['product_id' => $product['product_id']])->row()) {
      $price = $deal->deal_price;
    }  else {
      $price = ($product['discount_price']) ? $product['discount_price'] : $product['price'];
    }
  } else if ((isset($_GET['from']) && isset($_GET['id'])) && ($_GET['from'] == 'gift')) {
		$item_id = $_GET['id'];
		$item = $this->db->get_where('gift_shop_items', ['id' => $item_id])->row();
		$price = $item->reward_point;
		// exit();
	} else {
		$variants = $this->db->get_where('variants', ['product_id' => $product['product_id']])->result_array();
    $price = ($product['discount_price']) ? $product['discount_price'] : $product['price'];
  }
?>

<style>
  .variants:hover {
    cursor: hand;
  }
</style>


<!-- start :: breadcrumb   -->
<!-- <div class="container">
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
</div> -->


<!-- end :: breadcrumb   -->











<div class="container mt-5">

<div class="single_product">
    
      <div class="row">

        <!-- Images -->
        <div class="col-lg-2">
          <ul class="image_list">
             <?php $images = array_diff((array) scandir(APPPATH.'/../public/images/products/'.$product['code']), ['.', '..']);?>
                <?php foreach($images as $image){ ?>
            <li data-image="images/single_4.jpg"><img src="<?php echo site_url('public/images/products/'.$product['code'].'/'.$image) ?>" alt="" class="img-thumbnail"></li>
           
          <?php } ?>
          </ul>
        </div>

        <!-- Selected Image -->
        <div class="col-lg-5">
          <img src="<?php echo site_url('public/images/products/'.$product['code'].'/'.$image) ?>" class="img-fluid" alt="">
        </div>


        <div class="col-lg-5 single-right-left simpleCart_shelfItem">
          <h3 class="mb-3" style="font-variant: small-caps; text-transform: uppercase"><?php echo $product['name'] ?></h3>

        <div class="box-review" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
          <?php $this->load->view('layouts/product/product_rating', $product) ?>
          <a class="reviews_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo count($this->db->get_where('product_rating', ['product_id' => $product['product_id']])->result()) ?> reviews</a>
          <span class="order-num">
            <i class="fa fa-free-code-camp" aria-hidden="true"></i> 0 sold. Only <?php echo $product['quantity']?> remain
          </span>
        </div>

        <p class="mb-3">
          <span class="item_price" style="color:blue;font-weight:bold;">₦<span class="p"><?php echo ($variants) ? $variants[0]['price'] : $this->cart->format_number($price); ?></span></span><br>
          <del class="mx-2 font-weight-light">₦ </del>
          <label>Free delivery</label>
        </p>
        <div class="model">
          <span>Brands: </span> <?php echo $product['brand'] ?>
        </div>
        <div class="model">
          <span>Product Code: </span> SKU-<?php echo $product['code'] ?>
        </div>
        <div class="stock"><span> Stock </span> <i class="fa fa-check-square-o"></i> In Stock</div>
        <?php $this->load->view('layouts/product/addToCart', $product) ?>

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



   
     
    










<div class="container mt-5 mb-5" id="content-desktop">
  <div class="row">

    <div class="col-lg-12">
      <div class="card">
      <div class="card-header text-dark bg-white" style="font-size: 1.25rem;">
        <b>Product Details</b>
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




