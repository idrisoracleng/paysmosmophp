

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/category') ?>">Categories</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fas fa-arrow-left back-btn" href="#"> back</a>
        <i class="fas fa-product"></i>
        All Categories <a href="<?php echo site_url('/admin/category/create') ?>" style="float: right" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <!-- <th>Reward Point</th> -->
                <th>Subcategories</th>
                <th>Parent</th>
                <th>Featured</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <!-- <th>Reward Point</th> -->
                <th>Subcategories</th>
                <th>Parent</th>
                <th>Featured</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($categories as $category){ ?>
              <tr>
                <td><?php echo $category->name ?></td>
                <td><img style="height: 50px; width: 50px" src="<?php echo site_url('/public/images/system/categories/'.strtolower(str_replace(' ', '-', $category->name)).'.jpg') ?>"/></td>
                <!-- <td><?php //echo ($category->reward_point) ? $category->reward_point." points" : ''; ?></td> -->
                <td><?php echo count($this->CategoryModel->getSubCategories($category->id)); ?></td>
                <td>
                  <?php echo ($category->parent_id) ? $this->CategoryModel->getCategory($category->parent_id)['name']:'No Parent Category'; ?>
                </td>
                <td>
                  <?php echo ($category->featured == 1) ? '<span class="badge badge-primary">Featured</span>':'<span class="badge badge-danger">Not Featured</span>'; ?>
                </td>
                <td><?php echo $category->created_at; ?></td>
                <td>
									<div class="dropdown">
										<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Options
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a 
												class="btn btn-sm btn-primary dropdown-item" 
												href="<?php echo site_url('/admin/category/view/'.$category->id) ?>"><i class="fas fa-eye"></i> View</a>
											<a 
												class="btn btn-sm btn-warning dropdown-item" 
												href="<?php echo site_url('/admin/category/edit/'.$category->id) ?>"><i class="fa fa-edit"></i> Edit</a>
											<a 
												class="btn btn-sm btn-danger delete_btn dropdown-item" 
												href="<?php echo site_url('/admin/category/delete/'.$category->id) ?>"><i class="fa fa-trash"></i> Delete</a>
										</div>
									</div>
                    
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
