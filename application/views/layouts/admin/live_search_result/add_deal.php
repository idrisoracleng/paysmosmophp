
<?php foreach ($products as $product) { ?>
    <tr>
        <form action="<?php echo site_url('admin/product/deals/store') ?>" method="post" msg="Adding <?php echo $product['name'] ?> to deals of the day">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>"/>
            <td><?php echo character_limiter($product['name'], 20); ?></td>
            <td><img style="height: 30px; width: 30px" src="<?php echo site_url('/public/images/products/'.$product['code'].'/01.jpg') ?>"/></td>
            <td><?php echo $product['price'] ?></td>
            <td><input type="number" name="deal_price" class="form-control" min="0" value="<?php echo $product['price'] ?>" max="<?php echo $product['price'] ?>"/></td>
            <td><input type="datetime-local" class="form-control" name="start_time"/></td>
            <td><input type="datetime-local" class="form-control" name="end_time"/></td>
            <td><button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add</button></td>
        </form>
    </tr>
<?php } ?>