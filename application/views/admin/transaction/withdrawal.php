<style>
	.divider {
		width: 1px;
		background: blue;
		height: 100px;
	}
</style>

<?php
	$orders = $this->db->get_where('seller_order', ['seller_id' => $this->session->userdata('user')->user_id, 'status' => 'delivered'])->result();
?>

<div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>
<?php
	// $sql = "SELECT wid.*, u.first_name, u.last_name, wal.avail_balance"	
?>
<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/'.$this->session->userdata('user')->acct_type.'/product/all') ?>">Transacttions</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-product"></i>
			Withdrawal List
			<!-- <a href="<?php //echo site_url('/seller/wallet/withdraw'); ?>" style="float: right" class="btn btn-sm btn-primary">Withdrawals <span class="fa fa-cash"></span></a> -->
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td>Seller Name</td>
						<td>Amount</td>
						<td>Balance</td>
						<td>Bank Detail</td>
						<td>Status</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($withdrawals as $key => $withdrawal) { ?>
						<?php $userData = $this->db->get_where('users', ['user_id' => $withdrawal->user_id])->row(); ?>
						<?php $wallet = $this->db->get_where('wallet', ['user_id' => $withdrawal->user_id])->row(); ?>
						<?php $bankDetail = $this->db->get_where('bank_account_info', ['id' => $withdrawal->acct_id])->row(); ?>
						<tr>
							<td><?php echo $userData->full_name; ?></td>
							<td>N <?php echo $this->cart->format_number($withdrawal->amount); ?></td>
							<td>N <?php echo $this->cart->format_number($wallet->avail_balance); ?></td>
							<td>
								<p>Bank Name: <?php echo ucwords($bankDetail->bank_name); ?></p>
								<p>Account Name: <?php echo ucwords($bankDetail->bank_account_name); ?></p>
								<p>Account Number: <?php echo $bankDetail->bank_account_number; ?></p>
							</td>
							<td><?php echo $withdrawal->status; ?></td>
							<td>
								<div class="dropdown">
									<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Options
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a
											class="btn btn-sm dropdown-item btn-primary" 
											href="<?php echo site_url('/admin/transaction/withdrawal/view/'.$withdrawal->id) ?>"
											title="View Product"><i class="fas fa-eye"></i> View</a>
										<?php if ($withdrawal->status == 'pending') { ?>
											<a
												class="btn btn-sm dropdown-item btn-secondary slink" 
												msg="Do you want to approve this withdrawal?" 
												href="<?php echo site_url('/admin/transaction/withdrawal/approve/'.$withdrawal->id) ?>"
												title="Approve Product"><i class="fa fa-bolt"></i> Approve</a>
										<?php } ?>
										<?php if ($withdrawal->status == 'approved') { ?>
											<a
												class="btn btn-sm dropdown-item btn-warning slink" 
												msg="Do you want to settle this withdrawal?" 
												href="<?php echo site_url('/admin/transaction/withdrawal/complete/'.$withdrawal->id) ?>"
												title="Disapprove Product"><i class="fas fa-window-close"></i> Complete</a>
										<?php } ?>
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<!-- <div class="card mb-3">
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
    </div> -->

  </div>
