<style>
    li {
        list-style-type: none;
    }
</style>

<div class="container">
    <div class="row mt-5 mb-5">
        <p class="bg-primary text-light p-2 rounded text-center w-100 text-center font-weight-light">Note: The amount displayed here will be paid per Month</p>
    <div class="col-lg-12">
    <?php 
        $buyerData = $this->db->get_where('users', ['user_id' => $this->session->userdata('user')->user_id])->row();
        $buyerContact = $this->db->get_where('contacts', ['user_id' => $this->session->userdata('user')->user_id])->row();
    ?>
    <br/>
    <form method="POST" action="<?php echo site_url('buyer/checkout') ?>" msg="We are placing your order...">
        <div class="row">
            
        <div class="col-lg-8">

            <div id="faq" role="tablist" aria-multiselectable="true">

                <div class="card">

                    <div class="card-header bg-white" role="tab" id="questionOne">
                        <h4 class="card-title ">
                            <a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="true" aria-controls="answerOne">
                                Step 1. ADDRESS DETAILS
                            </a>
                        </h4>
                    </div>

                    <div id="answerOne" class="collapse show" role="tabcard" aria-labelledby="questionOne">
                        <div class="card-body">
                            <!-- form here -->
                            <form action="<?php echo base_url();?>" method="post">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <span for="">Full Name <span class="text-red">*</span></span>
                                            <input type="text" name="full_name" value="<?php echo $buyerData->full_name; ?>" class="form-control input-sm">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <span for="">Email <span class="text-red">*</span></span>
                                            <input type="text" name="email" value="<?php echo $buyerData->email; ?>" class="form-control input-sm">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <span for="">&nbsp</span>
                                            <input type="number" name="phone_number" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"placeholder="Phone Number" value="<?php echo ($buyerContact && $buyerContact->phone_number != 'Not Set') ? $buyerContact->phone_number : ''; ?>" class="form-control input-sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Delivery Type</label>
                                        <input name="pick_up" type="radio" value="0" checked/> Door Delivery
                                       <!-- <input name="pick_up" type="radio" value="1"/> Pick Up-->
                                    </div>
                                </div>
                                <div class="row shipping_address">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <span for="">Shipping Address <span class="text-red">*</span></span>
                                            <textarea name="shipping_address" rows="4" class="form-control" placeholder="Street Name / Building / Apartment No."><?php echo ($buyerContact && $buyerContact->billing_address != 'Not Set') ? $buyerContact->billing_address : ''; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php 
                                                $shippingFees = $this->db->get('shipping_fee')->result(); 
                                            ?>
                                            <span for=""><span class="text-red">&nbsp;</span></span>
                                            <select name="shipping_location" class="form-control" id="sh_loc" url="<?php echo site_url('buyer/get_shipping_fee'); ?>">
                                                <option selected disabled>Select Shipping Address</option>
                                                <?php foreach ($shippingFees as $key => $shippingFee) { ?>
                                                    <?php $locationData = $this->db->get_where('shipping_location', ['loc_id' => $shippingFee->loc_id])->row(); ?>
                                                    <option value="<?php echo $shippingFee->loc_id; ?>">
                                                        <?php //echo $this->db->get_where('states', ['id' => $locationData->state_id])->row()->name.' '
														//echo $this->db->get_where('locals', ['local_id' => $locationData->local_id])->row()->local_name.' ' ?>
                                                        <?php echo $locationData->name.' ' ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <!-- <textarea name="billing_address" rows="4" class="form-control" placeholder="Street Name / Building / Apartment No."><?php echo ($buyerContact) ? $buyerContact->billing_address : ''; ?></textarea> -->
                                        </div>
                                    </div>

                                </div>
                        
                            </form>
                            <!-- form here -->
                        </div>
                    </div>

                </div>


        
                <div class="bg-white">
                    <div class="panel">
                        <div class="panel-heading" style="padding:10px;">
                            <h4>
                                <button type="button" data-toggle="collapse" data-target="#improvementsPanel" aria-expanded="true" class="btn btn-block btn-sm btn-primary"><b >&nbsp&nbsp&nbsp&nbspStep 2. Click Here To CONFIRM ORDER</button></b>
                            </h4>
                        </div>
                        <div id="improvementsPanel" class="panel-collapse collapse in" aria-expanded="true">
							<div class="payment">
								<label>Coupon Code</label>
                                <input name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code" class="input-control"/>
                                <button id="check_coupon_code" type="button" class="btn btn-sm btn-primary">Apply Coupon Code</button>
								<p id="coupon_status"></p>
							</div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="payment">
                                        <td class="text-right " colspan="4">Shipping Amount:</td>
                                        <td class="text-right" id="shipping_amt"></td>
                                        <input name="shipping_fee" type="hidden" id="shipping_fee"/>
                                        <input type="hidden" value="<?php echo $this->cart->total(); ?>" id="totalp"/>
                                    </tr>
                                    <tr class="coupon">
                                        <td class="text-right " colspan="4">Coupon : <span id="coupon_percent"></span></td>
                                        <td class="text-right">
                                            <b> <span id="coupon_amount">₦ 0.00</span></b>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="payment">
                                        <td class="text-right" colspan="4" style="color:black;font-weight:bold;">Total Order Amount</td>
                                        <td class="text-right" style="color:black;font-weight:bold;" >₦<b id="tp"><?php echo $this->cart->total(); ?></b></td>
                                    </tr>
                                    <tr class="payment">
                                        <td class="text-right" colspan="4" style="color:black;font-weight:bold;">Total Order Amount Payable</td>
                                        <td class="text-right" style="color:black;font-weight:bold;" >₦<b id="tap"><?php echo $this->cart->total(); ?></b></th>
                                    </tr>
                                    <tr class="payment">
                                        <td class="text-right " colspan="4">Instalment Payment:</td>
                                        <td class="text-right installment"><b>₦<?php echo $this->cart->format_number($this->cart->total()/4); ?> / Month</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            <?php if (count($this->cart->contents()) > 0) { ?>
                            
                <div class="container mb-5 mt-4">
                    
                    <?php if ($this->session->userdata('user') && $this->session->userdata('user')->step == 0) { ?>
                        <span class="payment">
                            <button type="submit" class="btn btn-primary text-white btn-block">Checkout</button>
                        </span>
                    <?php } else { ?>
                        <?php if ($this->session->userdata('user')) { ?>
                        <?php $step = $this->session->userdata('user')->step; ?>
                            <?php if ($step == 1) { ?>
                                <p class="bg-danger text-light p-1 rounded text-center">Your Account Is Awaiting Approval From Cooperative Admin! But you can <a href="<?php echo site_url(); ?>">Continue shopping</a></p>
                            <?php } else if ($step == 2) { ?>
                                <p class="bg-danger text-light p-1 rounded text-center">Check your email for confirmation email! But you can <a href="<?php echo site_url(); ?>">Continue shopping</a></p>
                            <?php } else if ($step == 3) { ?>
                                <p class="bg-danger text-light p-1 rounded text-center">Your Account Is Under Suspension By The Admin! But you can <a href="<?php echo site_url(); ?>">Continue shopping</a></p>
                            <?php } else if ($step == 4) { ?>
                                <p class="bg-danger text-light p-1 rounded text-center">Your Account Is Under Suspension By Your Cooperative Admin! But you can <a href="<?php echo site_url(); ?>">Continue shopping</a></p>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="alert alert-danger text-center">
                                Please login to continue to checkout
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-info text-center">
                    Your Cart Is Empty
                </div>
            <?php } ?>
    </form>
<!-- here -->





</div>

</div>
<!-- end first column -->


<div class="col-lg-4">
    <div class="card">
        <div class="card-header bg-white">
            <span class="text-dark ">YOUR ORDER(<?php echo count($this->cart->contents()); ?> item)</span>
        </div>
        <div class="card-body">
            <ul class="">
                <?php $totalW = 0; foreach ($this->cart->contents() as $key => $item) { ?>
                    <?php
                        $productData = $this->db->get_where('products', ['product_id' => $item['options']['product_id']])->row();
                        // $totalW += $productData->weight + $totalW;
                        // var_dump($productData); exit();
                        // $sellerData = $this->db->get_where('sellers', ['seller_id' => $productData->owner_id])->row();
                    ?>
                    <li>

                        <div class="row">
                            <div class="col-lg-6">
                                <img class="lazy" style="width: 100px; width: 100px; object-fit: contain" src="<?php echo site_url('assets/images/ajax-loader.gif'); ?>" data-src="<?php echo site_url('public/images/products/'.$productData->code.'/01.jpg');?>"/>
                            </div>
                            <div class="col-lg-6">
                                <span style="font-size:12px;" title="<?php echo hex2bin($item['name']); ?>"><?php echo character_limiter(hex2bin($item['name']), 15); ?></span><br>
                                <span style="color:gray;">Qty: <?php echo $item['qty']; ?></span><br>
                            </div>
                        </div>

                    </li>
                    <hr>
                    <li>Price  <span class="pull-right">₦<?php echo $this->cart->format_number($item['subtotal']/4).' Paid Monthly' ; ?></span></li><hr>
                <?php } ?>
                <?php $total = $this->cart->total(); ?>
                <?php $Installment = $this->cart->format_number(($this->cart->total()/4)).'</span> Monthly'; ?>
                <li>Total  <span class="pull-right text-dark text-bold"><?php echo $this->cart->format_number($total); ?></li>
                    
                
            </ul>
        </div>
    </div>
</div>
<!-- end second column -->


        
        </div>
    
    </div>
</div>
</div>
<!-- <input id="shipping_fee_placeholder" /> -->

<script>
    $(document).ready(function() {
		var prevTotalPrice = 0;
        $('.payment').hide();

        $('input[name=pick_up]').change(function () {
            if ($(this).val() == '1') {
                $('.shipping_address').hide();
                $('.payment').show();
                $("#shipping_fee").val(`0`);
                // $("#tp").text(totalPrice);
            } else {
                $('.shipping_address').show();
            }
        });

        $("#sh_loc").change(function() {
            // alert($(this).val());
            var id = $(this).val();
            var url = $(this).attr('url');
            console.log(url);
            $.get(url+'/'+id, {}, function(data) {
                var res = JSON.parse(data);
                var totalPrice = Number($("#totalp").val());
                totalPrice += Number(res.fee);
                console.log(totalPrice);
                $('.payment').show();
                $("#shipping_amt").html(`<b>₦${res.fee}</b>`);
                $("#shipping_fee").val(`${res.fee}`);
                $("#tp").text(totalPrice);
                $("#tap").text(totalPrice);
				$('.installment').text(`₦ ${Math.ceil(totalPrice / 4)} Paid Monthly`);
				prevTotalPrice = totalPrice;
                console.log(res);
            });
		});
		
		$("#check_coupon_code").click(function() {
			var coupon = $('#coupon_code').val();
			var coupon_status = $("#coupon_status");
			if (coupon.length > 0 && coupon.length >= 3) {
				coupon_status.attr('class', 'text-info').text('verifying coupon code...');
				$.get('<?php echo site_url('api/getCouponStatus') ?>', {code: coupon}, function(data) {
					console.log(data);
					var response = JSON.parse(data);
					Swal.fire({
                        title: 'Coupon Status',
                        text: response.msg,
                        icon: (response.status == 0) ? 'error' : 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: (response.status == 0) ? 'Cancel' : 'Use Coupon',
                        cancelButtonText: (response.status == 0) ? 'Cancel' : 'Cancel',
                    }).then((result) => {
						if (result && response.status == 1) {
                            var totalPrice = Number($("#tp").text());
                            var realTotalPrice = (totalPrice - Number($("#shipping_fee").val()));
                            var percentRemoved = Number((realTotalPrice/100) * Number(response.coupon_data.percentage));
							prevTotalPrice = totalPrice;

							totalPrice = (realTotalPrice - percentRemoved) + Number($("#shipping_fee").val());
							$("#tap").text(totalPrice);
                            $("#totalp").val(totalPrice);
                            $("#coupon_percent").text(response.coupon_data.percentage+'%');
                            $("#coupon_amount").text('₦'+percentRemoved);
							$('.installment').text(`₦ ${Math.ceil(totalPrice / 4)} Paid Monthly`);
						}
                    });
					console.log(response);
					coupon_status.attr('class', (response.status == 0) ? 'text-danger' : 'text-success').text(response.msg);
				});
			} else if (coupon.length == 0) {
				$("#tap").text(prevTotalPrice);
                $("#totalp").val(prevTotalPrice);
                
                $("#coupon_percent").text('0%');
                $("#coupon_amount").text('0');
				$('.installment').text(`₦ ${Math.ceil(prevTotalPrice / 4)} Paid Monthly`);
				coupon_status.empty();
			}
		});
    });
</script>
