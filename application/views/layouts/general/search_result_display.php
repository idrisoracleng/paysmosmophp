<style>
    .image-parent {
        max-width: 40px;
    }
</style>
<div class="row fixed shadow-lg">
    <?php if (count($products) > 0 || count($category) > 0 ||  count($brands) > 0) { ?>
        <div class="col-md-4">
            <h3 class="font-weight-light">Products <a class="float-right">see all</a></h3>
            <ul class="list-group border-0">
                <?php foreach ($products as $key => $product) { ?>
                    <a href="<?php echo site_url('/product/'.str_replace([' ', "'", '&'], ['-', '_', 'and'], strtolower(bin2hex($product['name']))))?>" class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo highlight_phrase(character_limiter($product['name'], 20), $key); ?>
                        <?php if ($product['views'] > 20) { ?>
                            <span class="badge badge-primary font-weight-light">Popular</span>
                        <?php } else if ($product['views'] < 20) { ?>
                            <span class="badge badge-primary font-weight-light">Newest</span>
                        <?php } ?>
                        <div class="image-parent">
                            <img 
                                src="<?php echo site_url('assets/images/ajax-loader.gif'); ?>"
                                data-src="<?php echo site_url('/public/images/products/'.$product['code'].'/01.jpg'); ?>" class="img-fluid lazy" alt="quixote">
                        </div>
                    </a>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-4">
            <h3 class="font-weight-light">Category <a class="float-right">see all</a></h3>
            <ul class="list-group border-0">
                <?php foreach ($category as $key => $cat) { ?>
                    <a href="<?php echo site_url('/product/category/'.str_replace([' ', "'"], ['-', '_'], strtolower($cat['name'])))?>" class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo highlight_phrase($cat['name'], $key); ?>
                        <?php $catProducts = $this->db->query("SELECT * FROM products as p WHERE p.status = 'approved' AND p.category_id = '".$cat['id']."' AND (p.name LIKE '%$key%' OR p.tags LIKE '%$key%')")->result_array(); ?>
                        <span class="badge badge-primary font-weight-light"><?php echo count($catProducts); ?> result</span>
                    </a>
                <?php } ?>
            </ul>
        </div>

        <div class="col-md-4">
            <h3 class="font-weight-light">
                Brands <a class="float-right">see all</a>
            </h3>
            <ul class="list-group border-0">
                <?php foreach ($brands as $key => $brand) { ?>
                    <a href="<?php echo site_url('/product/brand/'.str_replace([' ', "'"], ['-', '_'], strtolower($brand['name'])))?>" class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo highlight_phrase($brand['name'], $key); ?>
                        <?php $brandProducts = $this->db->query("SELECT * FROM products as p WHERE p.status = 'approved' AND p.brand = '".$brand['name']."' AND (p.name LIKE '%$key%' OR p.tags LIKE '%$key%')")->result_array(); ?>
                        <span class="badge badge-primary font-weight-light"><?php echo count($brandProducts); ?> result</span>
                    </a>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

<!-- No Result -->

    <?php if (count($products) == 0 && count($category) == 0 && count($brands) == 0) { ?>
        
    <?php } ?>
</div>