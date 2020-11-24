<?php 
    $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product_id])->result(); 
    $attachment = (isset($deal_price)) ? '?from=deal' : '?from=market';
?>

<!-- <style>
    .center {
        display: block;
        margin: auto;
        width: 50%;
        object-fit: cover;
    }
</style> -->

<?php $id = uniqid(); ?>
<div class="col-md-<?php echo (isset($col)) ? $col : 2; ?> text-center rounded mt-2 product" id="<?php echo $id; ?>">
    <a href="<?php echo site_url('/product/'.str_replace([' '], ['_'], strtolower($name))).$attachment?>">
        <img class="card-img center lazy rounded-lg" data-src="<?php echo site_url('/public/images/products/'.$code.'/01.jpg'); ?>" src="<?php echo site_url('assets/images/ajax-loader.gif'); ?>" style="height: 200px; width: 100%; object-fit: contain;" alt="<?php echo $name; ?>"/>
    </a>
    <div> 
    <a href="<?php echo (site_url('/product/'.str_replace([' '], ['_'], strtolower($name)))); ?>" title="<?php echo $name; ?>">
        <p style="font-size: 16px; margin-bottom: 1px;"> 
            <?php echo character_limiter($name, 20); ?>
        </p>
    </a>
    <?php if ($variants && $variants[0]->price != 0) { $price = $variants[0]->price; ?>
        <span class="">
            <?php if ($variants[0]->discount_price) { ?>
                <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($variants[0]->discount_price/4); ?></span><br>
                <strike style="font-size: 12px;">₦<?php echo ($variants[0]->price/4); ?></strike>
                <small style="margin-bottom:10px;">Per Month</small>
            <?php } else { ?>
                <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($variants[0]->price/4); ?></span><br>
                <small style="margin-bottom:10px;">Per Month</small>
            <?php } ?>
        </span>
    <?php } else { ?>
        <span class="">
            <?php if (isset($deal_price)) { ?>
                <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($deal_price/4); ?></span><br>
                <small style="margin-bottom:10px;">Per Month</small>
            <?php } else { ?>
                <?php if ($discount_price) { ?>
                    <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($discount_price/4); ?></span><br>
                    <strike style="font-size: 12px;">₦<?php echo $price/4 ?></strike>
                    <small style="margin-bottom:10px;">Per Month</small>
                <?php } else { ?>
                    <span class="" style="font-size: 20px;color:black;">₦<?php echo number_format($price/4); ?></span><br>
                    <small style="margin-bottom:10px;">Per Month</small>
                <?php } ?>
            <?php } ?>
        </span>
    <?php } ?>
    </div>
    <?php //$this->load->view('layouts/product/product_rating', (array)$product); ?>
    <?php if (isset($end_time) && $end_time != null) { ?>
        <p class="badge badge-danger p-2 font-weight-light"><?php showDealData($end_time); ?></p>
    <?php } ?>
    <?php $this->load->view('layouts/product/addToCartIcon', ['product_id' => $product_id, 'name' => $name]); ?>
</div>