<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <title><?php echo $this->config->item('page_title').$page_title ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css" media="all" />
         <link href="<?php echo base_url();?>assetz/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-awesome.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-grid.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-reboot.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-techmarket.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/slick.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/techmarket-font-awesome.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/slick-style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animate.min.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/colors/blue.css" media="all" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/styles/responsive.css">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/plugins/OwlCarousel2-2.2.1/animate.css">

        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,900" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo site_url('public/images/system/sys/paysmosmo.png'); ?>">

        <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
    </head>
    <body class="woocommerce-active page-template-template-homepage-v1 can-uppercase">
        <div id="page" class="hfeed site">
            <div class="top-bar top-bar-v1">
                <div class="col-full">
                    <ul id="menu-top-bar-left" class="nav justify-content-center">
                        <li class="menu-item animate-dropdown">
                            <a title="TechMarket eCommerce - Always free delivery">Paysmosmo Online Shopping &#8211; Always free delivery</a>
                        </li>
                        <li class="menu-item animate-dropdown">
                            <a title="Quality Guarantee of products">Quality Guarantee of products</a>
                        </li>
                        <li class="menu-item animate-dropdown">
                            <a title="Fast returnings program">Fast returnings program</a>
                        </li>
                        <li class="menu-item animate-dropdown">
                            <a title="No additional fees">No additional fees</a>
                        </li>
                    </ul>
                    <!-- .nav -->
                </div>
                <!-- .col-full -->
            </div>
            <!-- .top-bar-v1 -->
            <header id="masthead" class="site-header header-v1" style="background-image: none; ">
                <div class="col-full desktop-only">
                    <div class="techmarket-sticky-wrap">
                        <div class="row">
                            <div class="site-branding">
                                <a href="<?php echo site_url(); ?>" class="custom-logo-link" rel="home">
                                    <img src="<?php echo site_url('public/images/system/sys/paysmosmo.png'); ?>" />
                                </a>
                                <!-- /.custom-logo-link -->
                            </div>
                            <!-- /.site-branding -->
                            <!-- ============================================================= End Header Logo ============================================================= -->
                            <nav id="primary-navigation" class="primary-navigation" aria-label="Primary Navigation" data-nav="flex-menu">
                                <ul id="menu-primary-menu" class="nav yamm">
                                    <li class="sale-clr yamm-fw menu-item animate-dropdown">
                                        <a title="Super deals" href="product-category.html">Super deals</a>
                                    </li>
                                    <li class="menu-item menu-item-has-children animate-dropdown dropdown">
                                        <a title="Mother`s Day" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" href="#">`s Day <span class="caret"></span></a>
                                        <ul role="menu" class=" dropdown-menu">
                                            <li class="menu-item animate-dropdown">
                                                <a title="Wishlist" href="wishlist.html">Wishlist</a>
                                            </li>
                                            <li class="menu-item animate-dropdown">
                                                <a title="Add to compare" href="compare.html">Add to compare</a>
                                            </li>
                                            <li class="menu-item animate-dropdown">
                                                <a title="About Us" href="about.html">About Us</a>
                                            </li>
                                            <li class="menu-item animate-dropdown">
                                                <a title="Track Order" href="track-your-order.html">Track Order</a>
                                            </li>
                                        </ul>
                                        <!-- .dropdown-menu -->
                                    </li>
                                   
                                    <li class="menu-item animate-dropdown">
                                        <a title="Logitech Sale" href="product-category.html">Logitech Sale</a>
                                    </li>
                                    <li class="menu-item animate-dropdown">
                                        <a title="Headphones Sale" href="product-category.html">Headphones Sale</a>
                                    </li>
                                    <li class="techmarket-flex-more-menu-item dropdown">
                                        <a title="..." href="#" data-toggle="dropdown" class="dropdown-toggle">...</a>
                                        <ul class="overflow-items dropdown-menu"></ul>
                                        <!-- . -->
                                    </li>
                                </ul>
                                <!-- .nav -->
                            </nav>
                            <!-- .primary-navigation --
                            <nav id="secondary-navigation" class="secondary-navigation" aria-label="Secondary Navigation" data-nav="flex-menu">
                                <ul id="menu-secondary-menu" class="nav">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2802 animate-dropdown">
                                        <a title="Track Your Order" href="track-your-order.html">
                                            <i class="tm tm-order-tracking"></i>Track Your Order</a>
                                    </li>
                                    
                                    
                                    <li class="techmarket-flex-more-menu-item dropdown">
                                        <a title="..." href="#" data-toggle="dropdown" class="dropdown-toggle">...</a>
                                        <ul class="overflow-items dropdown-menu"></ul>
                                    </li>
                                </ul>
                                <!-- .nav --
                            </nav>
                            <!-- .secondary-navigation -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- .techmarket-sticky-wrap -->
                    <div class="row align-items-center">
                        <!-- <div id="departments-menu" class="dropdown departments-menu">
                            <button class="btn dropdown-toggle btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="tm tm-departments-thin"></i>
                                <span>All Departments</span>
                            </button>
                            <ul id="menu-departments-menu" class="dropdown-menu yamm departments-menu-dropdown">
                                <?php //$parentCategories = $this->CategoryModel->getParentCategories(); ?>
                                <?php //foreach ($parentCategories as $key => $category) { ?>
                                    <li class="menu-item animate-dropdown">
                                        <a title="<?php //echo $category->name; ?>" href="<?php //echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($category->name)))?>"><?php //echo $category->name; ?></a>
                                    </li>
                                <?php //} ?>
                                
                            </ul>
                        </div> -->
                        <!-- .departments-menu -->
                        <?php $this->load->view('layouts/general/search_tab.php') ?>
                        <!-- .navbar-search -->
                        <ul class="header-compare nav navbar-nav">
                            <!-- <li class="nav-item">
                                <a href="compare.html" class="nav-link">
                                    <i class="tm tm-compare"></i>
                                    <span id="top-cart-compare-count" class="value">3</span>
                                </a>
                            </li> -->
                        </ul>
                        <!-- .header-compare -->
                        <ul class="header-wishlist nav navbar-nav">
                            <?php //var_dump($this->session->userdata('user')); ?>
                            <li class="menu-item">
                                <a href="<?php echo ($this->session->userdata('user') && $this->session->userdata('user')->loggedinas == 'buyer') ? site_url('buyer/index') : site_url('buyer/login') ?>">
                                    <i class="tm tm-login-register"></i>
                                    <?php echo ($this->session->userdata('user') && $this->session->userdata('user')->loggedinas == 'buyer') ? 'My Account' : 'Register or Sign in' ?>
                                </a>
                            </li>
                        </ul>
                        <!-- .header-wishlist -->
                        <ul id="site-header-cart" class="site-header-cart menu">
                            <li class="animate-dropdown dropdown ">
                                <a class="cart-contents" href="<?php echo site_url('buyer/cart/my_cart');?>" data-toggle="dropdown" title="View your shopping cart"> Cart <i class="tm tm-shopping-bag"></i>
                                    <span class="count"><?php echo count($this->cart->contents()); ?></span>
                                    <!-- <span class="amount">
                                        <span class="price-label">Your Cart</span>&#036;136.99</span> -->
                                </a>
                                <ul class="dropdown-menu dropdown-menu-mini-cart">
                                    <li>
                                        <div class="widget woocommerce widget_shopping_cart">
                                            <div class="widget_shopping_cart_content">
                                                <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                                                    <?php foreach($this->cart->contents() as $item){ //var_dump($item); ?>
                                                        <?php $productData = $this->db->get_where('products', ['product_id' => $item['options']['product_id']])->row(); ?>
                                                        <li class="woocommerce-mini-cart-item mini_cart_item">
                                                            <a 
                                                                href="<?php echo site_url('buyer/deletefromcart/'.$item['rowid']) ?>" 
                                                                class="remove slink" aria-label="Remove this item slink"
                                                                msg="Do you want to remove this item?">×</a>
                                                            <a href="single-product-sidebar.html">
                                                                <img src="<?php echo site_url('public/images/products/'.$productData->code.'/01.jpg');?>" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt=""><?php echo $item['name'] ?>&nbsp;
                                                            </a>
                                                            <span class="quantity">1 ×
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">N</span>
                                                                    <?php echo $this->cart->format_number($item['price']/4).' / Month'; ?>
                                                                </span>
                                                            </span><br/>
                                                            <span class="quantity">
                                                                <?php echo $item['qty'].' pieces'; ?>
                                                            </span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                                <!-- .cart_list -->
                                                <?php if (count($this->cart->contents() > 0)) { ?>
                                                    <p class="woocommerce-mini-cart__total total">
                                                        <strong>Subtotal:</strong>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">N</span><?php echo $this->cart->format_number($this->cart->total());?></span>
                                                    </p>
                                                <?php } ?>
                                                <p class="woocommerce-mini-cart__buttons buttons">
                                                    <?php if (count($this->cart->contents() > 0)) { ?>
                                                        <a href="<?php echo base_url('buyer/cart/my_cart');?>" class="button wc-forward">View cart</a>
                                                        <a href="<?php echo base_url('buyer/check_out/');?>" class="button checkout wc-forward">Checkout</a>
                                                    <?php } ?>
                                                    <a href="<?php echo base_url('buyer/orders/my_orders');?>" class="button wc-forward">Order</a>
                                                </p>
                                            </div>
                                            <!-- .widget_shopping_cart_content -->
                                        </div>
                                        <!-- .widget_shopping_cart -->
                                    </li>
                                </ul>
                                <!-- .dropdown-menu-mini-cart -->
                            </li>
                        </ul>
                        <!-- .site-header-cart -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- .col-full -->
                <div class="col-full handheld-only">
                    <div class="handheld-header">
                        <div class="row">
                            <div class="site-branding">
                                <a href="<?php echo site_url(); ?>" class="custom-logo-link" rel="home">
                                    <img src="<?php echo site_url('public/images/system/sys/paysmosmo.png'); ?>" />
                                </a>
                                <!-- /.custom-logo-link -->
                            </div>
                            <!-- /.site-branding -->
                            <!-- ============================================================= End Header Logo ============================================================= -->
                            <div class="handheld-header-links">
                                <ul class="columns-3">
                                    <li class="my-account">
                                        <a href="<?php echo site_url('buyer/login'); ?>" class="has-icon">
                                            <i class="tm tm-login-register"></i>
                                        </a>
                                    </li>
                                    <!-- <li class="wishlist">
                                        <a href="wishlist.html" class="has-icon">
                                            <i class="tm tm-favorites"></i>
                                            <span class="count">3</span>
                                        </a>
                                    </li> -->
                                    <!-- <li class="compare">
                                        <a href="compare.html" class="has-icon">
                                            <i class="tm tm-compare"></i>
                                            <span class="count">3</span>
                                        </a>
                                    </li> -->
                                </ul>
                                <!-- .columns-3 -->
                            </div>
                            <!-- .handheld-header-links -->
                        </div>
                        <!-- /.row -->
                        <div class="techmarket-sticky-wrap">
                            <div class="row">
                                <nav id="handheld-navigation" class="handheld-navigation" aria-label="Handheld Navigation">
                                    <button class="btn navbar-toggler" type="button">
                                        <i class="tm tm-departments-thin"></i>
                                        <span>Menu</span>
                                    </button>
                                    <div class="handheld-navigation-menu">
                                        <span class="tmhm-close">Close</span>
                                        <ul id="menu-departments-menu-1" class="nav">
                                            <?php $parentCategories = $this->CategoryModel->getParentCategories(); ?>
                                            <?php foreach ($parentCategories as $key => $category) { ?>
                                                <li class="highlight menu-item animate-dropdown">
                                                    <a title="Value of the Day" href="<?php echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($category->name)))?>">
                                                        <?php echo $category->name; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <!-- <li class="highlight menu-item animate-dropdown">
                                                <a title="Top 100 Offers" href="shop.html">Top 100 Offers</a>
                                            </li>
                                            <li class="highlight menu-item animate-dropdown">
                                                <a title="New Arrivals" href="shop.html">New Arrivals</a>
                                            </li> -->
                                            <!-- <li class="menu-item animate-dropdown">
                                                <a title="Gadgets" href="shop.html">Gadgets</a>
                                            </li>
                                            <li class="menu-item animate-dropdown">
                                                <a title="Virtual Reality" href="shop.html">Virtual Reality</a>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <!-- .handheld-navigation-menu -->
                                </nav>
                                <!-- .handheld-navigation -->
                                <div class="site-search">
                                    <div class="widget woocommerce widget_product_search">
                                        <form role="search" method="get" class="woocommerce-product-search" action="home-v1.html">
                                            <label class="screen-reader-text" for="woocommerce-product-search-field-0">Search for:</label>
                                            <input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="Search products&hellip;" value="" name="s" />
                                            <input type="submit" value="Search" />
                                            <input type="hidden" name="post_type" value="product" />
                                        </form>
                                    </div>
                                    <!-- .widget -->
                                </div>
                                <!-- .site-search -->
                                <a class="handheld-header-cart-link has-icon" href="<?php echo site_url('buyer/cart/my_cart') ?>" title="View your shopping cart">
                                    <i class="tm tm-shopping-bag"></i>
                                    <span class="count"><?php echo count($this->cart->contents()); ?></span>
                                </a>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- .techmarket-sticky-wrap -->
                    </div>
                    <!-- .handheld-header -->
                </div>
                <!-- .handheld-only -->
            </header>
            <!-- .header-v1 -->
            <!-- ============================================================= Header End ============================================================= -->