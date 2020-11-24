

<div class="container mt-5 mb-5">

<div class="row">
    
        <?php $this->load->view('layouts/buyer/side_bar', array('active' => 'home')) ?>
    
    

    <div class="col-lg-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <!-- <h1>Home</h1> -->
                <div class="row">
                    <a
                    class="col-md-3 card nav-link" href="<?php echo site_url('buyer/cart/my_cart'); ?>" role="tab" aria-controls="v-pills-carts" aria-selected="false">
                        <div class="card-body text-center">
                            <i class="fa fa-3x fa-shopping-cart"></i>
                            <h4>Carts</h4>
                        </div>
                    </a>

                    <a
                    class="col-md-3 card nav-link" href="<?php echo site_url('buyer/orders/my_orders'); ?>" role="tab" aria-controls="v-pills-orders" aria-selected="false">
                        <div class="card-body text-center">
                            <i class="fa fa-3x fa-shopping-cart"></i>
                            <h4>Orders</h4>
                        </div>
                    </a>

                    <a
                    class="col-md-3 card nav-link" href="<?php echo site_url('buyer/profile/view_profile'); ?>" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <div class="card-body text-center">
                            <i class="fa fa-3x fa-user"></i>
                            <h4>Profile</h4>
                        </div>
                    </a>

                    <a
                    class="col-md-3 card nav-link" href="<?php echo site_url('buyer/profile/edit_profile'); ?>" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <div class="card-body text-center">
                            <i class="fa fa-3x fa-cogs"></i>
                            <h4>Settings</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
</div>