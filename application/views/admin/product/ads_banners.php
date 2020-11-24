

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
        All Ads Banners <a href="<?php echo site_url('admin/product/ads_banners') ?>" style="float: right" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="row">
            <div class="table-responsive col-md-12">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($adsBanners as $adsBanner){ ?>
                            <tr>
                                <td><?php echo $adsBanner['name'] ?></td>
                                <td>
                                    <img src="<?php echo $adsBanner['image_path'] ?>" style="width: 100px; height: 80px"/>
                                </td>
                                <td><?php echo $adsBanner['link'] ?></td>
                                <td><?php echo $adsBanner['position'] ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="<?php echo site_url('admin/product/ads_banners/edit/'.$adsBanner['id']) ?>"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm delete_btn" href="<?php echo site_url('admin/product/ads_banners/delete/'.$adsBanner['id']) ?>"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12" id="newBrand">
                <?php if (isset($adsBannerData)) { ?>
                    <form msg="Updating <?php echo $adsBannerData['name'] ?> Data" action="<?php echo site_url('admin/product/ads_banners/update') ?>" method="POST" enctype="multipart/form-data">
                        <h5>Edit <?php echo $adsBannerData['name']; ?> Ads Banner</h5>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $adsBannerData['id']; ?>" />
                            <input type="text" name="name" class="form-control" placeholder="Input Ads Banner Name" value="<?php echo $adsBannerData['name'] ?>"/>
                        </div>

                        <div class="form-group">
                            <input type="text" name="link" class="form-control" placeholder="Input Ads Banner Link" value="<?php echo $adsBannerData['link'] ?>"/>
                        </div>

                        <div class="form-group">
                            <input type="number" name="position" class="form-control" placeholder="Input Ads Banner Position" value="<?php echo $adsBannerData['position'] ?>"/>
                        </div>

                        <div class="form-group">
                            <img src="<?php echo $adsBannerData['image_path']; ?>" style="height: 200px; width: 100%;"/>
                        </div>

                        <div class="form-group">
                            <input type="file" name="image_path" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Update</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <form msg="Creating New Banner" action="<?php echo site_url('admin/product/ads_banners/store') ?>" method="POST" enctype="multipart/form-data">
                        <h5>Create New Banner</h5>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Input Ads Banner Name" />
                        </div>

                        <div class="form-group">
                            <input type="text" name="link" class="form-control" placeholder="Input Ads Banner Link" />
                        </div>

                        <div class="form-group">
                            <input type="number" name="position" class="form-control" placeholder="Input Ads Banner Position" value=""/>
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
