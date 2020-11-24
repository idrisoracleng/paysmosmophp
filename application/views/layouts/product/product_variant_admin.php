<div class="card">
	<h4 class="card-header">
		<?php echo $name." Variant"; ?>
	</h4>
	<div class="card-body">
		<div class="row justify-content-around">
			<?php foreach ($variants as $key => $variant) { ?>
				<div class="col-md-3 p-3 shadow rounded">
					<p>Price <span class="float-right"><?php echo $variant->price; ?></span></p>
					<p>Discount Price <span class="float-right"><?php echo $variant->price; ?></span></p>
					<p>Size <span class="float-right"><?php echo $variant->size; ?></span></p>
					<p>Quantity <span class="float-right"><?php echo $variant->qty; ?></span></p>
					<div class="">
						<a href="<?php echo site_url('admin/product/variant/delete/'.$variant->id) ?>" 
							class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-trash"></i></a>
						<a href="<?php echo site_url('admin/product/edit/'.$variant->product_id) ?>" 
							class="btn btn-sm btn-primary rounded-circle"><i class="fa fa-edit"></i></a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
	
