

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb shadow">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('admin/product/deals'); ?>">Deals Of The Day</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fas fa-arrow-left back-btn" href="#"> back</a>
        <i class="fas fa-product"></i>
        Add Deals Of The Day <a href="<?php echo site_url('/admin/product/deals') ?>" style="float: right" class="btn btn-sm btn-primary">All <span class="fa fa-product"></span></a></div>
      <div class="card-body">
        <?php $search_params = ['name', 'category', 'brand', 'price'] ?>
        <div id="live_search" class="row">
          <div class="col-md-8">
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group mr-2" role="group" aria-label="First group">
                  <button type="button" class="btn btn-sm btn-info btn-disabled">Search Params</button>
                  </div>
                  <div class="btn-group mr-2" role="group" aria-label="Second group">
                    <?php foreach ($search_params as $key => $value) { ?>
                      <button type="button" class="btn btn-sm btn-secondary key" key="<?php echo $value ?>"><?php echo ucfirst($value); ?></button>
                    <?php } ?>
                  </div>
                  <div class="btn-group" role="group" aria-label="Third group">
                  <button type="button" class="btn btn-sm btn-primary" id="selectedKey"><?php echo $search_params[0]; ?></button>
                </div>
              </div>
          </div>

          <div class="col-md-4">
            <form method="POST" action="<?php echo site_url('admin/product/deals/search') ?>" class="search_form">
              <input id="lsi" name="value" value="" class="form-control" placeholder="Search here..."/>
              <input id="key" name="key" value="name" type="hidden"/>
              <button>Search</button>
            </form>
          </div>
        </div>
        <?php 
          /*$this->load->view('layouts/admin/live_searcher', [
            'url' => site_url('admin/product/live_search'),
            'page' => 'add_deal',
            'search_params' => ['name', 'category', 'brand', 'price']
          ]);*/
        ?>
        <?php echo $this->pagination->create_links(); ?>
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
              <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Price</th>
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
                  <th>Price</th>
                  <th>Deal Price</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Actions</th>
              </tr>
              </tfoot>
              <tbody id="live_search_result">
                  <?php foreach ($products as $product) { ?>
                    <tr>
                      <form action="<?php echo site_url('admin/product/deals/store') ?>" method="post" msg="Adding <?php echo $product['name'] ?> to deals of the day">
                          <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>"/>
                          <td><?php echo $product['name'] ?></td>
                          <td><img style="height: 30px; width: 30px" src="<?php echo site_url('/public/images/products/'.$product['code'].'/01.jpg') ?>"/></td>
                          <td><?php echo $product['price'] ?></td>
                          <td><input type="number" name="deal_price" class="form-control" min="0" value="<?php echo $product['price'] ?>" max="<?php echo $product['price'] ?>"/></td>
                          <td><input type="datetime-local" class="form-control" name="start_time"/></td>
                          <td><input type="datetime-local" class="form-control" name="end_time"/></td>
                          <td><button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add</button></td>
                      </form>
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
