<?php $allCategories = $this->db->get('category')->result(); ?>

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
        <div class="col-lg-3" id="content-desk">
            <div id="secondary" class="widget-area shop-sidebar" role="">
                <div class="widget woocommerce widget_product_categories techmarket_widget_product_categories" id="techmarket_product_categories_widget-2">
                    <ul class="product-categories ">
                        <li class="product_cat">
                            <span>Browse Categories</span>
                            <ul>
                                <li class="cat-item active">
                                    <a href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], 'all')) ?>">
                                        <span class="no-child"></span>All Categories
                                    </a>
                                </li>
                                <?php foreach ($allCategories as $key => $category) { ?>
                                    <li class="cat-item active">
                                        <a href="<?php echo site_url('/product/category/' . str_replace([' ', "'"], ['-', '_'], strtolower($category->name))) ?>">
                                            <span class="no-child"></span><?php echo ucwords($category->name); ?>
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
                        <h3 class="woocommerce-products-header__title page-title" id="content-desk"><?php echo 'Products From ' . ucwords($page_title); ?></h3>

                        <h3 class="woocommerce-products-header__title page-title" id="content-mobile" style="font-size:16px;"><?php echo 'Products From ' . ucwords($page_title); ?></h3>
                        <?php $this->load->view('layouts/product/filter_view'); ?>
                    </div>
                    <!-- .shop-control-bar -->
                    <div class="tab-content" id="filter_result_view">
                        <div id="grid" class="tab-pane active" role="tabpanel">
                            <div class="woocommerce columns-5">
                                <div class="products row">
                                    <?php //foreach //($categories as $key => $category) { ?>
                                        <?php //$categoryProduct = $this->db->get_where('products', ['category_id' => $category->id, 'status' => 'approved'])->result(); ?>
                                        <?php //if (count($categoryProduct) > 0) ?>
                                        <?php //foreach ($categoryProduct as $key => $product) : ?>
                                            <?php //$prod = (array) $product;
                                            //$this->load->view('layouts/product/one_product', $prod + ['col' => 3]); ?>
                                        <?php //endforeach; ?>
                                    <?php //} ?>

                                    <?php if (isset($products) && count($products) > 0) { ?>
                                        <?php foreach ($products as $key => $product) : ?>
                                            <?php $prod = (array) $product;
                                            $this->load->view('layouts/product/one_product', $prod + ['col' => 3]); ?>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </div>
                                <!-- .products -->
                            </div>
                            <nav class="woocommerce-pagination">
                                <?php echo $this->pagination->create_links(); ?>
                            </nav>
                            <!-- .woocommerce -->
                        </div>
                    </div>
                </main>
                <!-- #main -->
            </div>
        </div>

    </div>
</div>