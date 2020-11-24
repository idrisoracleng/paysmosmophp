
<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/buyer/order/my_order') ?>">Orders</a>
      </li>
      <li class="breadcrumb-item active">All Orders</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-shopping-basket"></i>
        All Orders
        <div class="float-right">
          <a class="btn btn-primary btn-sm ml-1" href="<?php echo site_url('admin/order/all_orders') ?>">All Orders</a>
          <a class="btn btn-primary btn-sm ml-1" href="<?php echo site_url('admin/order/closed_orders') ?>">Closed Orders</a>
          <a class="btn btn-primary btn-sm ml-1" href="<?php echo site_url('admin/order/pending_orders') ?>">Pending Orders</a>
          <a class="btn btn-primary btn-sm ml-1" href="<?php echo site_url('admin/order/pending_cooperate') ?>">Pending Organisation Orders</a>
          <a class="btn btn-danger btn-sm ml-1" href="<?php echo site_url('admin/order/canceled_orders') ?>">Canceled Orders</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
              <?php if(count($orders) == 0){ ?>
                <p class="alert alert-warning">You Don't Have Any Order Now</p>
              <?php }else{ ?>
                <div class="table-responsive">
                  <div class="col-md-12 text-center">
                    <span title="Orders that have been delivered" class="badge p-1 badge-success">Completed Order</span>
                    <span title="Order that are canceled either by the admin, cooperative admin or a user" class="badge p-1 badge-danger">Canceled Order</span>
                    <span title="Completed orders that are awaiting delivery" class="badge p-1 badge-info">Awaiting Delivery</span>
                    <span title="Orders that are awaiting an action from either the admin, user or a cooperative admin" class="badge p-1 badge-warning">Awaiting an Action</span>
                  </div>
                  <form id="order_form" action="<?php echo site_url('admin/order/mark_delivered'); ?>" method="POST" msg="Marking orders as delivered...">
                    <table class="table table-hovered" id="orderTable" width="100%">
                      <thead>
                        <tr>
                            <th></th>
                            <th>Order id</th>
                            <th>Order date</th>
                            <th>Order Bill</th>
                            <!-- <th>status</th> -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($orders as $order) { ?>
                          <?php
                            $class = '';
                            if ($order->status == 7) { $class = 'bg-success';}
                            if ($order->status == 0) { $class = 'bg-info';}
                            if ($order->status == 8 || $order->status == 5 || $order->status == 6) { $class = 'bg-danger';}
                            if ($order->status == 2 || $order->status == 3 || $order->status == 4) { $class = 'bg-warning';}
                          ?>
                          <tr>
                            <td class="<?php echo $class; ?> w-10">
                              <input type="checkbox" name="order_ids[]" value="<?php echo $order->order_id; ?>" class="order_id_box"/>
                            </td>
                            <td><?php echo $order->order_id ?></td>
                            <td><?php echo $order->created_at; ?></td>
                            <td><?php echo "₦ ".$this->cart->format_number($order->total_amount); ?></td>
                            <!-- <td>
                              <?php //echo $order->status ?>
                            </td> -->
                            <td>
                              <?php
                                switch($order->status) {
                                  case 1:
                                    echo "Pending ";
                                    break;
                                  case 2:
                                    $coop_name = $this->db->get_where('cooperatives', ['cooperative_id' => $order->isCooperative])->row();
                                    if ($coop_name) $cop_name = $coop_name->name;
                                    else $coop_name = "";
                                    //($coop_name['name'])?$coop_name['name']:''
                                    echo "Awaiting ".$cop_name." Cooperative Admin Approval";
                                    break;
                                  case 3:
                                    echo "Awaiting Remita Approval. Ask buyer to take Remita from to the bank for approval";
                                    break;
                                  case 4:
                                    echo "Awaiting Your Final Approval";
                                    break;
                                  case 5:
                                    echo "Order cancelled by buyer";
                                    break;
                                  case 6:
                                    echo "Order cancelled by Cooperative";
                                    break;
                                  case 8:
                                    echo "Order Cancelled By Admin";
                                    break;
                                  case 7:
                                    echo "Order have been delivered";
                                    break;
                                  default:
                                    echo "Order have been delivered and closed";
                                }
                              ?>
                            </td>
                            <td>
                              <a class="fa fa-eye btn btn-sm btn-primary" href="<?php echo site_url('admin/order/view_order/'.$order->order_id)?>"></a>
                              <?php if ($order->status == 4) { ?>
                                <!--<a 
                                  class="btn btn-sm btn-primary slink" 
                                  msg="Do you want to approve this order?"
                                  href="<?php echo site_url('admin/order/approve/'.$order->order_id)?>"> Approve</a>-->
                              <?php } ?>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <button type="submit" class="btn btn-success btn-sm" id="mark_delivered_btn">Mark Delivered</button>
                  </form>
                </div>
              <?php } ?>
          </div>
        </div>
      </div>
      
    </div>

  </div>

  <script>
    $(document).ready(function(){
      // $('#mark_delivered_btn').click(function() {
      //   $("#order_form").submit();
      //   // var totalChecked = 0;
      //   // $('.order_id_box').foreach((_) => {
      //   //   if (_.attr('checked') == true) {
      //   //     totalChecked += 1;
      //   //   }
      //   // })
      //   // alert(totalChecked);
      // });
      // $(".order_id_box").click(function() {
      //   $('.order_id_box').foreach((_) => {
      //     // if (_.att)
      //   })
      // });
    });
  </script>
