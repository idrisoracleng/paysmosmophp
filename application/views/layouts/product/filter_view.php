<?php $category_name = str_replace([' ', "'"], ['-', '_'], strtolower($cat_name)); ?>																					 
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filter_modal">
	<b>All Filters</b>
</button>

<div class="modal fade" id="filter_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h4 class="modal-title text-white">Filter Products</h4>
			</div>
			<div class="modal-body">
					<form action="<?php echo site_url("/product/filter"); ?>" method="POST" msg="Filtering Result" class="filter_form" id="filter_form">
					<?php  ?>
					<input name="cat_id" value="<?php echo isset($cat_id) ? $cat_id : ''; ?>" type="hidden"/>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for=""><b>Price</b></label>
								<div id="techmarket_products_filter-3" class="widget widget_techmarket_products_filter">

									<div class="widget woocommerce widget_price_filter" id="woocommerce_price_filter-2">
										<p>
											<div class="price_slider_amount">
												<input id="amount" type="text" placeholder="Min price" data-min="6" data-max="100000" value="33" name="min_price" style="">
											</div><br>
											<div id="slider-range" class="price_slider"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for=""><b>Brands</b></label>
								<?php
								if ($cat_name == "all" || $cat_name == "top_collections") $bwhere = "";
								else $bwhere = " where category_id = $cat_id";
								//SELECT DISTINCT(brand) FROM `products` where category_id = $cat_id 
								 $brands = $this->db->query("SELECT DISTINCT(brand) AS brand_name FROM `products` $bwhere")->result();
								//$brands = $this->db->get('brands')->result(); ?>
								<?php foreach ($brands as $key => $brand) { ?>
									<br><input type="checkbox" name="brand_id[]" id="filter_brand" value="<?php echo $brand->brand_name; ?>">&nbsp&nbsp <?php echo $brand->brand_name; ?>
								<?php } ?>
							</div>
						</div>
						<div class="col">

							<!--<div class="form-group">
								<label for=""><b>Category</b></label>
								<?php $categories = $this->db->get('category')->result(); ?>
								<?php foreach($categories as $key => $category) { ?>
									<br><input type="radio" name="category_id" value="" id="filter_cat_id">&nbsp&nbsp <?php echo $category->name; ?>
								<?php } ?>
							</div>-->
						</div>
					
				
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit"><b>Apply</b></button>
					
				</div></div>
			</form>
				</div>
		<!-- /.modal-body -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="<?php //echo site_url('public/js/filter_product.js'); ?>"></script>