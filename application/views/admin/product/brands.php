

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
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
        All Brands <a href="#newBrand" style="float: right" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="row">
            <div class="table-responsive col-md-7">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($brands as $brand){ ?>
                            <tr>
                                <td><?php echo $brand['name'] ?></td>
                                <td>
                                    <img src="<?php echo $brand['image_path'] ?>" />
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="<?php echo site_url('admin/product/brands/edit/'.$brand['id']) ?>"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm delete_btn" href="<?php echo site_url('admin/product/brands/delete/'.$brand['id']) ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-5" id="newBrand">
                <?php if (isset($brandData)) { ?>
                    <form msg="Updating <?php echo $brandData['name'] ?> Data" action="<?php echo site_url('admin/product/brands/update') ?>" method="POST" enctype="multipart/form-data">
                        <h5>Edit <?php echo $brandData['name']; ?> Brand</h5>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $brandData['id']; ?>" />
                            <input name="name" class="form-control" placeholder="Input Brand Name" value="<?php echo $brandData['name'] ?>"/>
                        </div>

                        <div class="form-group">
                            <img src="<?php echo $brand['image_path']; ?>" />
                        </div>

                        <div class="form-group">
                            <input type="file" name="image_path" class="form-control" value=""/>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <form msg="Creating New Brand" action="<?php echo site_url('admin/product/brands/store') ?>" method="POST" enctype="multipart/form-data">
                        <h5>Create New Brand</h5>
                        <div class="form-group">
                            <input name="name" class="form-control" placeholder="Input Brand Name" />
                        </div>

                        <div class="form-group">
                            <input type="file" name="image_path" class="form-control" />
                        </div>

                        <div class="form-group">
                            <small class="alert alert-info">Image size must be height: 80px, width: 100px;</small>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Create</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
