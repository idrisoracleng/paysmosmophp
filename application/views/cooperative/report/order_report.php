
<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/buyer/orders/order_list') ?>">Report</a>
      </li>
      <li class="breadcrumb-item active">Order Report</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-archive"></i>
        Order Report
		  <div class="float-right">
          <!-- <a class="btn btn-primary btn-sm ml-1" href="<?php //echo site_url('admin/order/all_orders') ?>">All Orders</a>
          <a class="btn btn-primary btn-sm ml-1" href="<?php //echo site_url('admin/order/closed_orders') ?>">Closed Orders</a>
          <a class="btn btn-primary btn-sm ml-1" href="<?php //echo site_url('admin/order/pending_orders') ?>">Pending Orders</a>
          <a class="btn btn-primary btn-sm ml-1" href="<?php //echo site_url('admin/order/pending_cooperate') ?>">Pending Organisation Orders</a> -->
          <a class="btn btn-primary btn-sm ml-1" href="<?php echo site_url('cooperative/report/download_orders_report') ?>">Download Report</a>
        </div>			 
        </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
              <?php if(count($order_reports) == 0){ ?>
                <p class="alert alert-warning">You Don't Have Any Order Now</p>
              <?php } else { ?>
                <div class="table-responsive">   
                    <table class="table table-hovered" width="100%">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Buyer Info</th>
                                <th>Order Detail</th>
                                <th>Monthly Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_reports as $key => $order_report) { ?>
                                <?php $order_details = unserialize($order_report->order_detail); ?>
                                <tr>
                                    <td><?php echo $order_report->order_id; ?></td>
                                    <td>
                                        <p>Name: <?php echo $order_report->full_name; ?></p>
                                        <p>Email: <?php echo $order_report->email; ?></p>
                                        <p>Phone Number: <?php echo $order_report->phone_number; ?></p>
                                    </td>
                                    <td>
                                        <?php //echo json_decode($order_report->order_detail); ?>
                                        <?php foreach ($order_details as $key => $orderItem) { ?>
                                            <p><?php echo hex2bin($orderItem['name']); ?></p>
                                            <p><?php //echo $orderItem['qty']; ?></p>
                                            <p><?php echo 'N '.$this->cart->format_number($orderItem['price']); ?></p>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $this->cart->format_number(($order_report->total_amount / 4)); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
