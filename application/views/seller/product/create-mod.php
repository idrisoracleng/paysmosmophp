

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/seller/product/all') ?>">Products</a>
      </li>
      <li class="breadcrumb-item active">New Product</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-product"></i>
        Create a New Product</div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-5">
            <h6>Fill The Form Below To Create a New Product</h6>
            <form class="form row" action="<?php echo site_url('/seller/product/store') ?>" method="post" enctype="multipart/form-data" msg="Creating New Product...">
              <div class="form-group col-md-12">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Product Full Name Example: Tecno, Itel.." />
              </div>

              <div class="form-group col-md-6">
                <label>Product Category</label>
                <select class="form-control" id="category">
                  <option selected disabled>Select Category</option>
                  <?php $categories = $this->CategoryModel->getAllCategories(); var_dump($categories)?>
                  <?php foreach($categories as $category){ ?>
                    <option class="" value="<?php echo $category->id?>">
                      <?php echo $category->name ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group col-md-6" id="">
                <label>Product Sub Category</label>
                <select class="form-control" name="category_id" id="subcategory">
                  <option selected disabled>Select Sub Category</option>
                </select>
              </div>

              <div class="form-group col-md-12">
                <label>Product Description</label>
                <textarea name="description" class="form-control editor"></textarea>
              </div>

              <div class="form-group col-md-12">
                <label>Product Price</label>
                <input type="text" name="price" class="form-control" placeholder="Product Price" />
              </div>

              <div class="form-group col-md-12">
                <label>Product Images</label>
                <input type="file" id="imagetoupload" name="product_image[]" accept="jpg/jpeg/png" class="form-control" multiple/>
              </div>

              <div class="form-group" style="display: inline" >
                <input type="submit" class="btn btn-block btn-primary" value="Create Product" />
                <a class="btn btn-block btn-danger text-light">Cancel</a>
              </div>


            </form>
          </div>

          <div class="col-md-2">
            <div id="catprev">
              <small class="text-info" data-toggle="tooltip" data-placement="top" title="This image will change when you select a category">
                Category Image Preview
              </small><br/>
              <img style="height: 100px; width: 100px;" src="<?php echo site_url('/public/images/system/sys/no-image.png') ?>"/>
            </div>

            <div id="subprev">
              <small class="text-info" data-toggle="tooltip" data-placement="top" title="This image will change when you select a sub category">
                Sub Category Image Preview
              </small><br/>
              <img style="height: 100px; width: 100px;" src="<?php echo site_url('/public/images/system/sys/no-image.png') ?>"/>
            </div>
          </div>



          <div class="col-md-4">
            <small class="text-info" data-toggle="tooltip" data-placement="top" title="This images will change when you select your product image">
              Product Image Preview
            </small><br/>
            <div id="image_preview">
              <?php $i = 0; while($i < 3){ ?>
                <img style="height: 100px; width: 100px;" id="prev" src="<?php echo site_url('/public/images/system/sys/no-image.png') ?>"/>
              <?php $i++; } ?>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>

  <script>
    $(document).ready(function(){
      $('label').addClass('text-info');
      // alert('Hello world');
      var category = $("#category");
      var subcategory = $("#subcategory");
      // var subcategory_id = $("#subcategory_id");
      category.change(function(){
        // alert($(this).val());
        $("#catprev").load("<?php echo site_url('/api/getCategoryImageUrl/') ?>"+$(this).val());
        subcategory.load("<?php echo site_url('/api/getSubCategories/') ?>"+$(this).val());
        // subcategory.load
      });


      subcategory.change(function(){
        // alert($(this).val());
        $("#subprev").load("<?php echo site_url('/api/getSubCategoryImageUrl/') ?>"+$(this).val(), (data)=>{console.log(data)}, (err)=>{console.log(err)});
        // subcategory.load
      });

      

    });
  </script>