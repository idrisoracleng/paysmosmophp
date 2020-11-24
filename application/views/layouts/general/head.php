<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=12.0, minimum-scale=.25 user-scalable=yes"> -->
    <title><?php echo $this->config->item('page_title') . $page_title ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-grid.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-reboot.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-techmarket.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/slick.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/techmarket-font-awesome.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/slick-style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/colors/blue.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/vendor/swal/sweetalert2.min.css" media="all" />


    <!--  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetz/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetz/styles/responsive.css"> -->


    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetz/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetz/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assetz/plugins/OwlCarousel2-2.2.1/animate.css">

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,900" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/images/the_cart.png">
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5e33f408298c395d1ce57d87/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->


    <script src="<?php echo site_url('public/js/jquery.min.js'); ?>"></script>

    <style>
        body {
            overflow-x: hidden;
        }

        @media (max-width: 600px) {
            #content-desk {
                display: none;
            }
        }



        @media (min-width: 600px) {
            #content-mobile {
                display: none;
            }

            .content-mobile {
                display: none;
            }
        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            #content-mobile {
                display: none;
            }

            .content-mobile {
                display: none;
            }

            .dcon {
                display: none;
            }
        }

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            #content-mobile {
                display: none;
            }

            .content-mobile {
                display: none;
            }
        }

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            #content-mobile {
                display: none;
            }

            .content-mobile {
                display: none;
            }
        }
    </style>
</head>

