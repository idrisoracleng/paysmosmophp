

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Deals Of The Day</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fas fa-arrow-left back-btn" href="#"> back</a>
        <i class="fas fa-product"></i>
        All Deals Of The Day <a href="<?php echo site_url('/admin/product/deals/add') ?>" style="float: right" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Active</th>
                <th>Deal Price</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Active</th>
                <th>Deal Price</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
                <?php foreach ($deals as $key => $deal) { $productData = $this->ProductModel->getProductBy('product_id', $deal['product_id']); ?>
                    <tr>
                        <td><?php echo $deal['name'] ?></td>
                        <td><img style="height: 30px; width: 30px" src="<?php echo site_url('/public/images/products/'.$productData['code'].'/01.jpg') ?>"/></td>
                        <td>
                            <?php if (date('Y-m-d H:i:s a') > $deal['start_time'] ) { ?>
                                <span class="badge badge-primary">active</span>
                            <?php } else { ?>
                                <span class="badge badge-danger">not active</span>
                            <?php } ?>
                        </td>
                        <form method="post" action="<?php echo site_url('admin/product/deals/update'); ?>" msg="Updating <?php echo $productData['name'] ?> deal detail">
                            <input type="hidden" name="id" value="<?php echo $deal['id']; ?>"/>
                            <td><input type="number" name="deal_price" class="form-control" min="0" value="<?php echo $deal['deal_price'] ?>" max="<?php echo $productData['price'] ?>"/></td>
                            <td><input type="datetime-local" class="form-control" name="start_time" value="<?php echo str_replace([' '], ['T'],$deal['start_time']); ?>"/></td>
                            <td><input type="datetime-local" class="form-control" name="end_time" value="<?php echo str_replace([' '], ['T'],$deal['end_time']); ?>"/></td>
                            <td>
                                <button class="btn btn-sm btn-warning"><i class="fa fa-upload"></i></button>
                                <a href="<?php echo site_url('admin/product/deals/remove/'.$deal['id']); ?>" msg="Do you want to delete this deal?" class="btn btn-danger btn-sm delete_btn"><i class="fa fa-trash"></i></a>
                            </td>
                        </form>
                    </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

  </div>
