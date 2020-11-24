<?php
    $profile = $this->session->userdata('user');
    $seller_info = $this->db->get_where('sellers', ['seller_id'=>$profile->user_id])->row();
?>


    <div class="container mt-5">

        <!-- <img style="width: 100%" src="<?php //echo ($seller_info) ? $seller_info->logo : '' ?>"> -->
        <!-- <h3 class="text-dark">My Profile</h3> -->

        <div class="row">
            <?php $this->load->view('layouts/buyer/side_bar.php', array('active' => 'settings')); ?>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <b style="color:black;">Change Password</b>
                    </div>
                    <div class="card-body">
                        <form class="form" action="<?php echo site_url('/buyer/profile/update/security') ?>" method="POST" msg="Updating profile">
                            <table style="width: 100%" class="table">
                                <tr>
                                    <td>Previous Password</td>
                                    <td><input type="password" class="form-control" name="old_password" value=""/></td>
                                </tr>
                                <tr>
                                    <td>New Password</td>
                                    <td><input type="password" name="new_password" class="form-control" value=""/></td>
                                </tr>
                                <tr>
                                    <td>Confirm Password</td>
                                    <td><input type="password" name="confirm_password" class="form-control" value=""/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" class="btn btn-sm btn-primary" value="Update"/></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
