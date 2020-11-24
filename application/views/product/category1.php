<div id="content" class="site-content" tabindex="-1">
  <div class="col-full">
    <div class="row">
      <nav class="woocommerce-breadcrumb">
          <a href="<?php echo base_url();?>">Home</a>
          <span class="delimiter">
              <i class="tm tm-breadcrumbs-arrow-right"></i>
          </span>Computers &amp; Laptops
      </nav>
      <!-- .woocommerce-breadcrumb -->
      <div id="primary" class="content-area">
          <main id="main" class="site-main">
              <section class="section-product-categories">
                  <header class="section-header">
                      <h1 class="woocommerce-products-header__title page-title"><?php echo str_replace(['-'], [' '], strtoupper($cat)); ?></h1>
                  </header>
                  <div class="woocommerce columns-5">
                      <div class="product-loop-categories">
                         <?php if($cat == 'all'){ ?>
                            <?php foreach($cats as $category) { ?>
                                <div class="product-category product first">
                                    <a href="<?php echo base_url('product/category/'.str_replace([' '], ['-'], strtolower($category->name)));?>">
                                        <img src="<?php echo base_url('public/images/system/categories/'.str_replace([' '], ['-'], strtolower($category->name)).'.jpg');?>" alt="Ultrabooks" width="224" height="197">
                                        <h2 class="woocommerce-loop-category__title"> <?php echo $category->name ?>
                                            <mark class="count">(5)</mark>
                                        </h2>
                                    </a>
                                </div>
                            <?php } ?>
                          <?php } ?>
                          
                      </div>
                      <!-- .product-loop-categories -->
                  </div>
                  <!-- .woocommerce -->
              </section>
              <!-- .section-product-categories -->
              <section class="section-products-carousel" id="homev6-carousel-3">
                  <header class="section-header">
                    <?php if($cat != 'all'){ ?>
                      <h2 class="section-title">Sub Categories</h2>
                      <?php } ?>
                      <nav class="custom-slick-nav"></nav>
                      <!-- .custom-slick-nav -->
                  </header>
                  <!-- .section-header -->
                  <div class="products-carousel 6-column-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:6,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:true,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#homev6-carousel-3 .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:750,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                      <div class="container-fluid">
                          <div class="woocommerce columns-6">
                              <div class="products">
                                <?php if($subcats){ ?>
                                <?php foreach($subcats as $category){ ?>
                                  <div class="product">
                                     <!--  <div class="yith-wcwl-add-to-wishlist">
                                          <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                      </div> -->
                                      <a href="<?php echo base_url( "product/category/".str_replace([" "], ["-"], strtolower($category["name"])) );?>" class="woocommerce-LoopProduct-link">
                                          <img src="<?php echo base_url('public/images/system/categories/'.str_replace([' '], ['-'], strtolower($category['name'])).'.jpg');?>" width="224" height="197" class="wp-post-image" alt="">
                                          <span class="price">
                                              <ins>
                                                  <span class="amount"> </span>
                                              </ins>
                                              <span class="amount"> 262.81</span>
                                          </span>
                                          <!-- /.price -->
                                          <h2 class="woocommerce-loop-product__title"><?php echo $category['name'] ?></h2>
                                      </a>
                                      <div class="hover-area">
                                          <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                          <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                      </div>
                                  </div>
                                  <!-- /.product-outer -->
                                   <?php } ?>
                                  <?php } ?>
                                  
                              </div>
                          </div>
                          <!-- .woocommerce-->
                      </div>
                      <!-- .container-fluid -->
                  </div>
                  <!-- .products-carousel -->
              </section>
              <!-- .section-products-carousel -->
              
          </main>
          <!-- #main -->
      </div>
      <!-- #primary -->
      
    </div>
      <!-- .row -->
  </div>
    <!-- .col-full -->
</div>













