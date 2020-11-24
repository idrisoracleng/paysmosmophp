
<?php
		$subcategories = $this->CategoryModel->getSubCategories($category['id']);
		$catProducts = $this->db->get_where('products', ['category_id' => $category['id']])->result();
?>
  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/category') ?>">Category</a>
      </li>
      <li class="breadcrumb-item active">#<?php echo $category['id'] ?></li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fa fa-arrow-alt-circle-left back-btn" href="">back</a>
        <i class="fas fa-product"></i>
        <?php echo $category['name'] ?>
        <div style="float: right">
					<a href="<?php echo site_url('/admin/category/create') ?>" class="btn btn-sm btn-primary"> <span class="fa fa-plus"></span> Add New Category</a> &nbsp;
					<?php if ($category['featured'] == 0) { ?>
						<a 
							href="<?php echo site_url('/admin/category/feature/'.$category['id']) ?>" 
							class="btn btn-sm btn-primary slink"
							msg="Do you want to feature <?php echo $category['name'] ?>?"> <span class="fa fa-share"></span> Feature Category</a> &nbsp;
					<?php } else { ?>
						<a 
							href="<?php echo site_url('/admin/category/un_feature/'.$category['id']) ?>" 
							class="btn btn-sm btn-warning slink"
							msg="Do you want to Un feature <?php echo $category['name'] ?>?"> <span class="fa fa-window-close"></span> Un Feature Category</a> &nbsp;
					<?php } ?>
          <a href="<?php echo site_url('/admin/category/edit/'.$category['id']) ?>" class="btn btn-sm btn-primary"> <span class="fa fa-edit"></span> Edit Category</a>
          <a class="btn btn-sm btn-danger fa fa-trash-alt delete_btn" href="<?php echo site_url('/admin/category/delete/'.$category['id']) ?>"> Delete Category</a>
        </div>
        
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div>
              <h4><?php echo $category['name'] ?></h4>
              <hr/>
              <div class="text-center">
                <img class="img-thumbnail" src="<?php echo site_url('public/images/system/categories/'.strtolower(str_replace(' ', '-', $category['name'])).'.jpg') ?>"/>
              </div>
              <p>
                <?php echo $category['description'] ?>
              </p>
            </div>
          </div>
          <div class="col-md-9">


          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="true">Sub Categories <span class="badge badge-warning"><?php echo count($subcategories); ?></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false">Product <span class="badge badge-warning"><?php echo count($catProducts); ?></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
              <?php if(count($subcategories) > 0){ ?>
                <div class="row" style="padding: 10px;">
                <?php foreach($subcategories as $subcategory){ ?>
                  
                  <a class="col-sm-3" href="<?php echo site_url('/admin/category/view/'.$subcategory['id']) ?>">
                    <div class="card">
                      <img class="img-thumbnail card-img" src="<?php echo site_url('public/images/system/categories/'.strtolower(str_replace(' ', '-', $subcategory['name'])).'.jpg') ?>"/>
                      <div class="card-img-bottom"><h5 class="text-success bg-dark"><?php echo $subcategory['name']?></h5></div>
                    </div>
                  </a>
                  
                <?php } ?>
                </div>
              <?php } ?>
            </div>
            <!-- Sub Category Ends Here -->
            <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
							<div class="container mt-3">
								<?php if ($catProducts) { ?>
									<div class="row justify-content-between">
										<?php foreach ($catProducts as $key => $product) { ?>
											<?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product->product_id])->result(); ?>
											<div class="col-md-4">
												<div class="card shadow">
													<!-- <h4 class="card-header"><?php //echo $product->name; ?></h4> -->
													<div class="card-body">
														<p>Name: <?php echo $product->name; ?></p>
														<?php if ($variants) { ?>
															<p>Price: N <?php echo ($variants[0]->discount_price) ? $variants[0]->discount_price : $variants[0]->price; ?></p>
														<?php } else { ?>
															<p>Price: N <?php echo ($price->discount_price) ? $price->discount_price : $price->price; ?></p>
														<?php } ?>
														<div>
															<a href="<?php echo site_url('admin/product/view/'.$product->code); ?>"><i class="fas fa-eye"></i></a>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								<?php } else { ?>
									<div class="alert alert-info text-center">No product under this category</div>
								<?php } ?>
							</div>
            </div>

						<div class="tab-pane fade container" id="description" role="tabpanel" aria-labelledby="description-tab">
              <?php echo $category['description']; ?>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
