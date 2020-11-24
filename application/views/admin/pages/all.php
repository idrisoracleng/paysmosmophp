
<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/page/all') ?>">Pages</a>
      </li>
      <li class="breadcrumb-item active">#</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a href="#" class="back-btn fas fa-arrow-left"> back</a>
        <i class="fas fa-product"></i>
        All Pages <a href="<?php echo site_url('admin/page/create') ?>" style="float: right" class="btn btn-sm btn-primary"> <span class="fa fa-plus"></span> New</a> &nbsp;
        
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Url</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Url</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($pages as $key => $page){ ?>
              <tr>
                <td><?php echo $page->name ?></td>
                <td><?php echo character_limiter($page->url, 60); ?></td>
                <td><?php echo $page->created_at; ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" href="<?php echo site_url('/admin/page/edit/'.$page->id) ?>"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-sm btn-primary" rel="follow" target="__blank" href="<?php echo $page->url.strtolower(str_replace([' '], ['-'], $page->name)); ?>"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-sm btn-danger delete_btn" href="<?php echo site_url('/admin/page/delete/'.$page->id) ?>"><i class="fa fa-trash"></i></a> 
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
