<style>
  h1,h2,h3,h4,h5,h6 {
    font-variant: small-caps;
    font-family: 'Hepta Slab', cursive;
  }

  button, label {
    font-family: 'Livvic', sans-serif;
  }
</style>

<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
      <li class="breadcrumb-item">
				<a class="fas fa-arrow-left back-btn" href="#"> back</a>
        <a href="<?php echo site_url('/admin/product/all') ?>">Products</a>
      </li>
      <li class="breadcrumb-item active">New Product</li>
    </ol>
    <div class="row">
      <div class="col-md-9">
        <h2>Create/Sell a new Product</h2>
      </div>
      <div class="col-md-3">
			  <a class="btn btn-danger btn-sm back-btn" href="#">Cancel</a>
        <button class="btn btn-success btn-sm save_product"><span class="fa fa-check"></span> Save Item</button>
      </div>
    </div>
    
  <form class="form" method="POST" action="<?php echo site_url('/admin/product/store'); ?>" enctype="multipart/form-data" id="product_form" msg="Creating new product...">
    <!-- Product Category Form Start -->
    <div class="panel card mb-3">
      <div class="card-body">
        <div class="panel-heading">
          <h4>Product Category</h4>
        </div>
        <hr/>
        <div class="panel-body">
          <div class="row">

            <div class="form-group col-md-4">
              <label>Select Product Size Category</label>
              <select required class="form-control custom-select-sm" name="size_category">
                <option selected disabled>Select Product Size Category</option>
                <option value="small"> Small</option>
                <option value="medium"> Medium</option>
                <option value="large"> Large</option>
              </select>
						</div>
						
						<div class="row col-md-12" id="category_tile">
							<div class="form-group col-md-4 category_tile_cloneable"  id="category_tile_cloneable">
								<label>Select Category</label>
								<select required class="form-control custom-select-sm categoryi" name="category_id" id="main_cat">
									<option selected disabled>Select Category</option>
									<?php $categories = $this->db->order_by('name', 'ASC')->get_where('category', ['parent_id' => 0])->result();?>
									<?php foreach($categories as $category) { ?>
										<option value="<?php echo $category->id; ?>">
											<?php echo $category->name; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>
						
          </div>
        </div>
      </div>
    </div>
    <!-- Product Category Form Ends -->


    <!-- Product Image Form Start -->
    <div class="panel card general mb-3">
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
              <?php $i = 0; while ($i < 3) { ?>
                <img id="prev" style="width: 200px;" src="<?php echo site_url('/public/images/system/sys/no-image.png') ?>"/>
              <?php $i++; } ?>
              <img id="prev" style="width: 200px;" src="<?php echo site_url('/public/images/system/sys/no-image.png') ?>"/>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Product Image Form Start -->
  </div>

  <!-- Product Detail Form Start -->
  <div class="panel card general mb-3">
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
            <input required type="text" name="name" class="form-control" placeholder="Product Full Name Example: Tecno, Itel.." />
          </div>

          <!-- <div class="form-group col-md-6">
            <label>Short Description</label>
            <textarea required name="short_description" class="form-control editor"></textarea>
          </div> -->

          <div class="form-group col-md-6">
            <label>Long Description</label>
            <textarea required name="description" class="form-control" id="editor"></textarea>
          </div>

          <div class="form-group col-md-6">
            <label>Brand</label>
            <?php $brands = $this->db->get('brands')->result(); ?>
            <select required name="brand" class="form-control" id="brand">
              <?php foreach ($brands as $key => $brand) { ?>
                <option value="<?php echo $brand->name ?>"><?php echo $brand->name; ?></option>
              <?php } ?>
              <option value="other">Other</option>
            </select>
            <input required type="hidden" name="brand" id="custom_brand" class="form-control input-sm" placeholder="Input Custom Brand" disabled/>
          </div>

          <!-- <div class="form-group col-md-6">
            <label>Shipping weight (Kg)</label>
            <input required type="text" name="weight" class="form-control input-sm" placeholder="Shipping weight"/>
          </div> -->

        </div>
      </div>
    </div>
  </div>
  <!-- Product Detail Form End -->


  <!-- Product Pricing Form Start -->
  <div class="panel card general sim mb-3">
    <div class="card-body">
      <div class="panel-heading">
        <h4>Pricing And Taxing</h4>
        <hr/>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label>Price</label>
            <input required type="text" id="price" name="price" class="form-control input-sm" placeholder="Price *"/>
          </div>

          <div class="form-group col-md-4">
            <label>Discount Price (optional)</label>
            <input required type="text" id="discount_price" name="discount_price" class="form-control input-sm" placeholder="Discount price"/>
          </div>

          <div class="form-group col-md-4">
            <label>Bulk Price (optional)</label>
            <input required type="text" name="bulk_price" class="form-control input-sm" placeholder="Bulk price"/>
          </div>

          <div class="form-group col-md-4">
            <label>Total Price</label>
            <input required type="text" id="total_price" name="total_price" class="form-control input-sm" readonly/>
          </div>

          <!-- <div class="form-group col-md-4">
            <label>Quantity</label>
            <input required type="text" name="quantity" class="form-control input-sm" placeholder="Quantity"/>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- Product Pricing Form End -->


  <!-- Product Other Options Form Start -->
  <div class="panel card general mb-3">
    <div class="card-body">
      <div class="panel-heading">
        <h4>Other Product Options</h4>
        <hr/>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label>Return Policy</label>
            <input required type="text" id="return_policy" name="return_policy" class="form-control input-sm" placeholder="Return policy"/>
          </div>

          <div class="form-group col-md-4">
            <label>Supplier SKU</label>
            <input required type="text" name="supplier_sku" class="form-control input-sm" placeholder="Supplier SKU"/>
          </div>

          <div class="form-group col-md-4">
            <label>Model</label>
            <input required type="text" name="model" class="form-control input-sm" placeholder="Model"/>
          </div>

          <div class="form-group col-md-4">
            <label>Condition</label>
            <select required type="text" id="product_condition" name="product_condition" class="form-control input-sm">
              <option selected disabled>What is the condition of this item</option>
              <option value="new" selected>New</option>
              <option value="refurbished">Refurbished</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Product Other Options From End -->

  <!-- Product Warranty Form Start -->
  <div class="panel card general mb-3">
    <div class="card-body">
      <div class="panel-heading">
        <h4>Warranty</h4>
        <hr/>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="form-group col-md-12">
            <p>Do you want to provide a warranty?</p>
            <input type="radio" name="warranty" value="yes"/><label>Yes</label>
            <input type="radio" name="warranty" value="no" checked/><label>No</label>
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
              <textarea name="warranty_detail" id="warranty_detail" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Product Warranty Form End -->

  <!-- Product SEO Form Start -->
  <div class="panel card general mb-3">
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
            <input required name="seo_key" class="form-control"/>
          </div>

          <div class="form-group col-md-6">
            <label>Tags</label>
            <input required name="tags" class="form-control"  placeholder="Input product tags separated by comma"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Product SEO Form End -->
   
  <hr/>
  <div class="row">
    <div class="offset-9 col-md-3">
      <a class="btn btn-danger btn-sm back-btn" href="#">Cancel</a>
      <button class="btn btn-success btn-sm save_product"><span class="fa fa-check"></span> Save Item</button>
    </div>
  </div>
  </form>
 

<div style="display: none;">
  <!-- Product Warranty Form Start -->
  <div class="panel card general mb-3">
    <div class="card-body">
      <div class="panel-heading">
        <h4>Warranty</h4>
        <hr/>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="form-group col-md-12">
            <p>Do you want to provide a warranty?</p>
            <input required type="radio" name="warranty" value="yes"/><label>Yes</label>
            <input required type="radio" name="warranty" value="no" checked/><label>No</label>
          </div>

          <div class="col-md-12 row" id="more_warranty_detail" style="display: none">
            <div class="form-group col-md-6">
              <label>Warranty Period</label>
              <select required type="text" id="warranty_period" name="warranty_period" class="form-control input-sm">
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
              <textarea required name="warranty_detail" id="warranty_detail" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Product Warranty Form End -->
</div>


  <script src="<?php echo site_url("/public/js/add_product.js") ?>"></script>
  <script>
    $(document).ready(function() {
      // $(".general").hide();
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
