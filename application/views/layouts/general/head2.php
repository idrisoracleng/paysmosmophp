
<style>
        /* body{
            background-color:rgb(243, 211, 71, 0.9)  !important;
            background-image: url(images/pssbanner.jpg);
            background-repeat: no-repeat;
            background-size: contain;
        } */

        body{
            background-color: #f5f5f5 !important;
            overflow-x:hidden;
        }
        .card{
            border: 1px solid white !important;
        }
</style>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <title><?php echo $this->config->item('page_title').$page_title ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="OneTech shop project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/styles/bootstrap4/bootstrap.min.css">
        <link href="<?php echo base_url();?>assetz/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/plugins/slick-1.8.0/slick.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assetz/styles/responsive.css">
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" media="all" /> -->
        
        </head>
        
        <body>

            <header class="header">

                <!-- Top Bar -->
                
                <div class="top_bar">
                    <div class="container">
                        <div class="row">
                            <div class="col d-flex flex-row">
                                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo base_url();?>assetz/images/phone.png" alt=""></div>0700PAYSMOSMO</div>
                                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo base_url();?>assetz/images/mail.png" alt=""></div><a href="mailto:info@paysmosmo.com">info@paysmosmo.com</a></div>
                                <div class="top_bar_content ml-auto">
                                    
                                    <div class="top_bar_user">
                                        <div class="user_icon"><img src="<?php echo base_url();?>assetz/images/user.svg" alt=""></div>
                                        <div><a href="<?php echo site_url('buyer/register'); ?>">Sign up</a></div>
                                        <div><a href="<?php echo site_url('buyer/login'); ?>">Sign in</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
        
                <!-- Header Main -->
        
                <div class="header_main" style="background-color:white;">
                    <div class="container">
                        <div class="row">
                        
                            <!-- Logo -->
                            <div class="col-lg-2 col-sm-3 col-3 order-1">
                                <div class="">
                                    <div class=""><a href="<?php echo base_url();?>"><img style="width:100%; margin-top:15px;"class=""src="<?php echo base_url();?>assetz/images/pss.png"></a></div>
                                </div>
                            </div>
        
                            <!-- Search -->
                            <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                                <div class="">
                                    <div class="" style="margin:10px;width: 800px; ">
                                        <div class="header_search_form_container">
                                            <form action="#" class="header_search_form clearfix">
                                                <input type="search" required="required" class="header_search_input" placeholder="Search for products, brands and categories...">



                                                <!-- <div class="custom_dropdown">
                                                    <div class="custom_dropdown_list">
                                                        <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                        <i class="fas fa-chevron-down"></i>
                                                        <ul class="custom_list clc">
                                                           <?php //$parentCategories = $this->CategoryModel->getParentCategories(); ?>
                                <?php //foreach ($parentCategories as $key => $category) { ?>
                                    <li class="menu-item animate-dropdown hassubs" style="height:32px; font-size:.75rem;">
                                        <a title="<?php //echo $category->name; ?>" href="<?php //echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($category->name)))?>"><?php //echo $category->name; ?></a>
                                    </li>
                                <?php //} ?>
                                                        </ul>
                                                    </div>
                                                </div> -->



                                                <button type="submit" class="header_search_button trans_300" value="Submit">
                                                    <input type="hidden" value="<?php echo (isset($key)) ? $key : ''; ?>" name="q" id="q"/>
                                                    <img src="<?php echo base_url();?>assetz/images/search.png" alt=""></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Wishlist -->
                            <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right" style="margin-top:10px;">
                                <div class=" d-flex flex-row align-items-center justify-content-end">
                                    
                                    <!-- Cart -->
                                    <div class="cart">
                                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                            <div class="cart_icon">
                                                <a href="<?php echo site_url('buyer/cart/my_cart');?>" title="View your shopping cart">
                                                    <img src="<?php echo base_url();?>assetz/images/cart.png" alt="">
                                                    <div class="cart_count"><span><?php echo count($this->cart->contents()); ?></span></div>
                                                </a>
                                            </div>
                                            <div class="cart_content">
                                                <div class="cart_text"><a href="<?php echo site_url('buyer/cart/my_cart');?>" title="View your shopping cart">Cart</a></div>
                                                <ul id="site-header-cart" class="site-header-cart menu">
                            <li class="animate-dropdown dropdown ">
                                <a class="cart-contents" href="<?php echo site_url('buyer/cart/my_cart');?>" data-toggle="dropdown" title="View your shopping cart">
                                    <i class="tm tm-shopping-bag"></i>
                                    <span class="count"><?php echo count($this->cart->contents()); ?></span>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!--  end wishlists -->


                        </div>
                    </div>
                </div>
                
            </header>