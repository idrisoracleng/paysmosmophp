
 <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('admin/category'); ?>">Category</a>
      </li>
      <li class="breadcrumb-item active">Edit Category</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fa fa-arrow-alt-circle-left back-btn" href="#">back</a>
        <i class="fas fa-product"></i>
        <?php echo $category['name'] ?></div>
      <div class="card-body">
      <div class="row">
          <div class="col-md-5 offset-1">
            Fill the field below to update 
            <form class="form" enctype="multipart/form-data" method="POST" action="<?php echo site_url('/admin/category/update') ?>" msg="Updating Category ...">
              <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Category Name" value="<?php echo $category['name'] ?>"/>
                <input type="hidden" name="id" placeholder="Category Id" value="<?php echo $category['id'] ?>"/>
              </div>

              <div class="form-group">
                <select class="form-control" name="parent_id" placeholder="Category Name">
                  <option selected diabled>Select a parent category</option>
                  <option value="0">None</option>
                  <?php foreach($categories as $cat){ ?>
                    <option <?php echo ($category['parent_id'] == $cat->id) ? 'selected' : ''; ?> value="<?php echo $cat->id ?>"><?php echo $cat->name ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <textarea class="form-control" id="editor" name="description" placeholder="Category Description" style="height: 200px;"><?php echo $category['description'] ?></textarea>
              </div>

              <div class="form-group">
                <input type="text" id="icon" class="form-control" name="icon" placeholder="Category Icon" value="<?php echo $category['icon'] ?>"/>
							</div>
							
							<!-- <div class="form-group">
                <input type="text" id="commission" class="form-control" name="commission" placeholder="Category Commission" value="<?php echo $category['commission'] ?>"/>
              </div> -->

              <div class="form-group">
                Featured: 
                <input type="radio" name="featured" value="1" <?php echo ($category['featured'] == 1) ? 'checked' : ''; ?>/> Yes
                <input type="radio" name="featured" value="0" <?php echo ($category['featured'] == 0) ? 'checked' : ''; ?>/> No
              </div>

              <div class="form-group">
                <input type="file" id="imagetoupload" class="form-control" name="category_image" placeholder="choose"/>
              </div>

              <div class="form-group">
              <?php $iconImages = scandir(APPPATH.'/../resources/images/icon_image/'); $iconImages = array_diff($iconImages, ['.', '..']); ?>
                <select class="form-control" name="icon_image_path" id="icon_image">
                  <option>Select Icon Image</option>
                  <?php foreach ($iconImages as $key => $iconImage) { ?>
                    <option <?php echo ($category['icon_image_path'] == site_url('/resources/images/icon_image/'.$iconImage)) ? 'selected' : ''; ?> value="<?php echo site_url('/resources/images/icon_image/'.$iconImage); ?>"><?php echo str_replace(['.png', '_'], ['', ' '], ucfirst($iconImage)); ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <input type="submit" class="form-control btn btn-block btn-primary" value="Update" />
              </div>
            </form>
          </div>

          <div class="col-md-5">
            <h5>Image Preview</h5>
            <div id="image_preview" class="text-center">
              <img id="previewing" src="<?php echo site_url('/public/images/system/categories/'.strtolower(str_replace(' ', '-', $category['name'])).'.jpg') ?>" style="height: 200px; width: 200px;" />
            </div>
            
            <h5>Icon Image Preview</h5>
            <div id="icon_image_previewer" class="text-center">
              <img id="icon_image_preview" src="<?php echo $category['icon_image_path'] ?>" />
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
