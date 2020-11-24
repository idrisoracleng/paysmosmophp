 <div id="content" class="site-content">
                <div class="col-full">
                    <div class="row">
                        <nav class="woocommerce-breadcrumb">
                            <a href="<?php echo base_url();?>">Home</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>
                            Cart
                        </nav>
                        <!-- .woocommerce-breadcrumb -->


                        <div class="col-lg-12">
                          <?php //$this->load->view('layouts/buyer/top_nav.php', array('title' => 'My Cart')); ?>
                          <p class="bg-primary text-light p-2 rounded text-center w-100 text-center font-weight-light">Note: The amount displayed here will be paid per Month</p>
                        </div>
                        
                        <!-- <br><br><br> -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <div class="entry-content">
                                        <div class="woocommerce">
                                            <div class="cart-wrapper">
                                                <!-- <form method="post" action="#" class="woocommerce-cart-form"> -->
                                                <form action="<?php echo site_url('buyer/updatecart') ?>" msg="Updating Cart Content..." method="POST">
                                                    <table class="shop_table shop_table_responsive cart col-lg-8">
                                                        <thead>
                                                            <tr>
                                                                <th class="product-remove">&nbsp;</th>
                                                                <th class="product-thumbnail">&nbsp;</th>
                                                                <th class="product-name">Product</th>
                                                                <th class="product-price">Price/Month</th>
                                                                <th class="product-quantity">Quantity</th>
                                                                <th class="product-subtotal">Total/Month</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        
                                                           <?php foreach ($this->cart->contents() as $key => $item) { ?>
                                                            <tr>
                                                             
                                                                <?php
                                                                    $productData = $this->db->get_where('products', ['product_id' => $item['options']['product_id']])->row();
                                                                    // var_dump($productData); exit();
                                                                    $sellerData = $this->db->get_where('sellers', ['seller_id' => $productData->owner_id])->row();
                                                                    $userData = $this->db->get_where('users', ['user_id' => $productData->owner_id])->row();
                                                                ?>
              
                                                                <td class="product-remove">
                                                                    <a class="remove" href="#">×</a>
                                                                </td>
                                                                <td class="product-thumbnail">
                                                                    <a href="">
                                                                        <img style="object-fit: contain; width: 180px; height: 180px;" alt="" class="wp-post-image lazy" src="<?php echo site_url('assets/images/ajax-loader.gif'); ?>" data-src="<?php echo site_url('public/images/products/'.$productData->code.'/01.jpg');?>">
                                                                    </a>
                                                                </td>
                                                                <td data-title="Product" class="product-name">
                                                                    <div class="media cart-item-product-detail">
                                                                        <a href="">
                                                                            <img style="object-fit: contain; width: 180px; height: 180px;" alt="" class="wp-post-image lazy" src="<?php echo site_url('assets/images/ajax-loader.gif'); ?>" data-src="<?php echo site_url('public/images/products/'.$productData->code.'/01.jpg');?>">
                                                                        </a>
                                                                        <div class="media-body align-self-center">
                                                                            <a href=""><?php echo $productData->name; ?></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td data-title="Price" class="product-price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">₦</span><?php echo $this->cart->format_number(($item['price']/4)); ?> 
                                                                        <!-- <small>Paid Monthly</small> -->
                                                                    </span>
                                                                </td>
                                                                <td class="product-quantity" data-title="Quantity">
                                                                    <div class="quantity">
                                                                        <label for="quantity-input-1">Quantity</label>

                                                                      <div class="form-group">
                                                                        <select name="qty[]" >
                                                                            <option selected disabled>Quantity</option>
                                                                            <option value="1" <?php echo ($item['qty'] == 1) ? 'selected' : '' ?>>1</option>
                                                                            <option value="2" <?php echo ($item['qty'] == 2) ? 'selected' : '' ?>>2</option>
                                                                            <option value="3" <?php echo ($item['qty'] == 3) ? 'selected' : '' ?>>3</option>
                                                                        </select>
                                                                        <input type="hidden" id="newoto" name="oto[]" value="<?php //echo json_encode($item['options']['other_options']) ?>"/>
                                                                        <input type="hidden" name="rowid[]" value="<?php echo $item['rowid'] ?>"/>
                                                                        <input type="hidden" name="owner_id[]" value="<?php echo $item['options']['seller_id'] ?>"/>
                                                                        <input type="hidden" name="product_id[]" value="<?php echo $item['options']['product_id'] ?>"/>
                                                                      </div>
                                                                      <!-- <input type="submit" value="Update cart" name="update_cart" class="button"> -->

                                                                    


<!-- <input id="quantity-input-1" type="number" name="cart[e2230b853516e7b05d79744fbd4c9c13][qty]" value="1" title="Qty" class="input-text qty text" size="4"> -->
                                                                    </div>
                                                                    
                                                                </td>
                                                                <td data-title="Total" class="product-subtotal">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">₦</span><?php echo $this->cart->format_number(($item['subtotal']/4)); ?> 
                                                                        <!-- <small>Paid Monthly</small> -->
                                                                    </span>
    <!-- <a href="<?php //echo site_url('buyer/deletefromcart/'.$item['rowid']) ?>" class="delete_btn btn btn-danger btn-block btn-sm">
      <i class="fa fa-remove"></i> REMOVE
    </a> -->

    <a title="Remove this item" class="remove delete_btn" href="<?php echo site_url('buyer/deletefromcart/'.$item['rowid']) ?>">×</a>
                                                                </td>
                                                            </tr>
                                                            
                                                            <?php } ?>
                                                        </tbody>

                                                        
                                                    </table>
                                                    <?php if (count($this->cart->contents()) > 0) { ?>
                                                        <div class="form-group">
                                                            <button class="btn float-right button btn-sm">Update Cart</button>
                                                        </div>
                                                    <?php } ?>
                                                    </form>
                                                    <?php if (count($this->cart->contents()) == 0) { ?>
                                                        <div class="col-lg-8">
                                                            <div class="alert alert-info text-center">
                                                                You do not have any item in your cart! Go to <a href="<?php echo site_url(); ?>">Market</a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>





                                                    <!-- .shop_table shop_table_responsive -->
                                                <!-- </form> -->
                                                <!-- .woocommerce-cart-form -->
                                                <div class="cart-collaterals">
                                                    <div class="cart_totals">
                                                        <h2 style="border-bottom: 0px;">Cart Totals</h2>
                                                        <table class="shop_table shop_table_responsive">
                                                            <tbody>
                                                                <tr class="cart-subtotal">
                                                                    <th>Subtotal</th>
                                                                    <td data-title="Subtotal">
                                                                        <small class="woocommerce-Price-amount amount">
                                                                            <span class="woocommerce-Price-currencySymbol">₦</span>
                                                                            <?php
                                                                                if (count($this->cart->contents()) > 0) {
                                                                                    echo $this->cart->format_number(($this->cart->total()));
                                                                                }
                                                                                else{
                                                                                    echo '0.00';
                                                                                }
                                                                            ?>
                                                                        </small>
                                                                    </td>
                                                                </tr>
                                                                <tr class="cart-subtotal">
                                                                    <th>Duration</th>
                                                                    <td data-title="Duration">
                                                                        <small class="woocommerce-Price-amount amount">
                                                                            4 Months
                                                                        </small>
                                                                    </td>
                                                                </tr>
                                                                <tr class="cart-subtotal">
                                                                    <th>Monthly Payment</th>
                                                                    <td data-title="Monthly Payment">
                                                                        <small class="woocommerce-Price-amount amount">
                                                                            <span class="woocommerce-Price-currencySymbol">₦</span>
                                                                            <?php
                                                                                if (count($this->cart->contents()) > 0) {
                                                                                    echo $this->cart->format_number(($this->cart->total()/4));
                                                                                } else {
                                                                                    echo '0.00';
                                                                                }
                                                                            ?>
                                                                        </small>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!-- .shop_table shop_table_responsive -->
                                                        <div class="wc-proceed-to-checkout">
                                                            <form class="woocommerce-shipping-calculator" method="post" action="#">
                                                                <p>
                                                                    
                                                                    <a class="shipping-calculator-button" data-toggle="collapse" aria-expanded="false" aria-controls="shipping-form">
                                                                        Shipping fees not included yet
                                                                    </a>
                                                                </p>
                                                                
                                                            </form>
                                                        </div>

<?php if (count($this->cart->contents()) > 0) { ?>
    
    <div class="container mb-5 mt-4">
        <?php if ($this->session->userdata('user') && $this->session->userdata('user')->step == 0) { ?>
                <a class="checkout-button button alt wc-forward" href="<?php echo base_url('buyer/check_out');?>">Proceed to checkout</a>
            <a class="back-to-shopping" href="<?php echo base_url();?>">Back to Shopping</a>
            <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            <a href="#" class="btn btn-outline-warning">Continue Shopping</a>
                            <a href="<?php //echo base_url('buyer/check_out');?>" class="btn btn-success">Proceed to  Checkout</a>
                        </div>
                    </div>
                </div>
            </div> -->
        <?php } else { ?>
            <?php if ($this->session->userdata('user')) { ?>
            <?php $step = $this->session->userdata('user')->step; ?>
                <?php if ($step == 1) { ?>
                    <p class="bg-danger text-light p-1 rounded text-center font-weight-light">Your Account Is Awaiting Approval From Cooperative Admin</p>
                <?php } else if ($step == 2) { ?>
                    <p class="bg-danger text-light p-1 rounded text-center font-weight-light">Check your email for confirmation email</p>
                <?php } else if ($step == 3) { ?>
                    <p class="bg-danger text-light p-1 rounded text-center font-weight-light">Your Account Is Under Suspension By The Admin</p>
                <?php } else if ($step == 4) { ?>
                    <p class="bg-danger text-light p-1 rounded text-center font-weight-light">Your Account Is Under Suspension By Your Cooperative Admin</p>
                <?php } ?>
            <?php } else { ?>

                <a class="checkout-button button alt wc-forward" href="<?php echo base_url('buyer/check_out');?>">Proceed to checkout</a>
                <a class="back-to-shopping" href="<?php echo base_url();?>">Back to Shopping</a>
                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-white">
                                <a href="#" class="btn btn-outline-warning">Continue Shopping</a>
                                <a href="<?php //echo base_url('buyer/check_out');?>" class="btn btn-success">Proceed to  Checkout</a>
                            </div>
                        </div>
                    </div>
                </div> -->
            <?php } ?>
        <?php } ?>
    </div>

<?php } ?>





<script>
  $(document).ready(function(){
    // alert("We are almost done here");
    // var oldqty = $("#oldqty");
    // var newqty = $("#newqty");

    var oldoto = $("#oldoto");
    var newoto = $("#newoto");

    // oldqty.keyup(function(){
    //   newqty.val($(this).val());
    // });

    oldoto.keyup(function(){
      newoto.val($(this).val());
    });

    $("#checkout").click(function (e) {
      
      var p_type = $("#p_type");
      // alert(p_type);
      if (p_type.val() == 'op') {
        e.preventDefault();
        alert('Requirement Online Is Required');
      } else if (p_type.val() == 'pd') {
        // return false;
      } else {
        e.preventDefault();
        p_type.addClass("border border-danger");
        alert("Please select a payment type");
      }
    });
  });
</script>
<script src="<?php echo site_url('public/js/sb-admin.js'); ?>"></script>

                                                            <!-- .wc-proceed-to-checkout -->
                                    




                                                        </div>
                                                        <!-- .wc-proceed-to-checkout -->
                                                    </div>
                                                    <!-- .cart_totals -->
                                                </div>
                                                <!-- .cart-collaterals -->


                                            </div>
                                            <!-- .cart-wrapper -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    <!-- .entry-content -->
                                </div>
                                <!-- .hentry -->
                            </main>
                            <!-- #main -->
                        </div>
                        <!-- #primary -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .col-full -->
            </div>