<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="<?php echo base_url();?>">Home</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                Order Detail <?php echo $order->order_id; ?>
            </nav>
            <!-- .woocommerce-breadcrumb -->


            <div class="col-lg-12">
                <?php $this->load->view('layouts/buyer/top_nav.php', array('title' => 'My Cart')); ?>
            </div>
            
            <!-- <br><br><br> -->
            <div id="primary" class="col-md-12 row content-area">
                <main id="main" class="site-main">
                    <div class="type-page hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="cart-wrapper row">
                                    <table class="shop_table shop_table_responsive cart col-lg-12">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">&nbsp;</th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price/Month</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total/Month</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php 
                                                $orderItems = unserialize($order->order_detail); 
                                                // var_dump($orderItems); 
                                                foreach ($orderItems as $key => $orderItem) { ?>
                                                <tr>
                                                    <?php
                                                        $productData = $this->db->get_where('products', ['product_id' => $orderItem['options']['product_id']])->row();
                                                    ?>
                                                    <td class="product-thumbnail">
                                                        <a href="<?php echo site_url('/product/'.str_replace([' ', "'", '&'], ['-', '_', 'and'], strtolower($productData->name)))?>">
                                                            <img width="180" height="180" alt="" class="wp-post-image" src="<?php echo site_url('public/images/products/'.$productData->code.'/01.jpg');?>">
                                                        </a>
                                                    </td>
                                                    <td data-title="Product" class="product-name">
                                                        <div class="media cart-item-product-detail">
                                                            <a href="<?php echo site_url('/product/'.str_replace([' ', "'", '&'], ['-', '_', 'and'], strtolower($productData->name)))?>">
                                                                <img width="180" height="180" alt="" class="wp-post-image" src="<?php echo site_url('public/images/products/'.$productData->code.'/01.jpg');?>">
                                                            </a>
                                                            <div class="media-body align-self-center">
                                                                <a href="<?php echo site_url('/product/'.str_replace([' ', "'", '&'], ['-', '_', 'and'], strtolower($productData->name)))?>">
                                                                    <?php echo $productData->name; ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td data-title="Price" class="product-price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">₦</span><?php echo $this->cart->format_number(($orderItem['price']/4)); ?> 
                                                                <small>Paid Monthly</small>
                                                        </span>
                                                    </td>
                                                    <td class="product-quantity" data-title="Quantity">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <?php echo $orderItem['qty']; ?>
                                                            <!-- <small>Paid Monthly</small> -->
                                                        </span>
                                                    </td>
                                                    <td data-title="Total" class="product-subtotal">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol"> ₦</span><?php echo $this->cart->format_number(($orderItem['subtotal']/4)); ?> 
                                                            <small>Paid Monthly</small>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="3">
                                                    Shipping Fee
                                                </td>
                                                <td colspan="1">
                                                    <span class="woocommerce-Price-currencySymbol"> ₦</span><?php echo $this->cart->format_number(($order->shipping_fee)); ?>
                                                </td>
                                            </tr>
											<?php if ($order->coupon_price != '') { ?>
												<td colspan="3">
                                                    Coupon Price
                                                </td>
                                                <td colspan="1">
                                                    <span class="woocommerce-Price-currencySymbol"> ₦</span><?php echo $this->cart->format_number(($order->coupon_price)); ?>
                                                </td>
											<?php } ?>
											<tr>
                                                <td colspan="3">
                                                    Order Amount + Shipping Fee
                                                </td>
                                                <td colspan="1">
                                                    <span class="woocommerce-Price-currencySymbol"> ₦</span><?php echo $this->cart->format_number(($order->total_amount + $order->shipping_fee)); ?><br/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    Total Fee
                                                </td>
                                                <td colspan="1">
                                                    <span class="woocommerce-Price-currencySymbol"> ₦</span><?php echo $this->cart->format_number(($order->total_amount + $order->shipping_fee)); ?><br/>
                                                    <span class="woocommerce-Price-currencySymbol"> ₦</span><?php echo $this->cart->format_number((($order->total_amount + $order->shipping_fee)/4)); ?><small> Paid Monthly</small>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo site_url('public/js/sb-admin.js'); ?>"></script>