

<!-- <a
	class="btn btn-sm float-right mr-2 btn-primary" 
	href="<?php //echo site_url('/admin/product/view/'.$product['code']) ?>"
	title="View Product"><i class="fas fa-eye"></i> View</a> -->
<?php //$loggedinas = $this->session->userdata('user')->loggedinas; ?>
<?php $loggedinas = 'admin'; ?>
<a
	class="btn btn-sm float-right mr-2 btn-danger delete_btn" 
	href="<?php echo site_url("/admin/product/delete/".$product['code']) ?>"
	title="Delete Product"><i class="fas fa-trash"></i> Delete</a>
<?php if($loggedinas == 'admin' && $product['status'] == 'pending'){ ?>
	<a
		class="btn btn-sm float-right mr-2 btn-secondary slink" 
		msg="Do you want to approve <?php echo $product['name']; ?>?" 
		href="<?php echo site_url("/$loggedinas/product/approve/".$product['code']) ?>"
		title="Approve Product"><i class="fa fa-bolt"></i> Approve</a>
<?php } ?>
<?php if($loggedinas == 'admin' && $product['status'] == 'paused'){ ?>
	<a
		class="btn btn-sm float-right mr-2 btn-secondary slink" 
		msg="Do you want to resume <?php echo $product['name']; ?>?" 
		href="<?php echo site_url("/$loggedinas/product/approve/".$product['code']) ?>"
		title="Resume Product"><i class="fa fa-play"></i> Resume</a>
	<a
		class="btn btn-sm float-right mr-2 btn-warning slink" 
		msg="Do you want to unapprove <?php echo $product['name']; ?>?" 
		href="<?php echo site_url("/$loggedinas/product/unapprove/".$product['code']) ?>"
		title="Disapprove Product"><i class="fas fa-window-close"></i> Disapprove</a>
<?php } ?>
<?php if($loggedinas == 'admin' && $product['status'] == 'approved'){ ?>
	<a
		class="btn btn-sm float-right mr-2 btn-warning slink" 
		msg="Do you want to unapprove <?php echo $product['name']; ?>?" 
		href="<?php echo site_url("/$loggedinas/product/unapprove/".$product['code']) ?>"
		title="Disapprove Product"><i class="fas fa-window-close"></i> Disapprove</a>
	<a
		class="btn btn-sm float-right mr-2 btn-warning slink" 
		msg="Do you want to pause <?php echo $product['name']; ?>?" 
		href="<?php echo site_url("/$loggedinas/product/pause/".$product['code']) ?>"
		title="Pause Product"><i class="fas fa-pause"></i> Pause</a>
<?php } ?>
<?php //if($this->session->userdata('user')->user_id == $product['owner_id']){ ?>
	<a
		class="btn btn-sm float-right mr-2 btn-warning" 
		href="<?php echo site_url("/$loggedinas/product/edit/".$product['code']) ?>"
		title="Edit Product"><i class="fas fa-edit"></i> Edit</a>
	<a
		class="btn btn-sm float-right mr-2 btn-info" 
		href="<?php echo site_url("/$loggedinas/product/clone/".$product['code']) ?>"
		title="Clone Product"><i class="fas fa-copy"></i> Clone</a>
<?php //} ?>

