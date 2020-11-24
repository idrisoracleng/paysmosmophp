

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Products</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fas fa-arrow-left back-btn" href="#"> back</a>
        <i class="fas fa-product"></i>
        All Featured Products <a href="<?php echo site_url('/admin/product/featured/add') ?>" style="float: right" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Owner</th>
                <th>Code</th>
                <th>Category</th>
                <th>Price</th>
                <th>Views</th>
                <th>Rating</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Owner</th>
                <th>Code</th>
                <th>Category</th>
                <th>Price</th>
                <th>Views</th>
                <th>Rating</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($featuredProducts as $product){ ?>
              <tr>
                <td><?php echo character_limiter($product['name'], 10) ?></td>
                <td><img style="height: 50px; width: 50px" src="<?php echo site_url('/public/images/products/'.$product['code'].'/01.jpg') ?>"/></td>
                <td><?php echo $this->UserModel->getUserBy('user_id', $product['owner_id'])['full_name']; ?></td>
                <td><?php echo $product['code']; ?></td>
                <td><?php echo $this->SubCategoryModel->getSubCategory($product['category_id'])['name'] ?></td>
                <td><?php echo $this->cart->format_number($product['price']) ?></td>
                <td><?php echo $product['views'] ?></td>
                <td><?php echo count($this->db->where('product_id', $product['product_id'])->get('product_rating')->result()); ?></td>
                <td><?php echo $product['created_at']; ?></td>
                <td>
                  <a class="btn btn-sm btn-primary" href="<?php echo site_url('/admin/product/view/'.$product['code']) ?>"><i class="fas fa-eye"></i></a>
                  <form action="<?php echo site_url('admin/product/featured/remove') ?>" method="post" msg="Removing <?php $product['name'] ?> from Featured Products">
                      <input type="hidden" value="<?php echo $product['product_id'] ?>" name="product_id" />
                      <button class="btn btn-danger btn-sm"><i class="fa fa-window-close"></i></button>
                  </form>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

  </div>
