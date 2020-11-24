

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/menus') ?>">Menu</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-product"></i>
        All Menu <a href="#" style="float: right" data-toggle="modal" data-target="#newMenu" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" style="width:100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Url</th>
                <th>Sub Menus</th>
                <th>Accessor</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Url</th>
                <th>Sub Menus</th>
                <th>Accessor</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach($menues as $menu){ ?>
              <tr>
                <td><?php echo $menu->name ?></td>
                <td><?php echo character_limiter($menu->url, 60); ?></td>
                <td><?php echo count($this->db->where('menu_id', $menu->id)->get('submenu')->result()); ?></td>
                <td><?php echo $menu->acct_type; ?></td>
                <td><?php echo $menu->created_at; ?></td>
                <td>
                    
                    <div class="dropdown">
												<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Options
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="btn btn-sm btn-primary dropdown-item" data-toggle="modal" data-target="#newSubMenu" href="#"><i class="fas fa-plus"></i></a>
													<a class="btn btn-sm btn-warning dropdown-item" href="<?php echo site_url('/admin/settings/menus/view/'.$menu->id) ?>"><i class="fas fa-eye"></i></a>
													<a class="btn btn-sm btn-warning edit_btn dropdown-item" href="<?php echo site_url('/admin/settings/menus/edit/'.$menu->id) ?>"><i class="fa fa-edit"></i></a>
												</div>
											</div>
										<!--
                    <a class="btn btn-sm btn-danger delete_btn" href="<?php //echo site_url('/admin/menu/delete/'.$menu->id) ?>"><i class="fa fa-trash"></i></a>-->
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
