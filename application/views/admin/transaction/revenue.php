<style>
	.divider {
		width: 1px;
		background: blue;
		height: 100px;
	}
</style>

<?php
	// $orders = $this->db->get_where('seller_order', ['seller_id' => $this->session->userdata('user')->user_id, 'status' => 'delivered'])->result();
?>

<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/'.$this->session->userdata('user')->acct_type.'/product/all') ?>">Wallet</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			My Wallet 
			<a href="<?php echo site_url('/seller/wallet/withdraw'); ?>" style="float: right" class="btn btn-sm btn-primary">Withdraw <span class="fa fa-cash"></span></a>
		</div>
		<div class="card-body">
			<div class="row text-center">
				<div class="col-md-3 rounded p-2 border border-primary text-center">
					<h1>N<?php echo (isset($wallet) && ($wallet->net_income)) ? $this->cart->format_number(($wallet->net_income)) : 0.00; ?></h1>
					<p title="Total earned money excluding payment awaiting clearance">Total Earned</p>
				</div>
				<!-- <div class="divider divider--md1"></div> -->
				<div class="col-md-3 rounded p-2 border border-primary text-center">
					<h1>N<?php echo (isset($wallet) && isset($wallet->avail_balance)) ? $this->cart->format_number($wallet->avail_balance) : 0.00; ?></h1>
					<p title="Total earning available for withdrawal">Available Balance</p>
				</div>
				<!-- <div class="divider divider--md1"></div>
				<div class="col-md-3 rounded p-2 text-center">
					<h1>N<?php //echo $wallet->avail_balance ?></h1>
					<p>Used For Purchase</p>
				</div> -->
				<!-- <div class="divider divider--md1"></div> -->
				<div class="col-md-3 rounded p-2 border border-primary text-center">
					<h1>N<?php echo (isset($wallet) && isset($wallet->withdrawn)) ? $this->cart->format_number($wallet->withdrawn) : 0.00; ?></h1>
					<p title="Total earning withdrawn">Withdrawn</p>
				</div>
				<!-- <div class="divider divider--md1"></div> -->
				<div class="col-md-3 rounded p-2 border border-primary text-center">
					<h1>N<?php echo (isset($wallet) && isset($wallet->waiting_balance)) ? $this->cart->format_number($wallet->waiting_balance) : 0.00; ?></h1>
					<p title="Total earning awaiting clearance">Awaiting Clearance</p>
				</div>

			</div>
		</div>
	</div>
	
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			Sale History
			<a href="<?php echo site_url('/seller/wallet/withdraw'); ?>" style="float: right" class="btn btn-sm btn-primary">Print <span class="fa fa-cash"></span></a>
		</div>
		<div class="card-body">
			<div class="row text-center">
				<?php if ($orders) { ?>

				<?php } else { ?>
					<div class="alert alert-info text-center w-100">
						No order have been delivered
					</div>
				<?php } ?>
			</div>
		</div>
    </div>

  </div>
