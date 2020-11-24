<?php $brands = $this->db->order_by('name', 'ASC')->get('brands')->result(); ?>

<div class="container-fluid">
    <div class="row m-2">
        <div class="col">
            <nav class="woocommerce-breadcrumb">
                <a href="<?php echo site_url(); ?>">Home</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span><?php echo $page_title; ?>
            </nav> 
        </div>
    </div>
   


    <div class="row m-3">
        <div class="col-lg-3">
            <div id="secondary" class="widget-area shop-sidebar" role="">
                <div class="widget woocommerce widget_product_categories techmarket_widget_product_categories" id="techmarket_product_categories_widget-2">
                    <ul class="product-categories ">
                        <li class="product_cat">
                            <span>Browse Brands</span>
                            <ul>
                                <?php foreach ($brands as $key => $brand) { ?>
                                    <li class="cat-item active">
                                        <a href="<?php echo site_url('/product/brand/'.str_replace([' ', "'"], ['-', '_'], strtolower($brand->name)))?>">
                                            <span class="no-child"></span><?php echo ucwords($brand->name); ?>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-lg-9">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <!-- .shop-archive-header -->
                    <div class="shop-control-bar">
                        <div class="handheld-sidebar-toggle">
                            <button type="button" class="btn sidebar-toggler">
                                <i class="fa fa-sliders"></i>
                                <span>Filters</span>
                            </button>
                        </div>
                        <!-- .handheld-sidebar-toggle -->
                        <h3 class="woocommerce-products-header__title page-title"><?php echo 'Products From '.ucwords($page_title); ?></h3>
                        
                    </div>
                    <!-- .shop-control-bar -->
                    <div class="tab-content">
                        <div id="grid" class="tab-pane active" role="tabpanel">
                            <div class="woocommerce columns-5">
                                <div class="products row">
                                    <?php //foreach ($categories as $key => $category) { ?>
                                        <?php //$categoryProduct = $this->db->get_where('products', ['category_id' => $category->id, 'status' => 'approved'])->result(); ?>
                                        <?php //if (count($categoryProduct) > 0) ?>
                                            <?php //foreach ($categoryProduct as $key => $product): ?>
                                                <?php //$prod = (array) $product; $this->load->view('layouts/product/one_product', $prod+['col' => 3]); ?>
                                            <?php //endforeach; ?>
                                    <?php //} ?>
                                    
                                <?php if (isset($products) && count($products) > 0) { ?>
                                    <?php foreach ($products as $key => $product): ?>
                                        <?php $prod = (array) $product; $this->load->view('layouts/product/one_product', $prod+['col' => 3]); ?>
                                    <?php endforeach; ?>
                                <?php } ?>
                                </div>
                                <nav class="woocommerce-pagination">
                                    <?php echo $this->pagination->create_links(); ?>
                                </nav>
                                <!-- .products -->
                            </div>
                            <!-- .woocommerce -->
                        </div>
                    </div>
                    <!-- .tab-content -->
                    
                    <!-- .shop-control-bar-bottom -->
                </main>
                <!-- #main -->
            </div>
        </div>

    </div>
</div>