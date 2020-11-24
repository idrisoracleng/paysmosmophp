<?php 

$avg_rating = $this->db->where('product_id', $product_id)->select('AVG(rate) as avg_rating')->from('product_rating')->get()->row()->avg_rating;
?>
<div class="rating">
    <div class="rating-box">
        <?php $i = 0; while($i < 5){ ?>
            <?php if ($avg_rating > $i) { ?>
                <span class="fa fa-stack text-success"><i class="fa fa-star-o text-success"></i></span>
            <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o"></i></span>
            <?php } ?>
        <?php $i++; } ?>
    </div>
</div>
