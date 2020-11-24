<?php $orders = $this->UserModel->getUserOrders()->collections; ?>

<div class="container mt-5 mb-5">
 
  <?php //$this->load->view('layouts/buyer/top_nav.php', array('title' => 'My Orders')); ?>
  


  
  
  <div class="row">
    <?php //var_dump($orders); ?>
      <style>
        .nav-link.active {
          color: black !important;
          background: whitesmoke !important;
        }
      </style>

     <?php $this->load->view('layouts/buyer/side_bar', array('active' => 'orders')); ?>

      <div class="col-lg-10">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
              <!-- <h4 class="text-dark font-weight-bold">My Orders</h4> -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a style="color: dodgerblue !important;" class="nav-link active text-primary" id="all-order-tab" data-toggle="tab" href="#all-order" role="tab" aria-controls="all-order" aria-selected="true">All Order</a>
                </li>
                <li class="nav-item">
                  <a style="color: dodgerblue !important;" class="nav-link text-primary" id="active-order-tab" data-toggle="tab" href="#active-order" role="tab" aria-controls="active-order" aria-selected="true">Active Order</a>
                </li>
                <li class="nav-item">
                  <a style="color: dodgerblue !important;" class="nav-link text-primary" id="pending-order-tab" data-toggle="tab" href="#pending-order" role="tab" aria-controls="pending-order" aria-selected="false">Pending Order</a>
                </li>
                <li class="nav-item">
                  <a style="color: dodgerblue !important;" class="nav-link text-primary" id="canceled-order-tab" data-toggle="tab" href="#canceled-order" role="tab" aria-controls="canceled-order" aria-selected="false">Canceled Order</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="active-order" role="tabpanel" aria-labelledby="active-order-tab">
                  <?php if(count($orders) == 0){ ?>
                    <p class="alert alert-warning text-center">You Don't Have Any Order. Go to <a href="<?php echo site_url('/market'); ?>">Market</a> to Order Now</p>
                    <?php }else{ ?>
                    <table class="shop_table shop_table_responsive cart">
                        <thead>
                            <tr>
															<th>Id</th>
                              <th>Bill</th>
                              <th>Status</th>
                              <th>Ordered Date</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $active = 0; foreach($orders as $order) { ?>
                            <?php if ($order->status == 0) { $active++; ?>
                              <tr>
                                  <td>
                                    <a href="<?php echo site_url('buyer/orders/view_order/'.$order->order_id) ?>"><?php echo $order->order_id ?></a>
                                  </td>
                                  <td><?php echo $this->cart->format_number($order->total_amount); ?></td>
																	<td><?php echo $this->orderModel->getOrderStatusMessage(['status' => $order->status, 'cooperative_id' => $order->isCooperative]); ?></td>
                                  <td><?php echo date('jS F Y g:ia', strtotime($order->created_at)); ?></td>
                                  <td>
                                    <?php if ($order->status != 5 && $order->status != 6 && $order->status != 0 && $order->status != 8) { ?>
                                      <a class="btn btn-sm btn-danger" href="<?php echo site_url('buyer/orders/cancel/'.$order->id); ?>">Cancel</a>
                                    <?php } else if ($order->status == 0) { ?>
                                      <a class="badge badge-success text-light p-2 font-weight-light"><i class="fa fa-check"></i></a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('buyer/orders/view_order/'.$order->order_id);?>" class="btn btn-primary btn-sm" title="View order detail"><i class="fa fa-list"></i></a>
                                  </td>
                              </tr>
                            <?php } ?>
                          <?php } ?>
                        </tbody>
                    </table>
                    <?php if($active == 0){ ?>
                      <p class="alert alert-warning text-center">You Don't Have Any Active Order</p>
                    <?php }?>
                  <?php } ?>
                </div>
                <div class="tab-pane fade" id="pending-order" role="tabpanel" aria-labelledby="pending-order-tab">
                  <?php if(count($orders) == 0){ ?>
                    <p class="alert alert-warning text-center">You Don't Have Any Order. Go to <a href="<?php echo site_url('/market'); ?>">Market</a> to Order Now</p>
                    <?php }else{ ?>
                      <table class="shop_table shop_table_responsive cart">
                        <thead>
                            <tr>
															<th>Id</th>
                              <th>Bill</th>
                              <th>Status</th>
                              <th>Ordered Date</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $pending = 0; foreach($orders as $order) { ?>
                            <?php if ($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4) { $pending++; ?>
                              <tr>
                                  <td>
                                    <a href="<?php echo site_url('buyer/orders/view_order/'.$order->order_id) ?>"><?php echo $order->order_id ?></a>
                                  </td>
                                  <td><?php echo $this->cart->format_number($order->total_amount); ?></td>
																	<td><?php echo $this->orderModel->getOrderStatusMessage(['status' => $order->status, 'cooperative_id' => $order->isCooperative]); ?></td>
                                  <td><?php echo date('jS F Y g:ia', strtotime($order->created_at)); ?></td>
                                  <td>
                                    <?php if ($order->status != 5 && $order->status != 6 && $order->status != 0 && $order->status != 8) { ?>
                                      <a class="btn btn-sm btn-danger" href="<?php echo site_url('buyer/orders/cancel/'.$order->id); ?>">Cancel</a>
                                    <?php } else if ($order->status == 0) { ?>
                                      <a class="badge badge-success text-light p-2 font-weight-light"><i class="fa fa-check"></i></a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('buyer/orders/view_order/'.$order->order_id);?>" class="btn btn-primary btn-sm" title="View order detail"><i class="fa fa-list"></i></a>
                                  </td>
                              </tr>
                            <?php } ?>
                          <?php } ?>
                        </tbody>
                      </table>
                    <?php if($pending == 0){ ?>
                      <p class="alert alert-warning text-center">You Don't Have Any Pending Order</p>
                    <?php }?>
                  <?php } ?>
                </div>
                <div class="tab-pane fade" id="canceled-order" role="tabpanel" aria-labelledby="canceled-order-tab">
                  <?php if(count($orders) == 0){ ?>
                    <p class="alert alert-warning text-center">You Don't Have Any Order. Go to <a href="<?php echo site_url('/market'); ?>">Market</a> to Order Now</p>
                    <?php }else{ ?>
                      <table class="shop_table shop_table_responsive cart">
                        <thead>
                            <tr>
															<th>Id</th>
                              <th>Bill</th>
                              <th>Status</th>
                              <th>Ordered Date</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $canceled = 0; foreach($orders as $order) { ?>
                            <?php if ($order->status == 5 || $order->status == 6 || $order->status == 7 || $order->status == 8) { $canceled++; ?>
                              <tr>
                                  <td>
                                    <a href="<?php echo site_url('buyer/orders/view_order/'.$order->order_id) ?>"><?php echo $order->order_id ?></a>
                                  </td>
                                  <td><?php echo $this->cart->format_number($order->total_amount); ?></td>
																	<td><?php echo $this->orderModel->getOrderStatusMessage(['status' => $order->status, 'cooperative_id' => $order->isCooperative]); ?></td>
                                  <td><?php echo date('jS F Y g:ia', strtotime($order->created_at)); ?></td>
                                  <td>
                                    <?php if ($order->status != 5 && $order->status != 6 && $order->status != 0 && $order->status != 8) { ?>
                                      <a class="btn btn-sm btn-danger" href="<?php echo site_url('buyer/orders/cancel/'.$order->id); ?>">Cancel</a>
                                    <?php } else if ($order->status == 0) { ?>
                                      <a class="badge badge-success text-light p-2 font-weight-light"><i class="fa fa-check"></i></a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('buyer/orders/view_order/'.$order->order_id);?>" class="btn btn-primary btn-sm" title="View order detail"><i class="fa fa-list"></i></a>
                                  </td>
                              </tr>
                            <?php } ?>
                          <?php } ?>
                        </tbody>
                      </table>
                    <?php if($canceled == 0){ ?>
                      <p class="alert alert-warning text-center">You Don't Have Any Canceled Order</p>
                    <?php }?>
                  <?php } ?>
                </div>
                <div class="tab-pane fade show active" id="all-order" role="tabpanel" aria-labelledby="all-order-tab">
                  <?php if(count($orders) == 0){ ?>
                      <p class="alert alert-warning text-center">You Don't Have Any Order. Go to <a href="<?php echo site_url('/market'); ?>">Market</a> to Order Now</p>
                    <?php }else{ ?>
                      <table class="shop_table shop_table_responsive cart">
                        <thead>
                            <tr>
															<th>Id</th>
                              <th>Bill</th>
                              <th>Status</th>
                              <th>Ordered Date</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $active = 0; foreach($orders as $order) { ?>
                            <tr>
                                <td>
                                  <a href="<?php echo site_url('buyer/orders/view_order/'.$order->order_id) ?>"><?php echo $order->order_id ?></a>
                                </td>
                                <td><?php echo $this->cart->format_number($order->total_amount); ?></td>
                                <td><?php echo $this->orderModel->getOrderStatusMessage(['status' => $order->status, 'cooperative_id' => $order->isCooperative]); ?></td>
                                <td><?php echo date('jS F Y g:ia', strtotime($order->created_at)); ?></td>
                                <td>
                                  <?php if ($order->status != 5 && $order->status != 6 && $order->status != 0 && $order->status != 8) { ?>
                                    <a class="btn btn-sm btn-danger" href="<?php echo site_url('buyer/orders/cancel/'.$order->id); ?>">Cancel</a>
                                  <?php } else if ($order->status == 0) { ?>
                                    <a class="badge badge-success text-light p-2 font-weight-light"><i class="fa fa-check"></i></a>
                                  <?php } ?>
                                  <a href="<?php echo site_url('buyer/orders/view_order/'.$order->order_id);?>" class="btn btn-primary btn-sm" title="View order detail"><i class="fa fa-list"></i></a>
                                </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                  <?php } ?>
                </div>
              </div>
          </div>
        </div>
      </div>

  </div>
</div>
