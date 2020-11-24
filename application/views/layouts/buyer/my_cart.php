<?php $i = 0; foreach ($this->cart->contents() as $item) { ?>
    <?php if ($i <= 2) { ?>
    <?php $productData = $this->db->get_where('products', ['product_id' => $item['options']['product_id']])->row(); ?>
        <li class="woocommerce-mini-cart-item mini_cart_item">
            <a href="<?php echo site_url('buyer/deletefromcart/' . $item['rowid']) ?>" class="remove slink" aria-label="Remove this item slink" msg="Do you want to remove this item?">×</a>
            <a href="single-product-sidebar.html">
                <img src="<?php echo site_url('public/images/products/' . $productData->code . '/01.jpg'); ?>" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="" title="<?php echo hex2bin($item['name']); ?>"><?php echo character_limiter(hex2bin($item['name']), 15); ?>&nbsp;
            </a>
            <span class="quantity">1 ×
                <span class="woocommerce-Price-amount amount">
                    <span class="woocommerce-Price-currencySymbol">N</span>
                    <?php echo $this->cart->format_number($item['price'] / 4) . ' / Month'; ?>
                </span>
            </span><br />
            <span class="quantity">
                <?php echo $item['qty'] . ' pieces'; ?>
            </span>
        </li>
    <?php } else { ?>
    <?php break; ?>
    <?php } ?>
<?php $i++; } ?>