
<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/buyer/orders/order_list') ?>">Orders</a>
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
              <table class="table table-hovered" id="dataTable" width="100%">
                  <thead>
                    <tr>
                        <th>Order id</th>
                        <th>Order date</th>
                          <th>order bill</th>
                        <!-- <th>status</th> -->
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($orders as $order) { ?>
                      <tr>
                          <td><?php echo $order->order_id ?></td>
                        <!--  <td>
                              <?php foreach(unserialize($order->order_detail) as $det){ ?>
                                <?php echo $det['name'].' N'.$det['price'].' | '.$det['qty'];
                                //if(!$det['options']['sorted']) 
                                  //echo '<a class="fas fa-sort-up btn btn-sm btn-default delete_btn" href="'.site_url('admin/order/sort/'.$order->order_id."/".$det['rowid']).'" msg="Do you want to sort?" ></a>'.br(); ?>
                              <?php } ?>
                          </td>-->
                          <td>₦<?php echo $this->cart->format_number($order->total_amount); ?></td>
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
																
																case 4:
																	echo "Awaiting Admin Final Approval";
																	break;
																default:
																	echo "Order have been delivered and closed";
															}
														?>
													</td>
                          <td>
														<a class="fa fa-eye btn btn-sm btn-primary" href="<?php echo site_url('cooperative/orders/view_order/'.$order->order_id)?>"></a>
														<?php if ($order->status == 2) { ?>
															<a 
																class="btn btn-sm btn-primary slink" 
																msg="Do you want to approve this order?"
																href="<?php echo site_url('cooperative/orders/approve/'.$order->order_id)?>"> Approve</a>
														<?php } ?>
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
