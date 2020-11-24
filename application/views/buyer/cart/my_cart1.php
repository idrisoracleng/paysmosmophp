
<div class="container mb-5">
  <div class="row" style="margin: auto;">
    
    

    <div class="col-lg-12">
      <br/>
      <?php $this->load->view('layouts/buyer/top_nav.php', array('title' => 'My Cart')); ?>
      <br/>

      <div class="row">
      <?php if (count($this->cart->contents()) > 0) { ?>
    <div class="col-lg-12">

      <h5 class="text-dark">Cart (<?php echo count($this->cart->contents()); ?> item)</h5>
      <div class="table-responsive">
        
        <table class="table table-bordered">
          <thead style="background: #e6e6e6;">
            <tr>
              <th><b><small>ITEM</small></b></th>
              <th><b><small>QUANTITY</small></b></th>
              <th><b><small>UNIT PRICE</small></b></th>
              <th><b><small>SUBTOTAL</small></b></th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($this->cart->contents() as $key => $item) { ?>
            <tr class="bg-white">
              <?php
                $productData = $this->db->get_where('products', ['product_id' => $item['options']['product_id']])->row();
                // var_dump($productData); exit();
                $sellerData = $this->db->get_where('sellers', ['seller_id' => $productData->owner_id])->row();
                $userData = $this->db->get_where('users', ['user_id' => $productData->owner_id])->row();
              ?>
              <td class=>
                <div class="row">
                  <div class="col-lg-5">
                    <img style="height: 150px; width: 100px;" src="<?php echo site_url('public/images/products/'.$productData->code.'/01.jpg');?>"/>
                  </div>
                  <div class="col-lg-7 text-right">
                    <span style="color:gray;">Seller: <?php echo ($sellerData) ? $sellerData->company_name : $userData->full_name; ?></span><br>
                    <span><?php echo $productData->name; ?></span><br><br>
                    <a href="<?php echo site_url('buyer/deletefromcart/'.$item['rowid']) ?>" class="delete_btn btn btn-danger btn-block btn-sm">
                      <i class="fa fa-remove"></i> REMOVE
                    </a>
                    </span>
                  </div>
                </div>
              </td>
              <td class="text-center">
                <!-- <input type="text" class="form-control" id="oldqty" value="<?php //echo $item['qty'] ?>"/> -->
                <form action="<?php echo site_url('buyer/updatecart') ?>" msg="Updating Cart Content..." method="POST">
                  <div class="form-group">
                    <input type="text" id="newqty" name="qty" value="<?php echo $item['qty'] ?>" class="form-control input-sm"/>
                    <input type="hidden" id="newoto" name="oto" value="<?php //echo json_encode($item['options']['other_options']) ?>"/>
                    <input type="hidden" name="rowid" value="<?php echo $item['rowid'] ?>"/>
                    <input type="hidden" name="owner_id" value="<?php echo $item['options']['seller_id'] ?>"/>
                    <input type="hidden" name="product_id" value="<?php echo $item['options']['product_id'] ?>"/>
                  </div>
                  
                  <div class="form-group">
                    <button class="btn btn-block btn-sm" style="background: #f3d347;">Update Cart</button>
                  </div>
                </form>
              </td>
              <td class="text-center">
                <span style="color:black;">₦<?php echo $this->cart->format_number(($item['price']/4)); ?> Paid Monthly</span><br>
                <!-- <span class="item-price"  style="color:gray;"><strike>₦20,000</strike></span> -->
                <!-- <br> -->
                <!-- <span style="color:green;">Savings:₦7,500</span> -->
              </td>
              <td class="text-center">
                <span style="color:green;">₦<?php echo $this->cart->format_number(($item['subtotal']/4)); ?> Paid Monthly</span>
              </td>
            </tr>
            <?php } ?>
          </tbody>
          <tfoot style="background: #e6e6e6;">
            <tr>
              <th colspan="3">&nbsp</th>
              <th>
                <small>
                Total : <span style="color:green;">₦<?php echo $this->cart->format_number($this->cart->total()); ?></span><br>
                <span>Shipping fees not included yet</span></small>
              </th>
            </tr>
          </tfoot>
        </table>
        
      </div>

    </div>
    <?php } ?>
    
  </div>
  <?php if (count($this->cart->contents()) == 0) { ?>
      <div class="alert alert-info text-center w-100">
        You do not have any item in your cart <a href="<?php echo site_url(); ?>">Market</a>
      </div>
    <?php } ?>


    </div>

  </div>

  
  
    
</div>

<?php if (count($this->cart->contents()) > 0) { ?>
	
		<div class="container mb-5 mt-4">
			<?php if ($this->session->userdata('user') && $this->session->userdata('user')->step == 0) { ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header bg-white">
								<a href="#" class="btn btn-outline-warning">Continue Shopping</a>
								<a href="<?php echo base_url('buyer/check_out');?>" class="btn btn-success">Proceed to  Checkout</a>
							</div>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<?php if ($this->session->userdata('user')) { ?>
				<?php $step = $this->session->userdata('user')->step; ?>
					<?php if ($step == 1) { ?>
						<p class="bg-danger text-light p-1 rounded text-center">Your Account Is Awaiting Approval From Cooperative Admin</p>
					<?php } else if ($step == 2) { ?>
						<p class="bg-danger text-light p-1 rounded text-center">Your Account Is Awaiting Admin Approval</p>
					<?php } else if ($step == 3) { ?>
						<p class="bg-danger text-light p-1 rounded text-center">Your Account Is Under Suspension By The Admin</p>
					<?php } else if ($step == 4) { ?>
						<p class="bg-danger text-light p-1 rounded text-center">Your Account Is Under Suspension By Your Cooperative Admin</p>
					<?php } ?>
				<?php } else { ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header bg-white">
									<a href="#" class="btn btn-outline-warning">Continue Shopping</a>
									<a href="<?php echo base_url('buyer/check_out');?>" class="btn btn-success">Proceed to  Checkout</a>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	

<?php } ?>




<script>
  $(document).ready(function(){
    // alert("We are almost done here");
    // var oldqty = $("#oldqty");
    // var newqty = $("#newqty");

    var oldoto = $("#oldoto");
    var newoto = $("#newoto");

    // oldqty.keyup(function(){
    //   newqty.val($(this).val());
    // });

    oldoto.keyup(function(){
      newoto.val($(this).val());
    });

    $("#checkout").click(function (e) {
      
      var p_type = $("#p_type");
      // alert(p_type);
      if (p_type.val() == 'op') {
        e.preventDefault();
        alert('Requirement Online Is Required');
      } else if (p_type.val() == 'pd') {
        // return false;
      } else {
        e.preventDefault();
        p_type.addClass("border border-danger");
        alert("Please select a payment type");
      }
    });
  });
</script>
<script src="<?php echo site_url('public/js/sb-admin.js'); ?>"></script>
