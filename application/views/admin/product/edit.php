<?php 
  $warranty_detail = $this->db->get_where('warranty', ['product_id' => $product['product_id']])->row();
  $product_variants = $this->db->get_where('variants', ['product_id' => $product['product_id']])->result();
?>
<style>
  h1,h2,h3,h4,h5,h6 {
    font-variant: small-caps;
    font-family: 'Hepta Slab', cursive;
  }

  button, label {
    font-family: 'Livic', sans-serif;
  }
</style>

<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <a class="fas fa-arrow-left back-btn" href="#"> back</a>
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/product/all') ?>">Products</a>
      </li>
      <li class="breadcrumb-item active">Edit Product</li>
    </ol>
    <div class="row">
      <div class="col-md-9">
        <h2>Update Product Item</h2>
      </div>
      <div class="col-md-3">
        <a class="btn btn-danger back-btn" href="#">Cancel</a>
        <button class="btn btn-success save_product"><span class="fa fa-check"></span> Update Item</button>
      </div>
    </div>
    
  <form class="form" method="POST" action="<?php echo site_url('/admin/product/update'); ?>" enctype="multipart/form-data" id="product_form" msg="Updating Product Data...">
    <input required type="hidden" value="<?php echo $product['product_id']; ?>" name="product_id"/>
    <input required type="hidden" value="<?php echo $product['code']; ?>" name="code"/>
    <!-- Product Category Form Start -->
    <div class="panel general rd mb-3">
			
		  <div class="panel-heading">
          <h4>Product Category</h4>
        </div>
      <div class="card-body">
				<div class="row">

          <div class="form-group col-md-4">
            <label>Select Product Size Category</label>
            <select required class="form-control custom-select-sm" name="size_category" required>
              <option selected disabled>Select Product Size Category</option>
              <option <?php echo ($product['size_category'] == 'small') ? ' selected ' : ' ' ?> value="small"> Small</option>
              <option  <?php echo ($product['size_category'] == 'medium') ? ' selected ' : ' ' ?> value="medium"> Medium</option>
              <option  <?php echo ($product['size_category'] == 'large') ? ' selected ' : ' ' ?> value="large"> Large</option>
            </select>
          </div>

					<div class="col-md-12">
						<div class="panel-body">
							<div class="row" id="categories">
								<div class="form-group col-md-4">
									<label>Main Category</label>
									<select required class="form-control custom-select-sm category" name="category_id">
										<option selected disabled>Select Category</option>
										<?php $categories = $this->CategoryModel->getAllCategories();?>
										<?php foreach($categories as $category){ ?>
											<option <?php echo ($category->id == $product['category_id']) ? 'selected' : ''; ?> value="<?php echo $category->id?>">
												<?php echo $category->name ?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
        <hr/>
				</div>

				
      </div>
    </div>
    <!-- Product Category Form Ends -->


    <!-- Product Image Form Start -->
    <div class="panel general rd mb-3">
      <div class="card-body">
        <div class="panel-heading">
          <h4>Product Image</h4>
          <p class="text-info" data-toggle="tooltip" data-placement="top" title="This images will change when you select your product image">
            Product Image Preview. Click on the preview image below to select images
          </p>
          <hr/>
        </div>
        <div class="panel-body">
          <div class="text-centered">
          <div class="text-centered">
            <input required type="file" id="imagetoupload" name="product_image[]" accept="jpg/jpeg/png" style="display: none;" multiple/>
            <div id="image_preview" class="text-center">
            	<?php $product_images = array_diff((array) scandir(APPPATH.'../public/images/products/'.$product['code']), ['.', '..']) ?>
							<?php foreach ($product_images as $pimage) { ?>
								<img id="prev" style="width: 200px; border: 5px solid red;" src="<?php echo site_url('public/images/products/'.$product['code'].'/'.$pimage); ?>"/>
							<?php } ?>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Product Image Form Ends -->

    <!-- Product Detail Form Start -->
    <div class="panel general rd mb-3">
      <div class="card-body">
        <div class="panel-heading">
          <h4>Product Detail</h4>
          <p class="text-info" data-toggle="tooltip" data-placement="top" title="This images will change when you select your product image">
            Product Detail
          </p>
          <hr/>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="form-group col-md-12">
              <label>Product Title</label>
              <input required type="text" name="name" class="form-control" placeholder="Product Full Name Example: Tecno, Itel.." value="<?php echo $product['name'] ?>"/>
            </div>

            <!-- <div class="form-group col-md-6">
              <label>Short Description</label>
              <textarea name="short_description" class="form-control editor"><?php //echo $product['short_description'] ?></textarea>
            </div> -->

            <div class="form-group col-md-12">
              <label>Long Description</label>
              <textarea name="description" class="form-control" col="6"><?php echo $product['description'] ?></textarea>
            </div>

            <div class="form-group col-md-6">
              <label>Brand</label>
              <?php $brands = $this->db->get('brands')->result(); ?>
              <select required name="brand" class="form-control" id="brand">
                <?php foreach ($brands as $key => $brand) { ?>
                  <option <?php echo ($brand->name == $product['brand']) ? 'selected':''; ?> value="<?php echo $brand->name ?>"><?php echo $brand->name; ?></option>
                <?php } ?>
                <option value="other">Other</option>
              </select>
              <input required type="hidden" name="brand" id="custom_brand" class="form-control input-sm"  value="<?php echo $product['brand'] ?>" placeholder="Input Custom Brand" disabled/>
            </div>

            <!-- <div class="form-group col-md-6">
              <label>Shipping weight (Kg)</label>
              <input required type="text" name="weight" class="form-control input-sm" placeholder="Shipping weight" value="<?php echo $product['weight'] ?>"/>
            </div> -->

          </div>
        </div>
      </div>
    </div>
    <!-- Product Detail Form End -->



		<!-- Product Pricing Form Start -->
			<div class="panel general rd mb-3 sim" style="<?php echo ($product_variants) ? 'display: none;' : ''; ?>">
				<div class="card-body">
					<div class="panel-heading">
						<h4>Pricing And Taxing</h4>
						<hr/>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-4">
								<label>Price</label>
								<input required type="text" id="price" name="price" class="form-control input-sm" placeholder="Price *" value="<?php echo $product['price'] ?>"/>
							</div>

							<div class="form-group col-md-4">
								<label>Discount Price (optional)</label>
								<input required type="text" id="discount_price" name="discount_price" class="form-control input-sm" placeholder="Discount price" value="<?php echo $product['discount_price'] ?>"/>
							</div>

							<div class="form-group col-md-4">
								<label>Bulk Price (optional)</label>
								<input required type="text" name="bulk_price" class="form-control input-sm" placeholder="Bulk price" value="<?php echo $product['bulk_price'] ?>"/>
							</div>

							<div class="form-group col-md-4">
								<label>Total Price</label>
								<input required type="text" id="total_price" name="total_price" class="form-control input-sm" readonly value="<?php echo $product['total_price'] ?>"/>
							</div>

							<!-- <div class="form-group col-md-4">
								<label>Quantity</label>
								<input required type="text" name="quantity" class="form-control input-sm" placeholder="Quantity" value="<?php echo $product['quantity'] ?>"/>
							</div> -->
						</div>
					</div>
				</div>
			</div>
    <!-- Product Pricing Form End -->


		<!-- Product Options Form Start -->
    	<!-- <div class="panel general rd mb-3 com" style="<?php //echo (!$product_variants) ? 'display: none;' : ''; ?>">
				<div class="card-body">
					<div class="panel-heading">
						<h4>Product Variants</h4>
						<hr/>
					</div>
					
					<div class="panel-body">
						<div class="row justify-content-center" id="product_variants">
							<?php //if ($product_variants) { ?>
								<?php //foreach ($product_variants as $key => $variant) { ?>
									<div class="form-group col-md-3">
										<label>Size</label>
										<input required name="variant_size[]" class="form-control input-sm" placeholder="Input variant size" value="<?php echo $variant->size; ?>"/>            
									</div>
									<div class="form-group col-md-3">
										<label>Price</label>
										<input required type="number" name="variant_price[]" class="form-control input-sm" placeholder="Input variant price" value="<?php echo $variant->price; ?>"/>         
										<input required type="hidden" name="variant_id[]" value="<?php //echo $variant->id; ?>"/>         
									</div>
									<div class="form-group col-md-3">
										<label>Discount Price</label>
										<input required type="number" name="variant_discount_price[]" class="form-control input-sm" placeholder="Input variant price" value="<?php echo $variant->discount_price; ?>"/>   
									</div>
									<div class="form-group col-md-2">
										<label>Quantity</label>
										<input required type="number" name="variant_qty[]" class="form-control input-sm" placeholder="Input variant price" value="<?php echo $variant->qty; ?>"/>   
									</div>

									<div class="form-group col-md-1">
										<label></label>
										<a href="<?php //echo site_url('admin/product/variant/delete/'.$variant->id); ?>" class="btn btn-danger delete_btn"><i class="fa fa-trash"></i></a>
									</div>
								<?php //} ?>
							<?php //} else { ?>
								<div class="form-group col-md-3">
									<label>Size</label>
									<input required name="variant_size[]" class="form-control input-sm" placeholder="Input variant size"/>            
								</div>
								<div class="form-group col-md-3">
									<label>Price</label>
									<input required type="number" name="variant_price[]" class="form-control input-sm" placeholder="Input variant price"/>         
									<input required type="hidden" name="variant_id[]" value="null"/>         
								</div>

								<div class="form-group col-md-3">
									<label>Discount Price</label>
									<input required type="number" name="variant_discount_price[]" class="form-control input-sm" placeholder="Input variant price"/>   
								</div>
								
								<div class="form-group col-md-2">
									<label>Quantity</label>
									<input required type="number" name="variant_qty[]" class="form-control input-sm" placeholder="Input variant price"/>   
								</div>

								<div class="form-group col-md-1">
									<a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</div>
							<?php //} ?>
						</div>
						<div>
							<button type="button" class="btn btn-small btn-primary fa fa-plus" id="add_product_variant">Add</button>
						</div>
					</div>
				</div>
			</div> -->
    <!-- Product Options From End -->


    <!-- Product Other Options Form Start -->
    <div class="panel general rd mb-3">
      <div class="card-body">
        <div class="panel-heading">
          <h4>Other Product Options</h4>
          <hr/>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="form-group col-md-4">
              <label>Return Policy</label>
              <input required type="text" id="return_policy" name="return_policy" class="form-control input-sm" placeholder="Return policy" value="<?php echo $product['return_policy'] ?>"/>
            </div>

            <div class="form-group col-md-4">
              <label>Supplier SKU</label>
              <input required type="text" name="supplier_sku" class="form-control input-sm" placeholder="Supplier SKU" value="<?php echo $product['supplier_sku'] ?>"/>
            </div>

            <div class="form-group col-md-4">
              <label>Model</label>
              <input required type="text" name="model" class="form-control input-sm" placeholder="Model" value="<?php echo $product['model'] ?>"/>
            </div>

            <div class="form-group col-md-4">
              <label>Condition</label>
              <select required type="text" id="product_condition" name="product_condition" class="form-control input-sm">
                <option selected disabled>What is the condition of this item</option>
                <option value="yes" <?php echo ($product['product_condition'] == 'used') ? ' selected ' : ''; ?>>Used</option>
                <option value="no" <?php echo ($product['product_condition'] == 'new') ? ' selected ' : ''; ?>>New</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Product Other Options From End -->

    <!-- Product Warranty Form Start -->
    <div class="panel general rd mb-3">
      <div class="card-body">
        <div class="panel-heading">
          <h4>Warranty</h4>
          <hr/>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="form-group col-md-12">
              <p>Do you want to provide a warranty?</p>
              <input type="radio" name="warranty" value="yes" <?php echo ($warranty_detail) ? 'checked' : '';?> /><label>Yes</label>
              <input type="radio" name="warranty" value="no" <?php echo (!$warranty_detail) ? 'checked' : 'checked';?> /><label>No</label>
            </div>

            <div class="col-md-12 row" id="more_warranty_detail" style="display: none">
              <div class="form-group col-md-6">
                <label>Warranty Period</label>
                <select type="text" id="warranty_period" name="warranty_period" class="form-control input-sm">
                  <option selected disabled>Select warranty period</option>
                  <option value="three_month">Three Months</option>
                  <option value="six_month">Six Month</option>
                  <option value="one_year">One Year</option>
                  <option value="two_year">Two years</option>
                  <option value="three_year">Three years</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Warranty Detail (not more than 200 character)</label>
                <textarea name="warranty_detail" id="warranty_detail" class="form-control"><?php echo ($warranty_detail) ? $warranty_detail->detail: '';?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Product Warranty Form End -->

    <!-- Product SEO Form Start -->
    <div class="panel general rd mb-3">
      <div class="card-body">
        <div class="panel-heading">
          <h4>SEO (Search Engine Optimization)</h4>
          <p>
            Keywords (SEO meta tags describes your store to search engine. Separate each tag with comma (,))
          </p>
          <hr/>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label>Enter keywords here</label>
              <input required name="seo_key" class="form-control" value="<?php echo $product['seo_key'] ?>"/>
            </div>

            <div class="form-group col-md-6">
              <label>Tags</label>
              <input required name="tags" class="form-control" placeholder="Input product tags separated by comma" value="<?php echo $product['tags'] ?>"/>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Product SEO Form End -->
    
    <hr/>
    <div class="row">
      <div class="offset-9 col-md-3">
        <a class="btn btn-danger back-btn" href="#">Cancel</a>
        <button class="btn btn-success save_product"><span class="fa fa-check"></span> Update Item</button>
      </div>
    </div>
  </form>
</div>
 




  <script src="<?php echo site_url("/public/js/add_product.js") ?>"></script>
  <script>
    $(document).ready(function() {
      $("#brand").change(function() {
        if ($(this).val() == 'other') {
          $("#custom_brand").attr('disabled', false);
          $("#custom_brand").attr('type', 'text');
        } else {
          $("#custom_brand").attr('type', 'hidden');
          $("#custom_brand").attr('disabled', true);
        }
			});
    });
  </script>
