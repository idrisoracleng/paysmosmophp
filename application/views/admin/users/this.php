
<?php
    // $product_rating = $this->db->query("SELECT * FROM product_rating WHERE product_id = '".$product['product_id']."'")->result_array();
    // $avg_rating = $this->db->where('product_id', $product['product_id'])->select('AVG(rate) as avg_rating')->from('product_rating')->get()->row()->avg_rating;
    // $subcategories = $this->db->where('category_id', $category['id'])->get('sub_category')->result();
    $userOrders = $this->db->get_where('seller_order', ['buyer_id' => $userData['user_id']])->result_array();
    $userContact = $this->db->get_where('contacts', ['user_id' => $userData['user_id']])->row_array();
    // $seller_rating = $this->db->query("SELECT * FROM seller_rating WHERE seller_id = '".$product['user_id']."'")->result_array();
?>
  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/user') ?>">All Users</a>
      </li>
      <li class="breadcrumb-item active">#<?php echo $userData['user_id'] ?></li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fa fa-arrow-alt-circle-left back-btn" href="">back</a>
        <i class="fas fa-product"></i>
        <?php echo $userData['full_name'] ?>
        <div style="float: right">
          <a href="<?php echo site_url('/admin/user/create') ?>" class="btn btn-sm btn-primary"> <span class="fa fa-plus"></span> New</a> &nbsp;
          <a href="<?php echo site_url('/admin/user/edit/'.$userData['user_id']) ?>" class="btn btn-sm btn-primary"> <span class="fa fa-edit"></span> Edit</a>
          <a class="btn btn-sm btn-danger fa fa-trash-alt delete_btn" href="<?php echo site_url('/admin/user/delete/'.$userData['user_id']) ?>"> Delete</a>
        </div>
        
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div>
              <h4><?php echo $userData['full_name'] ?></h4>
              <hr/>
              <div class="text-center">
                <img class="img-thumbnail" src="<?php echo $userData['image'] ?>"/>
              </div>
              <p>
                <?php echo $userData['about'] ?>
              </p>
            </div>
          </div>
          <div class="col-md-9">


          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="true">Details</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false">Orders <span class="badge badge-primary"><?php echo count($userOrders); ?></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
            </li>
            <?php if ($userData['cooperative_id'] == 'no_cooperative') { ?>
              <li class="nav-item">
                <a class="nav-link" id="credentials-tab" data-toggle="tab" href="#credentials" role="tab" aria-controls="credentials" aria-selected="false">Credentials</a>
              </li>
            <?php } ?>
          </ul>
          <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
              
              <div class="container">
                  <h6>Personal Information<hr/></h6>
                  
                  <p>Full Name: <?php echo $userData['full_name'] ?></p>
                  <p>Email: <?php echo $userData['email'] ?></p>
                  <p>Joined since <?php echo $userData['created_at'] ?></p>
              </div>

              <div class="container">
                  <h6>Contact Information<hr/></h6>
                  
                  <p>Phone Number: <?php echo $userContact['phone_number'] ?></p>
                  <p>Email: <?php echo $userContact['email'] ?></p>
                  <p>Address: <?php echo $userContact['address'] ?></p>
                  <p>Billing Address: <?php echo $userContact['billing_address'] ?></p>
              </div>


            </div>
            <!-- Sub Category Ends Here -->
            <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
              <?php if (count($userOrders) == 0) { ?>
                <div class="alert alert-info">
                    <?php echo $userData['full_name'] . ' has not make any order'; ?>
                </div>
              <?php } else { ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>quantity</th>
                            <th>price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userOrders as $key => $userOrder) { ?>
                            <tr>
                                <td><?php echo $userOrder['ordered_product_name'] ?></td>
                                <td><?php echo $userOrder['ordered_product_qty'] ?></td>
                                <td><?php echo $userOrder['ordered_product_price'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
              <?php } ?>
            </div>

            <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
              <div class="container">
                <h6>About <?php echo $userData['full_name'] ?><hr/></h6>
                <blockquote>
                    <?php echo $userData['about']; ?>
                </blockquote>
              </div>
            </div>

            <?php if ($userData['cooperative_id'] == 'no_cooperative') { ?>
              <div class="tab-pane fade" id="credentials" role="tabpanel" aria-labelledby="credentials-tab">
                <div class="container">
                  <h6><?php echo $userData['full_name'] ?> Credentials<hr/></h6>
                  <p>
                    <?php if (substr($userData['bank_statement_path'], 1, 6) == 'public'): ?>
                    <a target="_blank"  href="<?php echo site_url($userData['bank_statement_path']); ?>" title="Bank Statement">Bank Statement</a>
                    <?php else: echo 'No Bank Statement have been submitted'; endif;?>
                  </p>
                  <p>
                    <?php if (substr($userData['id_card_path'], 1, 6) == 'public'): ?>
                    <a target="__blank" class="links" href="<?php echo site_url($userData['id_card_path']); ?>" title="ID Card">ID card</a>
                    <?php else: echo 'No ID Card have been submitted'; endif;?>
                  </p>
                  <!-- <div>
                    <h4>Id Card</h4>
                  </div>
                  <div>
                    <h4>Bank Statement Card</h4>
                  </div> -->
                </div>
              </div>
            <?php } ?>
          </div>

        </div>
      </div>
    </div>

  </div>



<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="content">
        <span class="fa fa-spinner fa-spin"></span>&nbsp;Loading...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    $('.links').click(function(e) {
      e.preventDefault();
      var contentHouse = $("#content");
      var link = $(this).attr('href');
      var title = $(this).attr('title');
      var titleHouse = $("#exampleModalLongTitle");
      // alert(title);
      contentHouse.html('<span class="fa fa-spinner fa-spin"></span>&nbsp;Loading...');
      titleHouse.text(title);
      $("#exampleModalLong").modal('show');
      if (title == 'ID Card') {
        // alert('It is an image');
        // alert(link);
        var img = "<img src='"+link+"' />";
        contentHouse.html(img);
      } else if (title == 'Bank Statement') {
        contentHouse.load(link);
      }
    });
  });
</script>