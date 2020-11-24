<?php $userDetail = $this->db->get_where('users', ['user_id' => $order->buyer_id])->row(); ?>

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
      <li class="breadcrumb-item active">Orders #<?php echo $order->order_id ?></li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        	<button class="btn btn-primary btn-sm back-btn"><i class="fas fa-arrow-left"></i> back</button>
					<i class="fas fa-shopping-basket"></i>
          Order #<?php echo $order->order_id ?> Item For <?php 
		  //$nam = $this->db->get_where('users', ['user_id' => $order->buyer_id])->row();isCooperative
		  $coop_name = $this->db->get_where('cooperatives', ['cooperative_id' => $order->isCooperative])->row();
		  echo $order->full_name; //($nam)?$nam->full_name:""; ?>
		  <div class="row">
			<div class="col-md-12">
   
				<b> Name:</b>  <?php echo $order->full_name; ?> <b> Email:</b>  <?php echo $userDetail->email; ?> <b> Phone: </b> <?php echo $order->phone_number; ?> <b> Date :</b>  <?php echo $order->created_at; ?><br/>
				<b> Delivery type:</b>  <?php echo $order->delivery_type; ?>  <?php if ($coop_name) echo  "<b> Org: </b>".$coop_name->name; ?> <br/>
				<b> Address:</b>  <?php echo $order->shipping_address; ?> 
			</div>
		  </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
		  <?php //print_r($order); ?>
              <table class="table table-bordered" id="dataTable1" width="100%">
                  <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <!-- <th>Status</th> -->
                          <th>Subtotal</th>
                      </tr>
                  </thead>
                  <tbody>
										<?php $total = 0;
										
											foreach (unserialize($order->order_detail) as $key => $orderItem) {  ?>
												<tr>
													<td><?php echo hex2bin($orderItem['name'])? hex2bin($orderItem['name']): ""; ?></td>
													<td><?php echo $orderItem['qty']; ?></td>
													<td><?php echo '₦ '.$this->cart->format_number($orderItem['price']); ?></td>
													<td><?php echo '₦ '.$this->cart->format_number($orderItem['price'] * $orderItem['qty']); ?></td>
												</tr>
                      <?php $total += ($orderItem['price'] * $orderItem['qty']); 
					  
					  
					  } ?>
					  <tr>
                        <td colspan="3"></td><td><b>----------------</b></td>
                      </tr>
                      <tr>
                        <td colspan="3">Shipping Fee</td>
                        <td colspan="1">₦ <?php $total+=$order->shipping_fee;
						echo $this->cart->format_number($order->shipping_fee); ?></td>
                      </tr>
                      <tr>
                        <td colspan="3">Total Amount</td>
                        <td colspan="1">₦ <?php echo $this->cart->format_number($total); ?></td>
                      </tr>
					  <?php if ($order->coupon_price != '') { ?>
						 <tr>
							<td colspan="3">
								Coupon Price
							</td>
							<td colspan="1">
								<span class="woocommerce-Price-currencySymbol"> ₦</span><?php echo $this->cart->format_number(($order->coupon_price)); ?>
							</td>
						</tr>
					<?php } ?>
                      <tr>
                        <td colspan="3">Amount to be paid Monthly</td>
                        <td colspan="1">₦ <?php echo $this->cart->format_number($total/4).' / Monthly'; ?></td>
                      </tr>
                  </tbody>
              </table>
              <?php if ($order->status == 4) { ?>
                <form class="form" action="<?php echo site_url('admin/order/decline/'.$order->order_id); ?>" msg="Declining Order...">
                  <div class="form-group">
                    <textarea class="form-control" name="msg" placeholder="Enter reason for declining"></textarea>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-sm btn-danger">Decline</button>
                  </div>
                </form>
                <a 
                  class="btn btn-sm btn-primary slink" 
                  msg="Do you want to approve this order?"
                  href="<?php echo site_url('admin/order/approve/'.$order->order_id)?>"> Approve</a>
              <?php } ?>
          </div>
        </div>
      </div>
      
    </div>

  </div>

  <script>
    $(document).ready(function(){
    //   // alert("We are almost done here");
    //   var oldqty = $("#oldqty");
    //   var newqty = $("#newqty");

    //   var oldoto = $("#oldoto");
    //   var newoto = $("#newoto");

    //   oldqty.keyup(function(){
    //     newqty.val($(this).val());
    //   });

    //   oldoto.keyup(function(){
    //     newoto.val($(this).val());
    //   });
    });
  </script>
