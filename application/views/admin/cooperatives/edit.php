<div id="wrapper">

  <!-- Sidebar -->
  <?php include APPPATH . '/views/layouts/admin/side_nav.php' ?>

  <div id="content-wrapper">

    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo site_url('/admin/settings/menus') ?>">Cooperatives</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>

      <!-- DataTables Example -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-product"></i>
          <button class="btn btn-sm btn-primary back_btn"><i class="fas fa-arrow-left"></i></button> Edit Cooperative Info <a class="btn btn-sm btn-primary" href="<?php echo site_url('admin/cooperatives/cooperatives') ?>" style="float: right"> All Cooperative <span class="fa fa-plus"></span></a></div>
        <div class="card-body">
          <div class="row justify-content-center">
            <form class="col-md-6 form" msg="Updating Cooperative Data" action="<?php echo site_url('admin/cooperatives/update') ?>" method="POST">
              <div class='form-group'>
                <label>Cooperative Name</label>
                <input type="text" name="name" class="form-control" placeholder="Cooperative Name" required value="<?php echo $cooperative->name; ?>" />
                <input type="hidden" name="cooperative_id" value="<?php echo $cooperative->cooperative_id; ?>" />
              </div>

              <div class='form-group'>
                <label>Cooperative Email</label>
                <input type="email" name="email" class="form-control" placeholder="Cooperative Email" required value="<?php echo $cooperative->email; ?>" />
              </div>

              <div class='form-group'>
                <label>Cooperative Phone Number</label>
                <input type="number" name="phone_number" class="form-control" placeholder="Cooperative Phone Number" required value="<?php echo $cooperative->phone_number; ?>" />
              </div>

              <div class='form-group'>
                <label>Cooperative Password</label>
                <input type="password" name="password" class="form-control" placeholder="Cooperative Admin Password" required value="<?php echo $cooperative->phone_number; ?>" />
              </div>

              <div class='form-group'>
                <button class="btn btn-primary btn-sm">Update Cooperative</button>
              </div>
            </form>
          </div>
        </div>
        <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
      </div>

    </div>