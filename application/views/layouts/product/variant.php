<div class="col">
    <input type="hidden" id="<?php echo $size?>_price" value="<?php echo ($discount_price) ? $discount_price : $price; ?>"/>
    <input type="hidden" id="<?php echo $size?>_size" value="<?php echo $size; ?>"/>
    
    <!-- <p>Price <?php //echo ($discount_price) ? $discount_price : $price; ?></p> -->
    <button class="btn btn-sm btn-secondary select_variant" size="<?php echo $size; ?>"><?php echo $size; ?></button>
</div>