<body class="woocommerce-active page-template-template-homepage-v1 can-uppercase single-product full-width normal page home page-template-default">
    <div id="page" class="hfeed site">
        <div class="top-bar top-bar-v1">
            <div class="col-full">
                <ul id="menu-top-bar-left" class="nav justify-content-center">
                    <li class="menu-item animate-dropdown">
                        <a title="Got Questions ? Call us 24/7" href="#">Got Questions ? Call us 24/7</a>
                    </li>
                    <li class="menu-item animate-dropdown">
                        <a title="0700PAYSMOSMO" href="#">0700PAYSMOSMO</a>
                    </li>
                    <li class="menu-item animate-dropdown">
                        <a title="Email" href="#">Email</a>
                    </li>
                    <li class="menu-item animate-dropdown">
                        <a title="info@paysmosmo.com" href="#">info@paysmosmo.com</a>
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
                                <img src="<?php echo site_url('public/images/pss.png'); ?>" />
                            </a>
                            <!-- /.custom-logo-link -->
                        </div>
                        <!-- /.site-branding -->
                        <!-- ============================================================= End Header Logo ============================================================= -->
                        <nav id="primary-navigation" class="primary-navigation" aria-label="Primary Navigation" data-nav="flex-menu">
                            <?php $headerMenus = $this->db->order_by('position', 'ASC')->get_where('header_menu', ['parent_id' => 0])->result(); ?>
                            <ul id="menu-primary-menu" class="nav yamm">
                                <?php foreach ($headerMenus as $key => $headerMenu) { ?>
                                    <li class="<?php echo ($headerMenu->has_sub_menu == 1) ? 'sale-clr yamm-fw menu-item animate-dropdown' : 'menu-item menu-item-has-children animate-dropdown dropdown' ?>">
                                        <a title="Super deals" href="<?php echo site_url($headerMenu->url); ?>"><?php echo $headerMenu->name; ?></a>
                                        <?php if ($headerMenu->has_sub_menu == 1) { ?>
                                            <?php $headerSubMenus = $this->db->get_where('header_menu', ['parent_id' => $headerMenu->id])->result(); ?>
                                            <?php if ($headerSubMenus) { ?>
                                                <ul role="menu" class=" dropdown-menu">
                                                    <?php foreach ($headerSubMenus as $key => $headerSubMenu) { ?>
                                                        <li class="menu-item animate-dropdown">
                                                            <a title="Wishlist" href="<?php echo site_url($headerSubMenu->url); ?>"><?php echo $headerSubMenu->name; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                            <!-- .nav -->
                        </nav>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- .techmarket-sticky-wrap -->
                <div class="row align-items-center">

                    <?php $this->load->view('layouts/general/search_tab.php') ?>
                    <!-- .navbar-search -->

                    <ul class="header-wishlist nav navbar-nav">
                        <li class="menu-item">
                            <a href="<?php echo ($this->session->userdata('user') && $this->session->userdata('user')->loggedinas == 'buyer') ? site_url('buyer/index') : site_url('buyer/login') ?>">
                                <i class="tm tm-login-register"></i>
                                <?php echo ($this->session->userdata('user') && $this->session->userdata('user')->loggedinas == 'buyer') ? explode(' ', $this->session->userdata('user')->full_name)[0] : 'Register or Sign in' ?>
                            </a>
                        </li>
                    </ul>

                    <!-- .header-wishlist -->
                    <ul id="site-header-cart" class="site-header-cart menu">
                        <li class="animate-dropdown dropdown ">
                            <a class="cart-contents" href="<?php echo site_url('buyer/cart/my_cart'); ?>" data-toggle="dropdown" title="View your shopping cart"> Cart <i class="tm tm-shopping-bag"></i>
                                <span class="count" id="cart_item_count"><?php echo count($this->cart->contents()); ?></span>
                                <!-- <span class="amount">
                                        <span class="price-label">Your Cart</span>&#036;136.99</span> -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-mini-cart">
                                <li>
                                    <div class="widget woocommerce widget_shopping_cart">
                                        <div class="widget_shopping_cart_content">
                                            <ul class="woocommerce-mini-cart cart_list product_list_widget" id="cart_item_list">
                                                <?php $this->load->view('layouts/buyer/my_cart.php'); ?>
                                            </ul>
                                            <!-- .cart_list -->
                                            <?php if (is_array($this->cart->contents()) && count($this->cart->contents()) > 0) { ?>
                                                <p class="woocommerce-mini-cart__total total">
                                                    <strong>Subtotal:</strong>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">₦</span><?php echo $this->cart->format_number($this->cart->total()); ?></span>
                                                </p>
                                            <?php } ?>
                                            <p class="woocommerce-mini-cart__buttons buttons">
                                                <?php if (is_array($this->cart->contents()) && count($this->cart->contents()) > 0) { ?>
                                                    <a href="<?php echo base_url('buyer/cart/my_cart'); ?>" class="button wc-forward">View cart</a>
                                                    <a href="<?php echo base_url('buyer/check_out/'); ?>" class="button checkout wc-forward">Checkout</a><br>
                                                <?php } ?>
                                                <a href="<?php echo base_url('buyer/orders/my_orders'); ?>" class="button wc-forward">Order</a>
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
                    <?php //$this->load->view('layouts/general/search_bar_result.php') 
                    ?>

                </div>
                <!-- /.row -->
            </div>
            <!-- .col-full -->
            <div class="col-full handheld-only">
                <div class="handheld-header">
                    <div class="row">
                        <div class="site-branding">
                            <a href="<?php echo site_url(); ?>" class="custom-logo-link" rel="home">
                                <img src="<?php echo site_url('public/images/pss.png'); ?>" />
                                <!-- <img src="<?php //echo site_url('public/images/system/sys/paysmosmo.png'); 
                                                ?>" /> -->
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
                                        <?php $parentCategories = $this->CategoryModel->getParentCategories();
                                        ?>
                                        <?php foreach ($parentCategories as $key => $category) {
                                        ?>
                                            <li class="highlight menu-item animate-dropdown">
                                                <a title="Value of the Day" href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], strtolower($category->name)))
                                                                                    ?>">
                                                    <?php echo $category->name;
                                                    ?>
                                                </a>
                                            </li>
                                        <?php }
                                        ?>
                                        <hr>

                                        <li class="highlight menu-item animate-dropdown">
                                            <a href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], 'all')) ?>">
                                                All Categories
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                                <!-- .handheld-navigation-menu -->
                            </nav>
                            <!-- .handheld-navigation -->
                            <div class="site-search">
                                <div class="widget woocommerce widget_product_search">
                                    <form role="search" method="POST" class="my-search" action="<?php echo site_url('product/search'); ?>" msg="Searching...">
                                        <label class="screen-reader-text" for="woocommerce-product-search-field-0">Search for:</label>
                                        <input type="search" id="search-mobile" class="search-field" placeholder="Search products&hellip;" value="" name="search-mobile" />
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