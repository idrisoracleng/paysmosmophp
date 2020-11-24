

<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('admin/product/featured'); ?>">Featured Products</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fas fa-arrow-left back-btn" href="#"> back</a>
        <i class="fas fa-product"></i>
        Add Featured Product <a href="<?php echo site_url('/admin/product/deals') ?>" style="float: right" class="btn btn-sm btn-primary">All <span class="fa fa-product"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Views</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Views</th>
                      <th>Actions</th>
                  </tr>
              </tfoot>
              <tbody>
                  <?php foreach ($products as $product) { ?>
                      <tr>
                          <td><?php echo $product['name'] ?></td>
                          <td><img style="height: 30px; width: 30px;" src="<?php echo site_url('/public/images/products/'.$product['code'].'/01.jpg') ?>"/></td>
                          <td><?php echo $product['price'] ?></td>
                          <td><?php echo $product['views'] ?></td>
                          <td>
                              <form action="<?php echo site_url('admin/product/featured/store') ?>" method="post" msg="Adding <?php echo $product['name'] ?> to featured products">
                                  <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>"/>
                                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add</button>
                              </form>
                          </td>
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">
          <?php //$this->DealsOfTheDayModel->getActiveDealsOfTheDay(); ?>
      </div>
    </div>

  </div>
