<div class="container mb-5 mt-5">
  <div class="row d-flex justify-content-center">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
      <h4 class="text-center" style="color:#f3d347;"><b>Register</b></h4>
      <form class="" action="<?php echo site_url('/account/register') ?>" method="POST" msg="Registration in progress...">
        <div class="form-group">
          <label for="">Full Name</label>
          <input type="text" name="full_name" class="form-control" required style="border-top:none;border-right:none;border-left:none;">
          <input type="hidden" name="acct_type" class="form-control" value="buyer" readonly>
        </div>

        <div class="form-group">
          <label for="">Email</label>
          <input type="email" name="email" class="form-control" required style="border-top:none;border-right:none;border-left:none;">
          <!-- <input type="hidden" name="acct_type" class="form-control" value="buyer" readonly> -->
        </div>

        <div class="form-group">
          <label for="">Password</label>
          <input type="password" name="password" class="form-control" required style="border-top:none;border-right:none;border-left:none;">
        </div>

        <div class="form-group">
					<label>Organization</label>
          <select class="form-control" name="cooperative_id" style="border-top:none;border-right:none;border-left:none;">
            <option selected disabled>Select organization</option>
            <option value="no_cooperative">Individual</option>
						<?php
            $cooperatives = $this->db->get_where('cooperatives', ['active' => 1])->result(); 
            foreach ($cooperatives as $Key => $cooperative) { ?>
							<option value="<?php echo $cooperative->cooperative_id; ?>"><?php echo $cooperative->name; ?></option>
						<?php } ?>
					</select>
        </div><br>

				<div class="form-group">
					<button class="btn btn-block btn-login text-uppercase mb-2 text-white" type="submit" style="background:#f3d347;">Register</button>
				</div>
        
        <hr>

        <p class="text-center text-dark text-muted"><b>Already have an account?</b></p>

        <div class="text-center">
          <a class="btn btn-block btn-success" href="<?php echo site_url('buyer/login') ?>">Login</a>

        </div>

      </form>
    </div></div>
    </div>
  </div>
</div>
