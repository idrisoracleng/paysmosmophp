

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/header_menu') ?>">Menu</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-product"></i>
        All Header Menu <a href="#" style="float: right" data-toggle="modal" data-target="#newHeaderMenu" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="table-responsive" style="width: 100% !important;">
          <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Url</th>
                <th>Sub Header Menu</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Url</th>
                <th>Sub Header Menu</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <?php if ($header_menu) { ?>
                <?php foreach($header_menu as $menu){ ?>
                <tr>
                    <td><?php echo $menu->name ?></td>
                    <td><?php echo character_limiter($menu->url, 60); ?></td>
                    <td><?php echo count($this->db->where('parent_id', $menu->id)->get('header_menu')->result()); ?></td>
                    <td><?php echo $menu->created_at; ?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newHeaderSubMenu" href="#"><i class="fas fa-plus"></i></a>
                        <a class="btn btn-sm btn-warning" href="<?php echo site_url('/admin/settings/header_menu/view/'.$menu->id) ?>"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-sm btn-warning edit_btn" href="<?php echo site_url('/admin/settings/header_menu/edit/'.$menu->id) ?>"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger delete_btn" href="<?php echo site_url('/admin/settings/header_menu/delete/'.$menu->id) ?>"><i class="fa fa-trash"></i></a>
                        <!--
                        <a class="btn btn-sm btn-danger delete_btn" href="<?php //echo site_url('/admin/menu/delete/'.$menu->id) ?>"><i class="fa fa-trash"></i></a>-->
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <div class="alert alert-info">
                    No Header Menu Created
                </div>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>

  </div>
