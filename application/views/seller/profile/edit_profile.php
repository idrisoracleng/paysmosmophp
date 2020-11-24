<?php $seller_info = $this->db->get_where('sellers', ['seller_id'=>$profile->user_id])->row(); ?>
<?php $seller_bank_account_info = $this->db->get_where('bank_account_info', ['user_id'=>$profile->user_id])->result_array(); ?>

  <div id="wrapper">

<!-- Sidebar -->
<?php include APPPATH.'/views/layouts/admin/side_nav.php' ?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('/admin/settings/menus') ?>">Profile</a>
      </li>
      <li class="breadcrumb-item active">Edit Profile</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-user"></i>
            My Account<a href="#" style="float: right" data-toggle="modal" data-target="#newMenu" class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></a>
        </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <img style="width: 100%" src="<?php echo ($seller_info) ? $seller_info->logo : '' ?>">
            </div>
            <div class="col-md-5" id="pi">
                <div class="card">
                    <div class="card-header">
                        Personal Information
                    </div>
                    <div class="card-bod">
                        <form class="form" action="<?php echo site_url('/'.$profile->loggedinas.'/profile/update/user') ?>" method="POST" msg="Updating profile">
                        <table style="width: 100%" class="table">
                            <tr>
                                <td>Full Name</td>
                                <td><input type="text" class="form-control" name="full_name" value="<?php echo $profile->full_name ?>"/></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="email" name="email" class="form-control" value="<?php echo $profile->email ?>"/></td>
                            </tr>
                            <tr>
                                <td>About</td>
                                <td><textarea class="form-control" name="about" placeholder="Tell us about yourself"><?php echo $profile->about; ?></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" class="btn btn-sm btn-warning" value="Update"/></td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
                
            </div>

            <div class="col-md-5" id="ci">
                <div class="card">
                    <div class="card-header">
                        Contact Information
                    </div>
                    <div class="card-body">
                        <?php $contact = $this->db->get_where('contacts', ['user_id'=>$profile->user_id])->row(); ?>

                        <form class="form" action="<?php echo site_url('/'.$profile->loggedinas.'/profile/update/contacts') ?>" method="POST" msg="Updating Contact info">
                        <table style="width: 100%" class="table">
                            <tr>
                                <td>Phone Number</td>
                                <td><input type="text" class="form-control" name="phone_number" value="<?php echo ($contact) ? $contact->phone_number : 'Not Set'  ?>"/></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" class="form-control" name="email" value="<?php echo ($contact) ? $contact->email : 'Not Set'  ?>"/></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><input type="text" class="form-control" name="address" value="<?php echo ($contact) ? $contact->address : 'Not Set'  ?>"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" class="btn btn-sm btn-warning" value="Update"/></td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
                
            </div>
        
        <?php if($seller_info){ ?>
            <div class="col-md-12"  id="bizi">
                <div class="card">
                    <div class="card-header">
                        Business Information
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form class="form" action="<?php echo site_url('/'.$profile->loggedinas.'/profile/update/sellers') ?>" method="POST" msg="Updating Business Info">
                            <table style="width: 100%" class="table">
                                <tr>
                                    <td>Business name</td>
                                    <td><input type="text" class="form-control" name="company_name" value="<?php echo ($seller_info) ? $seller_info->company_name : 'Not Set'  ?>"/></td>
                                </tr>
                                <tr>
                                    <td>Business Location</td>
                                    <td><textarea class="form-control" name="location" placeholder="Format: Country, State, City, Street Address"><?php echo ($seller_info) ? $seller_info->location : 'Not Set' ?></textarea></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" class="btn btn-sm btn-warning" value="Update"/></td>
                                </tr>
                            </table>
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-md-12" id="bi">
                <div class="card">
                    <div class="card-header">
                        Bank Account Info
                    </div>
                    <?php
                        $banks = array(
                            'Access Bank Plc','Fidelity Bank Plc','First City Monument Bank Plc','First Bank of Nigeria Limited','Guaranty Trust Bank Plc','Union Bank of Nigeria Plc',
                            'United Bank for Africa Plc','Zenith Bank Plc','Ecobank Nigeria Plc','Polaris Bank Limited','Heritage Banking Company Limited','Citibank Nigeria Limited',
                            'Keystone Bank Limited','Stanbic IBTC Bank Plc','Sterling Bank Plc','Unity Bank Plc','Wema Bank Plc'
                        );	
                    ?>
                </div>
                <div class="card-body row">
                    <div class="col-md-4" id="edit">
                        <?php if ($seller_bank_account_info) { ?>
                            <ul class="list-group">
                                <?php foreach ($seller_bank_account_info as $key => $bankDetail) { ?>
                                    <div class="list-group-item">
                                        <p><?php echo ucwords($bankDetail['bank_name']); ?></p>
                                        <p><?php echo ucwords( $bankDetail['bank_account_name']); ?></p>
                                        <p><?php echo $bankDetail['bank_account_number']; ?></p>
                                        <a class="btn btn-sm btn-primary" href="<?php echo site_url('/seller/profile/edit_bank_detail/'.$bankDetail['id']); ?>#edit">Edit</a>
                                    </div>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <div class="alert-info alert text-align">
                                No Bank Account Have Been Added
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-4">
                        <form msg="Adding New Bank Account..." class="form" action="<?php echo site_url('/'.$profile->loggedinas.'/profile/add_bank_detail') ?>" method="POST" msg="Updating Business Info">
                            <table style="width: 100%" class="table">
                                <tr>
                                    <td>Bank Name</td>
                                    <td>
                                        <select name="bank_name" class="form-email form-control">
                                            <option selected disabled>Select a bank name</option>
                                            <?php foreach ($banks as $key => $bank) { ?>
                                                <option value="<?php echo strtolower($bank) ?>"><?php echo $bank; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Account Name</td>
                                    <td><input type="text" class="form-control" name="bank_account_name" value=""/></td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td><input name="bank_account_number" class="form-control" type="text" maxlength="10"/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" class="btn btn-sm btn-warning" value="Add"/></td>
                                </tr>
                            </table>
                        </form>
                    </div>

                    <div class="col-md-4">
                        <?php if (isset($bankDetailData)) { ?>
                            <form msg="Updating Bank Data..." class="form" action="<?php echo site_url('/'.$profile->loggedinas.'/profile/update_bank_detail/'.$bankDetailData->id) ?>" method="POST" msg="Updating Business Info">
                                <table style="width: 100%" class="table">
                                    <tr>
                                        <td>Bank Name</td>
                                        <td>
                                            <select name="bank_name" class="form-email form-control">
                                                <option selected disabled>Select a bank name</option>
                                                <?php foreach ($banks as $key => $bank) { ?>
                                                    <option <?php echo ($bankDetailData->bank_name == strtolower($bank)) ? 'selected' : '' ?> value="<?php echo strtolower($bank) ?>"><?php echo $bank; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Account Name</td>
                                        <td><input type="text" class="form-control" name="bank_account_name" value="<?php echo ($bankDetailData) ? $bankDetailData->bank_account_name : ''  ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td>Account Number</td>
                                        <td><input name="bank_account_number" class="form-control" type="text"  value="<?php echo ($bankDetailData) ? $bankDetailData->bank_account_number : ''  ?>"/><//></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" class="btn btn-sm btn-warning" value="Update"/></td>
                                    </tr>
                                </table>
                            </form>
                        <?php } else { ?>
                            <p class="alert alert-info text-center">
                                Select an account to edit
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
      </div>
      
    </div>

  </div>
