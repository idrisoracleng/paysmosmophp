<?php
$variants = null;
$price = 0;
$isAddedToCart = false;
// echo $product['product_id'];
$category = $this->db->get_where('category', ['id' => $product['category_id']])->row();
// var_dump($category); exit();
$parentCategory = null;
if ($category->parent_id != 0) {
  $parentCategory = $this->db->get_where('category', ['id' => $category->parent_id])->row();
}
if (isset($_GET['from']) && ($_GET['from'] == 'deal')) {
  $variants = $this->db->get_where('variants', ['product_id' => $product['product_id']])->result_array();
  if ($deal = $this->db->limit(1)->get_where('product_deals_of_the_day', ['product_id' => $product['product_id']])->row()) {
    $price = $deal->deal_price;
  } else {
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


<br><br>

<!-- ============================================================= Header End ============================================================= -->
<div id="content" class="site-content" tabindex="-1">
  <div class="col-full">
    <div class="row m-2">
      <div class="col">
        <nav class="woocommerce-breadcrumb">
          <a href="<?php echo site_url(); ?>">Home</a>
          <?php if ($parentCategory != null) { ?>
            <span class="delimiter">
              <i class="tm tm-breadcrumbs-arrow-right"></i>
            </span><a href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], strtolower($parentCategory->name))) ?>"><?php echo $parentCategory->name; ?></a>
            <span class="delimiter">
              <i class="tm tm-breadcrumbs-arrow-right"></i>
            </span><a href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], strtolower($category->name))) ?>"><?php echo $category->name; ?></a>
          <?php } ?>

          <?php if ($parentCategory == null) { ?>
            <span class="delimiter">
              <i class="tm tm-breadcrumbs-arrow-right"></i>
            </span><a href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], strtolower($category->name))) ?>"><?php echo $category->name; ?></a>
          <?php } ?>
          <span class="delimiter">
            <i class="tm tm-breadcrumbs-arrow-right"></i>
          </span><?php echo $product['name']; ?>
        </nav>
      </div>
    </div>



    <!-- <nav class="woocommerce-breadcrumb">
                            <a href="home-v1.html">Home</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span><a href="product-category.html">TV & Video</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>60UH6150 60-Inch 4K Ultra HD Smart LED TV
                        </nav> -->
    <!-- .woocommerce-breadcrumb -->
    <div id="primary" class="content-area">
      <main id="main" class="site-main">
        <div class="product-type-simple">
          <div class="single-product-wrapper">
            <div class="product-images-wrapper thumb-count-4">
              <span class="onsale">-
                <!-- <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">₦</span>242.99</span> -->
              </span>
              <!-- .onsale -->
              <div id="techmarket-single-product-gallery" class="techmarket-single-product-gallery techmarket-single-product-gallery--with-images techmarket-single-product-gallery--columns-4 images" data-columns="4">
                <div class="techmarket-single-product-gallery-images" data-ride="tm-slick-carousel" data-wrap=".woocommerce-product-gallery__wrapper" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:false,&quot;asNavFor&quot;:&quot;#techmarket-single-product-gallery .techmarket-single-product-gallery-thumbnails__wrapper&quot;}">
                  <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4">
                    <!--<a href="#" class="woocommerce-product-gallery__trigger">🔍</a>-->
                    <figure class="woocommerce-product-gallery__wrapper ">

                      <?php $images = array_diff((array) scandir(APPPATH . '/../public/images/products/' . $product['code']), ['.', '..']); ?>

                      <?php foreach ($images as $image) { ?>
                        <div data-thumb="<?php echo base_url(); ?>assets/images/products/sm-card-1.jpg" class="woocommerce-product-gallery__image">
                          <a href="<?php echo site_url('public/images/products/' . $product['code'] . '/' . $image) ?>" tabindex="0">
                            <img width="600" height="600" src="<?php echo site_url('public/images/products/' . $product['code'] . '/' . $image) ?>" class="attachment-shop_single size-shop_single wp-post-image" alt="">
                          </a>
                        </div>
                      <?php } ?>

                    </figure>
                  </div>
                  <!-- .woocommerce-product-gallery -->
                </div>
                <!-- .techmarket-single-product-gallery-images -->
                <div class="techmarket-single-product-gallery-thumbnails" data-ride="tm-slick-carousel" data-wrap=".techmarket-single-product-gallery-thumbnails__wrapper" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;vertical&quot;:true,&quot;verticalSwiping&quot;:true,&quot;focusOnSelect&quot;:true,&quot;touchMove&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-up\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-down\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;asNavFor&quot;:&quot;#techmarket-single-product-gallery .woocommerce-product-gallery__wrapper&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:765,&quot;settings&quot;:{&quot;vertical&quot;:false,&quot;horizontal&quot;:true,&quot;verticalSwiping&quot;:false,&quot;slidesToShow&quot;:4}}]}">
                  <figure class="techmarket-single-product-gallery-thumbnails__wrapper">

                    <?php $images = array_diff((array) scandir(APPPATH . '/../public/images/products/' . $product['code']), ['.', '..']); ?>

                    <?php foreach ($images as $image) { ?>
                      <figure data-thumb="<?php echo base_url(); ?>assets/images/products/sm-card-1.jpg" class="techmarket-wc-product-gallery__image">
                        <img width="180" height="180" src="<?php echo site_url('public/images/products/' . $product['code'] . '/' . $image) ?>" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">
                      </figure>
                    <?php } ?>

                  </figure>
                  <!-- .techmarket-single-product-gallery-thumbnails__wrapper -->
                </div>
                <!-- .techmarket-single-product-gallery-thumbnails -->
              </div>
              <!-- .techmarket-single-product-gallery -->
            </div>
            <!-- .product-images-wrapper -->
            <div class="summary entry-summary">
              <div class="single-product-header">
                <h1 class="product_title entry-title"><?php echo $product['name'] ?></h1>
              </div>
              <!-- .single-product-header -->

              <!-- .single-product-meta -->

              <?php //$this->load->view('layouts/product/product_rating', $product) 
              ?>


              <!-- .rating-and-sharing-wrapper -->
              <div class="woocommerce-product-details__short-description">
                <ul>
                  <li>
                    <?php echo $product['description']; ?>
                  </li>

                </ul>
              </div>



              <!-- <div class="model">
          <span>Brands: </span> <?php //echo $product['brand'] 
                                ?>
        </div>
        <div class="model">
          <span>Product Code: </span> SKU-<?php //echo $product['code'] 
                                          ?>
        </div>
        <div class="stock"><span> Stock </span> <i class="fa fa-check-square-o"></i> In Stock</div>
        <?php //$this->load->view('layouts/product/addToCart', $product) 
        ?>

        <?php //if ($variants) { 
        ?>
          <h5>Variants</h5>
          <div class="row">
            <?php //foreach ($variants as $key => $variant) { 
            ?>
              <?php //$this->load->view('layouts/product/variant.php', $variant); 
              ?>
            <?php //} 
            ?>
          </div>
        <?php //} 
        ?> -->


              <!-- <div class="box-review" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
        <?php //$this->load->view('layouts/product/product_rating', $product) 
        ?>
        <a class="reviews_button" href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php //echo count($this->db->get_where('product_rating', ['product_id' => $product['product_id']])->result()) 
                                                                                                                  ?> reviews</a>
        <span class="order-num">
          <i class="fa fa-free-code-camp" aria-hidden="true"></i> 0 sold. Only <?php //echo $product['quantity']
                                                                                ?> remain
        </span>
      </div> -->




              <!-- .woocommerce-product-details__short-description -->
              <div class="product-actions-wrapper">
                <div class="product-actions">
                  <p class="price">
                    <!--  <del>
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">₦</span>1,239.99</span>
                                                        </del> -->
                    <ins>
                      <span class="woocommerce-Price-amount amount" id="content-desk">
                        <span class="woocommerce-Price-currencySymbol">₦</span><?php echo ($variants) ? $this->cart->format_number($variants[0]['price'] / 4) . ' <small>Paid Monthly</small>' : $this->cart->format_number($price / 4) . ' <small>Paid Monthly</small>'; ?></span>

                      <span class="woocommerce-Price-amount amount" id="content-mobile" style="font-size:26px;">
                        <span class="woocommerce-Price-currencySymbol">₦</span><?php echo ($variants) ? $this->cart->format_number($variants[0]['price'] / 4) . ' <small>Paid Monthly</small>' : $this->cart->format_number($price / 4) . ' <small>Paid Monthly</small>'; ?></span>

                    </ins>

                  </p>



                  <!-- .cart -->

                </div>
                <!-- .product-actions -->
              </div>
              <!-- .product-actions-wrapper -->

              <div class="woocommerce-product-details__short-description text-center">
                <?php $this->load->view('layouts/product/addToCart', $product) ?>
              </div>

            </div>
            <!-- .entry-summary -->
          </div>
          <!-- .single-product-wrapper -->
          <?php $related_products = $this->db->order_by('RAND()', 'ASC')->limit(6)->get_where('products', ['category_id' => $product['category_id']])->result(); ?>
          <?php if ($related_products) { ?>
            <div class="tm-related-products-carousel section-products-carousel" id="tm-related-products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;slidesToShow&quot;:7,&quot;slidesToScroll&quot;:7,&quot;dots&quot;:true,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#tm-related-products-carousel .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:767,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:780,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
              <section class="related">
                <header class="section-header">
                  <h2 class="section-title">Related products</h2>
                  <nav class="custom-slick-nav"></nav>
                </header>
                <!-- .section-header -->
                <div class="row">
                  <?php foreach ($related_products as $related_product) { ?>
                    <?php if ($related_product->code != $product['code']) { ?>
                      <?php $prod = (array) $related_product;
                      $this->load->view('layouts/product/one_product', $prod); ?>
                    <?php } ?>
                  <?php } ?>
                </div>
              </section>
              <!-- .single-product-wrapper -->
            </div>
            <!-- .tm-related-products-carousel -->
          <?php } ?>



          <script src="<?php echo site_url('public/js/this_product.js') ?>"></script>
          <script src="<?php echo site_url('public/js/rating.js') ?>"></script>
          <script src="<?php echo site_url('public/js/add_to_cart.js') ?>"></script>
          <script>
            $(document).ready(function() {
              $('.select_variant').click(function() {
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