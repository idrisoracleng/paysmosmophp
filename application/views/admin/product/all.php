<div id="wrapper">

  <!-- Sidebar -->
  <?php include APPPATH . '/views/layouts/admin/side_nav.php' ?>

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
          All Products <a href="<?php echo site_url('/admin/product/create') ?>" style="float: right" class="btn btn-sm btn-primary">New <span class="fa fa-plus"></span></a></div>
        <div class="card-body">
          <?php
          $this->load->view('layouts/admin/live_searcher', [
            'url' => site_url('admin/product/live_search'),
            'page' => 'all_product',
            'search_params' => ['name', 'category', 'brand', 'price']
          ]);
          ?>
          <?php echo $this->pagination->create_links(); ?>
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0" url="<?php echo site_url('admin/get_json_data/products'); ?>">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <!-- <th>Owner</th> -->
                  <th>Code</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Views</th>
                  <th>Rating</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <!-- <th>Owner</th> -->
                  <th>Code</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Views</th>
                  <th>Rating</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody id="live_search_result">
                <?php foreach ($products as $product) { ?>
                  <?php $variants = $this->db->order_by('price', 'ASC')->get_where('variants', ['product_id' => $product['product_id']])->result(); ?>
                  <tr>
                    <td><?php echo character_limiter($product['name'], 10) ?></td>
                    <td><img style="height: 50px; width: 50px" src="<?php echo site_url('/public/images/products/' . $product['code'] . '/01.jpg') ?>" /></td>
                    <!-- <td><?php //echo $this->UserModel->getUserBy('user_id', $product['owner_id'])['full_name']; 
                              ?></td> -->
                    <td><?php echo $product['code']; ?></td>
                    <td><?php echo $this->db->get_where('category', ['id' => $product['category_id']])->row()->name; ?></td>
                    <td>
                      <?php echo ($variants && $variants[0]->price !== '') ? $this->cart->format_number($variants[0]->price) : $this->cart->format_number($product['price']) ?>
                    </td>
                    <td><?php echo $product['views'] ?></td>
                    <td><?php echo count($this->db->where('product_id', $product['product_id'])->get('product_rating')->result()); ?></td>
                    <td><?php echo $product['created_at']; ?></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Options
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="btn btn-sm dropdown-item btn-primary" href="<?php echo site_url('/admin/product/view/' . $product['code']) ?>" title="View Product"><i class="fas fa-eye"></i> View</a>
                          <?php if ($product['status'] == 'pending') { ?>
                            <a class="btn btn-sm dropdown-item btn-secondary slink" msg="Do you want to approve <?php echo $product['name']; ?>?" href="<?php echo site_url("/admin/product/approve/" . $product['code']) ?>" title="Approve Product"><i class="fa fa-bolt"></i> Approve</a>
                          <?php } ?>
                          <?php if ($product['status'] == 'approved') { ?>
                            <a class="btn btn-sm dropdown-item btn-warning slink" msg="Do you want to unapprove <?php echo $product['name']; ?>?" href="<?php echo site_url("/admin/product/unapprove/" . $product['code']) ?>" title="Disapprove Product"><i class="fas fa-window-close"></i> Disapprove</a>
                          <?php } ?>
                          <?php //if ($this->session->userdata('user')->user_id == $product['owner_id']) { ?>
                            <a class="btn btn-sm dropdown-item btn-warning" href="<?php echo site_url("/admin/product/edit/" . $product['code']) ?>" title="Edit Product"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn btn-sm dropdown-item btn-info" href="<?php echo site_url("/admin/product/clone/" . $product['code']) ?>" title="Clone Product"><i class="fas fa-copy"></i> Clone</a>
                          <?php //} ?>
                          <a class="btn btn-sm dropdown-item btn-danger delete_btn" href="<?php echo site_url("/admin/product/delete/" . $product['code']) ?>" title="Delete Product"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>