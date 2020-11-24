<?php
    $isAddedToCart = false;
    foreach ($this->cart->contents() as $key => $cart_item) {
        $itemOptions = $this->cart->product_options($cart_item['rowid']);
        // var_dump($product_id);
        if ($itemOptions['product_id'] == $product_id) {
            // echo 'Added to cart already';
            $isAddedToCart = true;
            break;
        }
    }
?>
<div>
<?php if ($isAddedToCart != true) { ?>
    <form id="add_to_cart" cart_page="<?php echo site_url('buyer/cart/my_cart'); ?>" msg="Adding <?php echo $name ?> to cart..." action="<?php echo site_url('/buyer/addtocart') ?>" method="POST">
<?php } ?>  
  <input type="hidden" id="qty" name="qty" min="1" value="1" placeholder="qty"/>
		<input type="hidden" id="purchase_means" name="purchase_means" value="<?php echo (isset($means)) ? $means : 'money'; ?>" />
        <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
        
        <div class="">
           <!-- <button  class="btn btn-sm btn-block <?php echo ($isAddedToCart == true) ? ' disabled"  onclick="return (\'false\') "' : '" type="submit"'; ?> style="background: #f3d347;"><i class="fa fa-shopping-cart"></i> Add To Cart</button>-->
        </div>
    </form>
</div>
