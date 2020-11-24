
<?php
    // $product_rating = $this->db->query("SELECT * FROM product_rating WHERE product_id = '".$product['product_id']."'")->result_array();
    // $avg_rating = $this->db->where('product_id', $product['product_id'])->select('AVG(rate) as avg_rating')->from('product_rating')->get()->row()->avg_rating;
    // $subcategories = $this->db->where('category_id', $category['id'])->get('sub_category')->result();
    $sellerOrders = $this->db->get_where('seller_order', ['buyer_id' => $sellerData['user_id']])->result_array();
    $sellerContact = $this->db->get_where('contacts', ['user_id' => $sellerData['user_id']])->row_array();
    $sellerCredentials = $this->db->get_where('credentials', ['user_id' => $sellerData['user_id']])->result_array();
    $sellerBankDetail = $this->db->get_where('bank_account_info', ['user_id' => $sellerData['user_id']])->result_array();
    $sellerProducts = $this->db->get_where('products', ['owner_id' => $sellerData['user_id']])->result_array();
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
        <a href="<?php echo site_url('/admin/seller') ?>">All Seller</a>
      </li>
      <li class="breadcrumb-item active">#<?php echo $sellerData['id'] ?></li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <a class="fa fa-arrow-alt-circle-left back-btn" href="">back</a>
        <i class="fas fa-product"></i>
        <?php echo $sellerData['full_name'] ?>
        <div style="float: right">
          <a href="<?php echo site_url('/admin/seller/create') ?>" class="btn btn-sm btn-primary"> <span class="fa fa-plus"></span> New</a> &nbsp;
          <a href="<?php echo site_url('/admin/seller/edit/'.$sellerData['id']) ?>" class="btn btn-sm btn-primary"> <span class="fa fa-edit"></span> Edit</a>
          <a class="btn btn-sm btn-danger fa fa-trash-alt delete_btn" href="<?php echo site_url('/admin/seller/delete/'.$sellerData['id']) ?>"> Delete</a>
        </div>
        
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div>
              <h4><?php echo $sellerData['full_name'] ?></h4>
              <hr/>
              <div class="text-center">
                <img class="img-thumbnail" src="<?php echo $sellerData['image'] ?>"/>
              </div>
              <p>
                <?php echo $sellerData['about'] ?>
              </p>
            </div>
          </div>
          <div class="col-md-9">


          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="true">Details</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false">Orders <span class="badge badge-primary"><?php echo count($sellerOrders); ?></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
            </li>
            <?php $userAccounts = (array) explode(',', $sellerData['acct_type']); ?>
            <?php if (in_array('seller', $userAccounts)) { ?>
                <li class="nav-item">
                    <a class="nav-link" id="credentials-tab" data-toggle="tab" href="#credentials" role="tab" aria-controls="credentials" aria-selected="false">Credentials</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="bank-detail-tab" data-toggle="tab" href="#bank-detail" role="tab" aria-controls="bank-detail" aria-selected="false">Bank Detail</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Products</a>
                </li>
            <?php } ?>
            
          </ul>
          <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
              
              <div class="container">
                <h6>Personal Information<hr/></h6>
                
                <p>Full Name: <?php echo $sellerData['full_name'] ?></p>
                <p>Email: <?php echo $sellerData['email'] ?></p>
                <p>Joined since <?php echo $sellerData['created_at'] ?></p>
              </div>


              <div class="container">
                <h6>Contact Information<hr/></h6>
                
                <p>Phone Number: <?php echo $sellerContact['phone_number'] ?></p>
                <p>Email: <?php echo $sellerContact['email'] ?></p>
                <p>Address: <?php echo $sellerContact['address'] ?></p>
                <p>Billing Address: <?php echo $sellerContact['billing_address'] ?></p>
              </div>

            </div>
            <!-- Sub Category Ends Here -->
            <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
              <?php if (count($sellerOrders) == 0) { ?>
                <div class="alert alert-info">
                    <?php echo $sellerData['full_name'] . ' has not make any order'; ?>
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
                        <?php foreach ($sellerOrders as $key => $userOrder) { ?>
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
                    <h6>About <?php echo $sellerData['full_name'] ?><hr/></h6>
                    <blockquote>
                        <?php echo $sellerData['about']; ?>
                    </blockquote>
                </div>
            </div>

            <div class="tab-pane fade" id="credentials" role="tabpanel" aria-labelledby="credentials-tab">
                <div class="container">
                    <h6><?php echo $sellerData['full_name']."'s Credentials" ?><hr/></h6>
                    <?php if ($sellerCredentials) { ?>
                        <ul class="list-group">
                            <?php foreach ($sellerCredentials as $key => $sellerCredential) { ?>
                                <li class="list-group-item"><?php echo $sellerCredential['credential_name'] ?></li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <div class="alert alert-info text-center">
                            <?php echo $sellerData['full_name']." have not submit any credentials"; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <div class="tab-pane fade" id="bank-detail" role="tabpanel" aria-labelledby="bank-detail-tab">
                <div class="container">
                    <h6><?php echo $sellerData['full_name']."'s Bank Account Info" ?><hr/></h6>
                    <?php if ($sellerBankDetail) { ?>
                      <ul class="list-group">
                        <?php foreach ($sellerBankDetail as $key => $bankDetail) { ?>
                          <div class="list-group-item">
                            <span><?php echo ucwords($bankDetail['bank_name']); ?></span>
                            <span><?php echo ucwords($bankDetail['bank_account_name']); ?></span> &nbsp;&nbsp;
                            <span><?php echo $bankDetail['bank_account_number']; ?></span> &nbsp;&nbsp;
                          </div>
                        <?php } ?>
                      </ul>
                    <?php } else { ?>
                      <div class="alert alert-info text-center">
                        <?php echo $sellerData['full_name']." do not have a bank account detail!"; ?>
                      </div>
                    <?php } ?>
                </div>
            </div>

            <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
              <div class="container">
                <h6><?php echo $sellerData['full_name']."'s Product List" ?><hr/></h6>
                <?php if ($sellerProducts) { ?>
                  <div class="row">
                    <?php foreach ($sellerProducts as $key => $product) { ?>
                      <div class="col-md-2">
                        <p><?php echo ucwords($product['name']); ?></p>
                        <p><?php echo ucwords($product['price']); ?></p>
                        <p><?php echo $product['short_description']; ?></p>
                        <a href="<?php echo site_url('admin/product/view/'.$product['code']); ?>" class="fas fas-eye btn btn-primary btn-sm"> View</a>
                      </div>
                    <?php } ?>
                  </div>
                <?php } else { ?>
                  <div class="alert alert-info text-center">
                    <?php echo $sellerData['full_name']." do not have any product posted!"; ?>
                  </div>
                <?php } ?>
              </div>
            </div>
            
          </div>

        </div>
      </div>
    </div>

  </div>
