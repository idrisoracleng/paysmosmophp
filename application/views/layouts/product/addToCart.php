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
<div id="content-desk">

    <form msg="Adding <?php echo $name ?> to cart..." action="<?php echo site_url('/buyer/addtocart') ?>" method="POST" class="cart" class="add_to_cart">
        <div class="quantity">
            <input type="hidden" size="4" class="input-text qty text" title="Qty" value="1" name="qty" id="">
        </div>

        <input type="hidden" id="purchase_means" name="purchase_means" value="<?php echo (isset($means)) ? $means : 'money'; ?>" />
        <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />

        <button type="<?php echo ($isAddedToCart) ? 'button' : 'submit'; ?>" class="single_add_to_cart_button button alt <?php echo ($isAddedToCart) ? 'disabled' : 'submit'; ?>" name="add-to-cart" style="width: 500px;" id="add_to_cart_btn"><b>ADD TO CART</b></button>
    </form>
</div>


<div id="content-mobile">

    <form msg="Adding <?php echo $name ?> to cart..." action="<?php echo site_url('/buyer/addtocart') ?>" method="POST" class="cart" class="add_to_cart">
        <div class="quantity">
            <input type="hidden" size="4" class="input-text qty text" title="Qty" value="1" name="qty" id="">
        </div>

        <input type="hidden" id="purchase_means" name="purchase_means" value="<?php echo (isset($means)) ? $means : 'money'; ?>" />
        <input type="hidden" name="product_id" value="<?php echo $product_id ?>" />

        <button type="<?php echo ($isAddedToCart) ? 'button' : 'submit'; ?>" class="single_add_to_cart_button button alt <?php echo ($isAddedToCart) ? 'disabled' : 'submit'; ?>" name="add-to-cart" style="width: 300px;" id="add_to_cart_btn"><b style="font-size:14px;">ADD TO CART</b></button>
    </form>
</div>