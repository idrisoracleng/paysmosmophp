<?php //var_dump($products); ?>
<?php if (count($products) > 0) { ?>
    <div id="grid" class="tab-pane active" role="tabpanel">
        <div class="woocommerce columns-5">
            <div class="products row">
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
            <?php //echo $this->pagination->create_links(); ?>
        </nav>
        <!-- .woocommerce -->
    </div>
<?php } else { ?>
    <div id="grid" class="tab-pane active" role="tabpanel">
        <div class="woocommerce columns-5">
            <div class="products row">
                <div class="alert alert-info text-center col-md-12">
                    No Match For Your Filter!
                </div>
            </div>
        </div>
    </div>
<?php } ?>