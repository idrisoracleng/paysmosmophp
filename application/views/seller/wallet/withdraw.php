<style>
	.divider {
		width: 1px;
		background: blue;
		height: 100px;
	}
</style>

<?php
	$orders = $this->db->get_where('seller_order', ['seller_id' => $this->session->userdata('user')->user_id, 'status' => 'delivered'])->result();
	$bankDetails = $this->db->get_where('bank_account_info', ['user_id' => $this->session->userdata('user')->user_id])->result();
	if (!$bankDetails) {
		$this->session->set_flashdata('msg', 'Please add your bank account detail');
		$this->session->set_flashdata('flag', 'alert alert-danger');
		redirect(site_url('seller/profile/edit_profile#bi')); 
	}
?>

<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/'.$this->session->userdata('user')->loggedinas.'/product/all') ?>">Wallet</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			Withdrawal Form
			<a href="<?php echo site_url('/seller/wallet/my_wallet'); ?>" style="float: right" class="btn btn-sm btn-primary">My Wallet <span class="fa fa-cash"></span></a>
		</div>
		<div class="card-body">
			<form class="form-row" msg="Requesting withdrawal..." method="POST" action="<?php echo site_url('seller/wallet/withdraw/store'); ?>">
				<p>Your available balance for withdrawal is <b>N <?php echo $this->cart->format_number($wallet->avail_balance); ?></b></p>
				<div class="form-group col-md-6 offset-3">
					<label>Select account</label>
					<select class="form-control" name="acct_id">
						<option seleted>Select account</option>
						<?php foreach ($bankDetails as $key => $bankDetail) { ?>
							<option value="<?php echo $bankDetail->id; ?>"><?php echo $bankDetail->bank_account_name.' - '.$bankDetail->bank_account_number.' - '.ucwords($bankDetail->bank_name); ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group col-md-6 offset-3">
					<label>Amount to withdraw</label>
					<input class="form-control" name="amount" type="number" max="<?php echo (int)$wallet->avail_balance; ?>" min="10000" placeholder="Input amount to withdraw"/>
				</div>

				<div class="form-group col-md-6 offset-3">
					<button class="btn btn-primary rounded">Withdraw</button>
				</div>
			</form>
		</div>
	</div>

  </div>
