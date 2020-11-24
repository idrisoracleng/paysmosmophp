<?php $profile = $this->session->userdata('user'); ?>
<?php $seller_info = $this->db->get_where('sellers', ['seller_id'=>$profile->user_id])->row(); ?>

<div class="container mt-5 mb-5">
    <div class="row">
        
           <?php $this->load->view('layouts/buyer/side_bar', array('active' => 'home')) ?> 
       
        <div class="col-lg-9 col-sm-9 col-md-9">
            <?php //$this->load->view('layouts/buyer/top_nav.php', array('title' => 'My Profile')); ?>
            <div class="row">
                <div class="col-lg-12">
                   <div class="card">
                        <div class="card-header">
                            <b style="color:black;">Personal Information</b>
                        </div>
                        <div class="card-bod">
                            <table style="width: 100%" class="table">
                                <tr>
                                    <td>Full Name</td>
                                    <td><?php echo $profile->full_name ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $profile->email ?></td>
                                </tr>
                                <tr>
                                    <?php $cooperative = $this->db->get_where('cooperatives', ['cooperative_id' => $profile->cooperative_id])->row(); ?>
                                    <td>Cooperative Society</td>
                                    <td><?php echo ($cooperative) ? $cooperative->name : 'Not a member of a cooperative yet'; ?></td>
                                </tr>
                            </table>

                        </div>
                    </div> 
                </div>
                <!-- END :: FIRST COLUMN ==========================================================================  -->


                <div class="col-lg-12">
                    <div class="card">
      <div class="card-header">
          <b style="color:black;">Contact Information</b>
      </div>
        <div class="card-body">
            <?php $contact = $this->db->get_where('contacts', ['user_id'=>$profile->user_id])->row(); ?>
            <table style="width: 100%" class="table">
                <tr>
                    <td>Phone Number</td>
                    <td><?php echo ($contact) ? $contact->phone_number : 'Not Set'  ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo ($contact) ? $contact->email : 'Not Set'  ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo ($contact) ? $contact->address : 'Not Set'  ?></td>
                </tr>
                <tr>
                    <td>Billing Address</td>
                    <td><?php echo ($contact) ? $contact->billing_address : 'Not Set'  ?></td>
                </tr>
            </table>

        </div>
    </div>
                </div>
                <!-- END :: SECOND COLUMN ====================================================   -->
               
            </div>
        </div>
    </div>
</div>
 


