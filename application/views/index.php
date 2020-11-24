<?php
$activeDealsOfTheDay = $this->DealsOfTheDayModel->getActiveDealsOfTheDay();

function showDealData($date)
{
    echo $date;
}
?>

<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <div class="container-fluid" style="margin-top:20px;margin-bottom:40px;">

                        <div class="row">
                            <div class="card col-lg-2 col-sm-2" style="border-radius:5px;padding-top:20px;" id="content-desk">
                                <ul class="cat_menu" style="padding-bottom: 5px; list-style-type: none;">
                                    <!-- <div class="" style="padding-bottom: 5px; list-style-type: none;"> -->
                                    <?php $parentCategories = $this->CategoryModel->getParentCategories(); ?>
                                    <?php
                                    $sty = array('fa fa-mobile', 'fa fa-battery-full', 'fa fa-tv', 'fa fa-home', 'fa fa-desktop');


                                    $count_icon = 0;
                                    foreach ($parentCategories as $key => $category) { ?>
                                        <li class="" style="height:32px; font-size:.75rem;">
                                            <a title="<?php echo $category->name; ?>" style="font-size:.75rem;position:absolute;left:7px;" href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], strtolower($category->name))) ?>">
                                                <i class="<?php echo $category->icon; ?>" style="font-size:15px;color:red;"></i>&nbsp
                                                <?php echo $category->name; ?>
                                            </a>
                                        </li>

                                    <?php $count_icon++;
                                    } ?>


                                    <!-- </div> -->
                                </ul>

                            </div>
                            <?php $this->load->view('layouts/general/page_banner_slide'); ?>
                        </div>







                    </div>
                    <!-- END :: DESKTOP CONTENT VIEW TOP BANNER N CATEGORIES -->



                    <!-- <div class="container-fluid" style="margin-top:2px;" id="content-mobile">

                        <div class="row">
                            <div class="card col-xs-12" style="border: none; background: none;">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="<?php echo base_url(); ?>assetz/images/newyear PSS.jpg" class="d-block w-100" alt="..." style="height:250px;">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?php echo base_url(); ?>assetz/images/promopss.jpg" class="d-block w-100" alt="..." style="height:250px;">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!-- /.MOBILE TOP BANNER -->











                    <!-- START :: FEATURED LIST DESKTOP CONTENT =============================================================================  -->
                    <!-- .home-v1-slider -->
                    <div class="features-list" id="content-desk">
                        <div class="features">
                            <div class="feature">
                                <div class="media">
                                    <i class="feature-icon d-flex mr-3 tm tm-free-delivery red-text"></i>
                                    <div class="media-body feature-text">
                                        <h5 class="mt-0">Fast Delivery</h5>
                                        <!-- <span>from 2000</span> -->
                                    </div>
                                </div>
                            </div>
                            <!-- .feature -->
                            <div class="feature">
                                <div class="media">
                                    <i class="feature-icon d-flex mr-3 tm tm-feedback"></i>
                                    <div class="media-body feature-text">
                                        <h5 class="mt-0">Product Warranty</h5>
                                        <!-- <span>Feedbacks</span> -->
                                    </div>
                                </div>
                                <!-- .media -->
                            </div>
                            <!-- .feature -->
                            <!-- <div class="feature">
                                <div class="media">
                                    <i class="feature-icon d-flex mr-3 tm tm-free-return"></i>
                                    <div class="media-body feature-text">
                                        <h5 class="mt-0">7 Days</h5>
                                        <span>for free return</span> 
                                    </div>
                                </div>
                                
                            </div> -->
                            <!-- .feature -->
                            <div class="feature">
                                <div class="media">
                                    <i class="feature-icon d-flex mr-3 tm tm-safe-payments"></i>
                                    <div class="media-body feature-text">
                                        <h5 class="mt-0">Suitable Payment</h5>
                                        <!-- <span>Secure System</span> -->
                                    </div>
                                </div>
                                <!-- .media -->
                            </div>
                            <!-- .feature -->
                            <div class="feature">
                                <div class="media">
                                    <i class="feature-icon d-flex mr-3 tm tm-best-brands"></i>
                                    <div class="media-body feature-text">
                                        <h5 class="mt-0">Best Brands</h5>
                                        <!-- <span>Brands</span> -->
                                    </div>
                                </div>
                                <!-- .media -->
                            </div>
                            <!-- .feature -->
                        </div>
                        <!-- .features -->
                    </div>
                    <!-- /.features list -->
                    <!-- END :: FEATURED LIST DESKTOP CONTENT =============================================================================  -->











                    <!-- START :: FEATURED LIST MOBILE CONTENT =============================================================================  -->

                    <!-- END :: FEATURED LIST MOBILE CONTENT =============================================================================  -->



                    <div class="row mt-3" id="content-desk">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header text-white" style="background: #fff;">

                                    <h5 class="card-title" style="font-size: 1.25rem;"><b>Top selling items</b> <a href="<?php echo site_url('product/category/top_collections') ?>" style="float: right; color: #4fa748">View all <i class="fa fa-angle-right"></i> </a></h5>



                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <?php foreach ($products as $product) { ?>
                                            <?php $this->load->view('layouts/product/one_product', $product); ?>
                                        <?php } ?>
                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end first row -->

                    <section class="section-landscape-products-carousel recently-viewed content-mobile mt-5" id="recently-viewed">
                        <header class="section-header">
                            <h2 class="section-title">Top selling items</h2>
                            <nav class="">
                                <a href="<?php echo site_url('product/category/top_collections') ?>" class="text-success">
                                    View all
                                </a>
                            </nav>
                        </header>
                        <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:2,&quot;dots&quot;:true,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#recently-viewed .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1700,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <?php
                                        // $attachment = (isset($deal_price)) ? '?from=deal' : '?from=market';
                                        // foreach ($products as $product) { 
                                        ?>
                                        <!-- <div class="landscape-product product">
                                                <a class="woocommerce-LoopProduct-link" href="<?php //echo site_url('/product/' . str_replace([' ', "'", '&'], ['-', '_', 'and'], strtolower($product['name']))) . $attachment 
                                                                                                ?>">



                                                    <div class="media">

                                                        <img class="card-img center lazy rounded-lg" data-src="<?php //echo site_url('/public/images/products/' . $product['code'] . '/01.jpg');
                                                                                                                ?>" src="<?php //echo site_url('assets/images/ajax-loader.gif'); 
                                                                                                                            ?>" style="height: 200px; width: 100%; object-fit: contain;" alt="<?php //echo $name; 
                                                                                                                                                                                                ?>" />
                                                        <div class="media-body">
                                                            <span class="price">
                                                                <ins>
                                                                    <span class="amount"> ₦<?php //echo number_format($product['discount_price']); //echo number_format($variants[0]->discount_price/4); 
                                                                                            ?></span>
                                                                </ins>
                                                                <del>
                                                                    <span class="amount">₦<?php //echo ($product['price']); 
                                                                                            ?></span>
                                                                </del>
                                                                <span class="amount"> </span>
                                                            </span>
                                                            
                                                            <h2 class="woocommerce-loop-product__title"><?php //echo character_limiter($product['name'], 20); //echo character_limiter($name, 20); 
                                                                                                        ?></h2>
                                                            <div class="techmarket-product-rating">
                                                                <div title="Rated 0 out of 5" class="star-rating">
                                                                    <span style="width:0%">
                                                                        <strong class="rating">0</strong> out of 5</span>
                                                                </div>
                                                                <span class="review-count">(0)</span>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </a>
                                            </div> -->
                                        <?php foreach ($products as $product) { ?>
                                            <?php $this->load->view('layouts/product/one_product', $product); ?>
                                        <?php } ?>
                                        <?php //$this->load->view('layouts/product/one_product.php', $product); 
                                        ?>
                                        <?php //} 
                                        ?>

                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .products-carousel -->
                    </section>
                    <!-- /.MOBILE TOP SELLING ITEMS -->




                    <!-- Popular Categories -->
                    <!-- <div class="popular_categories mt-3" style="padding-bottom:0px; padding-top: 8px;" id="content-desk">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="popular_categories_content">
                                            <div class="popular_categories_title">
                                                <h5 style="color:black;"><b>Popular Categories</b></h5>
                                            </div>
                                            
                                            <div class="popular_categories_link"><a href="#">full catalog</a></div>
                                        </div>
                                    </div>

                                   

                                    <div class="col-lg-9">
                                        <div class="popular_categories_slider_container">
                                            <div class="owl-carousel owl-theme popular_categories_slider">

                                              
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_1.png" alt=""></div>
                                                        <div class="popular_category_text">Smartphones & Tablets</div>
                                                    </div>
                                                </div>

                                                
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_2.png" alt=""></div>
                                                        <div class="popular_category_text">Computers & Laptops</div>
                                                    </div>
                                                </div>

                                               
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_3.png" alt=""></div>
                                                        <div class="popular_category_text">Gadgets</div>
                                                    </div>
                                                </div>

                                              
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_4.png" alt=""></div>
                                                        <div class="popular_category_text">Video Games & Consoles</div>
                                                    </div>
                                                </div>

                                                
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_5.png" alt=""></div>
                                                        <div class="popular_category_text">Accessories</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --


                    <!-- Popular Categories --
                    <div class="popular_categories" style="padding-bottom:0px; padding-top: 8px;" id="content-mobile">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="popular_categories_content">
                                            <div class="popular_categories_title">
                                                <h5 style="color:black;"><b>Popular Categories</b></h5>
                                            </div>
                                            <!-- <div class="popular_categories_slider_nav">
                            <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div> --
                                            <div class="popular_categories_link"><a href="#">full catalog</a></div>
                                        </div>
                                    </div>

                                    <!-- Popular Categories Slider --

                                    <div class="col-lg-9">
                                        <div class="popular_categories_slider_container">
                                            <div class="owl-carousel owl-theme popular_categories_slider">

                                                <!-- Popular Categories Item --
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_1.png" alt=""></div>
                                                        <div class="popular_category_text">Smartphones & Tablets</div>
                                                    </div>
                                                </div>

                                                <!-- Popular Categories Item --
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_2.png" alt=""></div>
                                                        <div class="popular_category_text">Computers & Laptops</div>
                                                    </div>
                                                </div>

                                                <!-- Popular Categories Item --
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_3.png" alt=""></div>
                                                        <div class="popular_category_text">Gadgets</div>
                                                    </div>
                                                </div>

                                                <!-- Popular Categories Item --
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_4.png" alt=""></div>
                                                        <div class="popular_category_text">Video Games & Consoles</div>
                                                    </div>
                                                </div>

                                                <!-- Popular Categories Item --
                                                <div class="owl-item">
                                                    <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                        <div class="popular_category_image"><img src="<?php echo base_url(); ?>assetz/images/popular_5.png" alt=""></div>
                                                        <div class="popular_category_text">Accessories</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->



                    <div class="row mt-3" id="content-desk">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-danger text-white" style="background: #fff;">
                                    <h5 class="card-title" style="font-size: 1.25rem;"><b>Deals Of The Week</b> </h5>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <?php foreach ($activeDealsOfTheDay as $key => $product) { ?>
                                            <?php $this->load->view('layouts/product/one_product', $product); ?>
                                        <?php } ?>
                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- DEALS OF THE WEEK ================================================================================================ -->






                    <div class="section-deals-carousel-and-products-carousel-tabs row content-mobile mt-3">
                        <section class="column-1 deals-carousel" id="sale-with-timer-carousel">
                            <div class="deals-carousel-inner-block">
                                <header class="section-header">
                                    <h2 class="section-title">
                                        <strong>Deals</strong> of the week</h2>
                                    <nav class="custom-slick-nav"></nav>
                                </header>
                                <!-- /.section-header -->
                                <div class="sale-products-with-timer-carousel deals-carousel-v1">
                                    <div class="products-carousel">
                                        <div class="container-fluid">
                                            <div class="woocommerce columns-1">
                                                <div class="products" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:true,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#sale-with-timer-carousel .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:767,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:1023,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}}]}">
                                                    <?php
                                                    $attachment = (isset($deal_price)) ? '?from=deal' : '?from=market';
                                                    foreach ($activeDealsOfTheDay as $key => $product) {
                                                        //foreach ($products as $product) {

                                                    ?>
                                                        <div class="sale-product-with-timer product">
                                                            <a class="woocommerce-LoopProduct-link" href="<?php echo site_url('/product/' . str_replace([' ', "'", '&'], ['-', '_', 'and'], strtolower($product['name']))) . $attachment ?>">
                                                                <div class="sale-product-with-timer-header">
                                                                    <div class="price-and-title">
                                                                        <span class="price">
                                                                            <ins>
                                                                                <span class="woocommerce-Price-amount amount">
                                                                                    <span class="woocommerce-Price-currencySymbol">₦ </span><?php echo ($product['discount_price'] / 4) . "/month"; ?></span>
                                                                            </ins><br>
                                                                            <del>
                                                                                <span class="woocommerce-Price-amount amount">
                                                                                   <!-- <span class="woocommerce-Price-currencySymbol">₦ </span><?php //echo is_numeric($product['discount_price'] / 4)? number_format($product['discount_price'] / 4); ?></span>-->
																				   <?php if (($product['discount_price'] >0) && is_numeric($product['price'] /4)) { ?>
                                                                                    <span class="woocommerce-Price-currencySymbol">₦ </span><?php echo ($product['price'] /4); ?></span>
																				   <?php } ?>
																			</del>
                                                                        </span>
                                                                        <!-- /.price -->
                                                                        <h2 class="woocommerce-loop-product__title">
                                                                            <?php echo character_limiter($product['name'], 20); ?>
                                                                        </h2>
                                                                    </div>
                                                                    <!-- /.price-and-title -->
                                                                    <div class="sale-label-outer">
                                                                        <div class="sale-saved-label">
                                                                            <span class="saved-label-text">Save</span>
                                                                            <span class="saved-label-amount">
                                                                                <span class="woocommerce-Price-amount amount">
                                                                                    <span class="woocommerce-Price-currencySymbol">₦ </span><?php echo (($product['price'] / 4) - ($product['discount_price'] / 4)); ?></span>
                                                                            </span>
                                                                        </div>
                                                                        <!-- /.sale-saved-label -->
                                                                    </div>
                                                                    <!-- /.sale-label-outer -->
                                                                </div>
                                                                <!-- /.sale-product-with-timer-header -->


                                                                <img width="224" height="197" alt="" class="wp-post-image lazy" data-src="<?php echo site_url('/public/images/products/' . $product['code'] . '/01.jpg');
                                                                                                                                            ?>" src="<?php echo site_url('assets/images/ajax-loader.gif'); ?>">


                                                                <div class="deal-countdown-timer">
                                                                    <div class="marketing-text">
                                                                        <span class="line-1">Hurry up!</span>
                                                                        <span class="line-2">Offers ends in:</span>
                                                                    </div>
                                                                    <!-- /.marketing-text -->
                                                                    <span class="deal-time-diff" style="display:none;">28800</span>
                                                                    <div class="deal-countdown countdown"></div>
                                                                </div>
                                                                <!-- /.deal-countdown-timer -->
                                                            </a>
                                                            <!-- /.woocommerce-LoopProduct-link -->
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                                <!-- /.products -->
                                            </div>
                                            <!-- /.woocommerce -->
                                        </div>
                                        <!-- /.container-fluid -->
                                    </div>
                                    <!-- /.slick-list -->
                                </div>

                            </div>
                            <!-- /.deals-carousel-inner-block -->
                        </section>
                        <!-- /.deals-carousel -->

                    </div>


                    <!-- 2020 remove the style attribute n added a new class called new-style-->
                    <?php $pos = 1;
                    $parentCategories = $this->CategoryModel->getParentCategories(); ?>

                    <?php foreach ($parentCategories as $key  => $parentCategory) { ?>
                        <div class="mt-3" id="content-desk">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header text-white" style="background:#b3b300;">
                                            <h4 class="card-title" style="font-size: 1.25rem;"><b><?php echo $parentCategory->name; ?>
                                                    <?php //echo $parentCategory->name; 
                                                    ?>
                                                    <a href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], strtolower($parentCategory->name))) ?>">
                                                        <span style="float: right; color: #4fa748">View all<i class="fa fa-angle-right"></i></span>
                                                    </a>
                                                </b>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php //$parentSubCategories = $this->CategoryModel->getSubCategories($parentCategory->id); 
                                                ?>
                                                <?php $catProducts = $this->db->limit(6)->order_by('RAND()', 'ASC')->where(['status' => 'approved', 'featured' => 1, 'category_id' => $parentCategory->id])->get('products')->result(); ?>
                                                <?php foreach ($catProducts as $key => $catProduct) { ?>
                                                    <?php
                                                    $prod = (array) $catProduct;
                                                    // var_dump($prod);
                                                    $this->load->view('layouts/product/one_product', $prod + ['deal_price' => null, 'end_time' => null]);
                                                    ?>
                                                <?php } ?>
                                                <?php //foreach ($parentSubCategories as $key => $parentSubCategory) { 
                                                ?>

                                                <?php //} 
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $ads = $this->AdsBannersModel->getAdsBannersBy(['position' => $pos]); ?>
                        <?php if ($ads) { ?>
                            <div class="container-fluid" style="margin-top:10px;margin-bottom:3px;" id="content-desk">
                                <!-- <div class="card-header bg-white"> -->
                                <div class="row">
                                    <?php foreach ($ads as $key => $ad) { ?>
                                        <div class="col-lg-6 col-md-6 col-12 py-2 px-1">
                                            <a href="<?php echo $ad['link']; ?>">
                                                <img class="lazy" data-src="<?php echo $ad['image_path']; ?>" src="<?php echo site_url('assets/images/ajax-loader.gif'); ?>" class="card-img-top" alt="...">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!--  </div> -->
                            </div>



                        <?php  } ?>



                    <?php $pos++;
                    }
                    /* 
                        ! DESKTOP ASPECT 
                    */

                    ?>






                    <?php $pos = 1;
                    $parentCategories = $this->CategoryModel->getParentCategories(); ?>

                    <?php foreach ($parentCategories as $key  => $parentCategory) { ?>
                        <section class="section-landscape-products-carousel recently-viewed content-mobile" id="recently-viewed">
                            <header class="section-header text-white  p-3" style="background:#b3b300;">
                                <h2 class="section-title"><?php echo $parentCategory->name; ?></h2>
                                <span class="text-success pull-right"><b>
                                        <a href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], strtolower($parentCategory->name))) ?>">View all</a>

                                    </b></span>
                            </header>
                            <!-- <div class="row"> 
							data-slick="{'slidesToShow':5,'slidesToScroll':5,'dots':true,'arrows':true,'prevArrow':'&lt;a href='#'&gt;&lt;i class=\'tm tm-arrow-left\'&gt;&lt;\/i&gt;&lt;\/a&gt;','nextArrow':'&lt;a href=\'#\'&gt;&lt;i class=\'tm tm-arrow-right\'&gt;&lt;\/i&gt;&lt;\/a&gt;','appendArrows':'#recently-viewed .custom-slick-nav','responsive':[{'breakpoint':992,'settings':{'slidesToShow':2,'slidesToScroll':2}},{'breakpoint':1200,'settings':{'slidesToShow':3,'slidesToScroll':3}},{'breakpoint':1400,'settings':{'slidesToShow':3,'slidesToScroll':3}},{'breakpoint':1700,'settings':{'slidesToShow':4,'slidesToScroll':4}}]}"
							-->
                            <!-- <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{'slidesToShow':5,'slidesToScroll':2,'dots':false,'arrows':false,'prevArrow':'&lt;a href=\'#\'&gt;&lt;i class=\'tm tm-arrow-left\'&gt;&lt;\/i&gt;&lt;\/a&gt;','nextArrow':'&lt;a href=\'#\'&gt;&lt;i class=\'tm tm-arrow-right\'&gt;&lt;\/i&gt;&lt;\/a&gt;','appendArrows':'#recently-viewed .custom-slick-nav','responsive':[{'breakpoint':992,'settings':{'slidesToShow':2,'slidesToScroll':2}},{'breakpoint':1200,'settings':{'slidesToShow':3,'slidesToScroll':3}},{'breakpoint':1400,'settings':{'slidesToShow':3,'slidesToScroll':3}},{'breakpoint':1700,'settings':{'slidesToShow':4,'slidesToScroll':4}}]}"> -->

                            <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:2,&quot;dots&quot;:true,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#recently-viewed .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1700,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                                <div class="container-fluid">
                                    <div class="woocommerce columns-5">
                                        <div class="products">



                                            <?php $catProducts = $this->db->limit(6)->order_by('RAND()', 'ASC')->where(['status' => 'approved', 'featured' => 1, 'category_id' => $parentCategory->id])->get('products')->result(); ?>
                                            <?php foreach ($catProducts as $key => $catProduct) { ?>
                                                <?php
                                                $prod = (array) $catProduct;
                                                // var_dump($prod);
                                                $this->load->view('layouts/product/one_product', $prod + ['deal_price' => null, 'end_time' => null]);
                                                ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- </div> -->



                        <!-- </div>

                                    </div>
                                </div>
                            </div>
                        </div> -->


                        <?php $ads = $this->AdsBannersModel->getAdsBannersBy(['position' => $pos]); ?>
                        <?php if ($ads) { ?>
                            <div class="container-fluid" style="margin-top:0px;margin-bottom:3px;" id="content-mobile">
                                <!-- <div class="card-header bg-white"> -->
                                <div class="row">
                                    <?php foreach ($ads as $key => $ad) { ?>
                                        <div class="col-6 py-2 px-1">
                                            <a href="<?php echo $ad['link']; ?>">
                                                <img class="lazy img-responsive" data-src="<?php echo $ad['image_path']; ?>" src="<?php echo site_url('assets/images/ajax-loader.gif'); ?>" class="card-img-top" alt="..." style="height:100px;">
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!--  </div> -->
                            </div>



                        <?php  } ?>



                    <?php $pos++;
                    } ?>








                    <!--                <section class="section-landscape-products-carousel recently-viewed content-mobile" id="recently-viewed">
                        <header class="section-header">
                            <h2 class="section-title">Recently viewed products</h2>
                            <!-- <nav class="custom-slick-nav"></nav> --
                            <span class="text-success pull-right">View all</span>
                        </header>
                        <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:2,&quot;dots&quot;:false,&quot;arrows&quot;:false,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#recently-viewed .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1700,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="landscape-product product">
                                            <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                                <div class="media">
                                                    <img class="wp-post-image" src="<?php //echo base_url(); 
                                                                                    ?>assets/images/products/card-3.jpg" alt="">
                                                    <div class="media-body">
                                                        <span class="price">
                                                            <ins>
                                                                <span class="amount"> $3,788.00</span>
                                                            </ins>
                                                            <del>
                                                                <span class="amount">$4,780.00</span>
                                                            </del>
                                                            <span class="amount"> </span>
                                                        </span>
                                                        <!-- .price --
                                                        <h2 class="woocommerce-loop-product__title">PowerBank 4400</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 0 out of 5" class="star-rating">
                                                                <span style="width:0%">
                                                                    <strong class="rating">0</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(0)</span>
                                                        </div>
                                                        <!-- .techmarket-product-rating --
                                                    </div>
                                                    <!-- .media-body --
                                                </div>
                                                <!-- .media --
                                            </a>
                                            <!-- .woocommerce-LoopProduct-link --
                                        </div>
                                        <!-- .landscape-product --
                                        <div class="landscape-product product">
                                            <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                                <div class="media">
                                                    <img class="wp-post-image" src="<?php echo base_url(); ?>assets/images/products/card-2.jpg" alt="">
                                                    <div class="media-body">
                                                        <span class="price">
                                                            <ins>
                                                                <span class="amount"> </span>
                                                            </ins>
                                                            <span class="amount"> $500</span>
                                                        </span>
                                                        <!-- .price --
                                                        <h2 class="woocommerce-loop-product__title">Headset 3D Glasses VR for Android</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 0 out of 5" class="star-rating">
                                                                <span style="width:0%">
                                                                    <strong class="rating">0</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(0)</span>
                                                        </div>
                                                        <!-- .techmarket-product-rating --
                                                    </div>
                                                    <!-- .media-body --
                                                </div>
                                                <!-- .media --
                                            </a>
                                            <!-- .woocommerce-LoopProduct-link --
                                        </div>
                                        <!-- .landscape-product --
                                        <div class="landscape-product product">
                                            <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                                <div class="media">
                                                    <img class="wp-post-image" src="<?php echo base_url(); ?>assets/images/products/card-4.jpg" alt="">
                                                    <div class="media-body">
                                                        <span class="price">
                                                            <ins>
                                                                <span class="amount"> </span>
                                                            </ins>
                                                            <span class="amount"> $800</span>
                                                        </span>
                                                        <!-- .price --
                                                        <h2 class="woocommerce-loop-product__title">Snap White Instant Digital Camera in White</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 0 out of 5" class="star-rating">
                                                                <span style="width:0%">
                                                                    <strong class="rating">0</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(0)</span>
                                                        </div>
                                                        <!-- .techmarket-product-rating --
                                                    </div>
                                                    <!-- .media-body --
                                                </div>
                                                <!-- .media --
                                            </a>
                                            <!-- .woocommerce-LoopProduct-link --
                                        </div>
                                        <!-- .landscape-product --
                                        <div class="landscape-product product">
                                            <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                                <div class="media">
                                                    <img class="wp-post-image" src="<?php echo base_url(); ?>assets/images/products/card-5.jpg" alt="">
                                                    <div class="media-body">
                                                        <span class="price">
                                                            <ins>
                                                                <span class="amount"> $3,788.00</span>
                                                            </ins>
                                                            <del>
                                                                <span class="amount">$4,780.00</span>
                                                            </del>
                                                            <span class="amount"> </span>
                                                        </span>
                                                        <!-- .price --
                                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 0 out of 5" class="star-rating">
                                                                <span style="width:0%">
                                                                    <strong class="rating">0</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(0)</span>
                                                        </div>
                                                        <!-- .techmarket-product-rating --
                                                    </div>
                                                    <!-- .media-body --
                                                </div>
                                                <!-- .media --
                                            </a>
                                            <!-- .woocommerce-LoopProduct-link --
                                        </div>

                                    </div>
                                </div>
                                <!-- .woocommerce --
                            </div>
                            <!-- .container-fluid --
                        </div>
                        <!-- .products-carousel --
                    </section>
                    <!-- .section-landscape-products-carousel -->