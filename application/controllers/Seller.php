<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Africa/Lagos');
    }

    public function isOnline(){
        if(!$this->session->userdata('user')) return false; else return true;;
    }

	public function home(){
        if(!$this->isOnline()){$this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/seller/login'));};
        if($this->session->userdata('user')->loggedinas !== 'seller') redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'seller'])->result();
        $data['latest_products'] = $this->db->order_by('created_at', 'DESC')->get_where('products', ['owner_id'=>$this->session->userdata('user')->user_id])->result();
        $data['scripts'] = ['main.js', 'forms.js'];
        $data['page_title'] = ' Seller | Home | '.$this->session->userdata('user')->full_name;
        $this->load->view('layouts/admin/head', $data);
        $this->load->view('layouts/admin/top_nav', $data);
        $this->load->view('seller/index', $data);
        $this->load->view('layouts/admin/foot', $data);
    }

    public function product($param1 = 'all', $param2 = null, $param3 = null){

        if(!$this->isOnline()){$this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/seller/login'));};
        if($this->session->userdata('user')->loggedinas !== 'seller') redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'seller'])->result();
        if($param1 == 'all'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = ' Seller | Products | My Products';
            $data['seller_product'] = $this->ProductModel->getProductsBy('owner_id', $this->session->userdata('user')->user_id);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/product/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        }else if($param1 == 'create'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = ' Seller | Products | My Products';
            $data['seller_product'] = $this->ProductModel->getProductsBy('owner_id', $this->session->userdata('user')->user_id);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/product/create', $data);
            $this->load->view('layouts/admin/foot', $data);
        }else if($param1 == 'view'){
            $data['scripts'] = ['main.js'];
            $data['product'] = $this->ProductModel->getProductBy('code', $param2);
            $data['page_title'] = " | Admin | Products | ".$data['product']['name'];
            $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/product/this', $data);
            $this->load->view('layouts/admin/foot', $data);
        }else if($param1 == 'edit'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['product'] = $this->ProductModel->getProductBy('code', $param2);
            $data['page_title'] = " | Admin | Products | ".$data['product']['name'];
            $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/product/edit', $data);
            $this->load->view('layouts/admin/foot', $data);
        }else if($param1 == 'clone'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['product'] = $this->ProductModel->getProductBy('code', $param2);
            $data['page_title'] = " | Admin | Products | ".$data['product']['name'];
            $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/product/clone', $data);
            $this->load->view('layouts/admin/foot', $data);
        }else if ($param1 == 'update') {
            $product = $this->input->post();
            
            $variant_size = $product['variant_size'];
            $variant_price = $product['variant_price'];
            $variant_discount_price = $product['variant_discount_price'];
			$variant_id = $product['variant_id'];
			$variant_qty = $product['variant_qty'];


            unset($product['variant_size']);
            unset($product['variant_price']);
            unset($product['variant_discount_price']);
            unset($product['variant_id']);
            unset($product['variant_qty']);
            if($variant_size){
                // echo json_encode($this->input->post('option_values'));
                foreach($variant_size as $key => $value){
                    if ($variant_id[$key] == 'null' || $variant_id[$key] == null) {
                        $this_product_variant = array(
                            'product_id' => $product['product_id'], 
                            'price' => $variant_price[$key], 
                            'price' => $variant_price[$key], 
                            'discount_price' => $variant_discount_price[$key],
                            'size' => $variant_size[$key],
                            'qty' => $variant_qty[$key],
                        );
                        if(!$this->db->insert('variants', $this_product_variant)){
                            echo json_encode(['status'=>0, 'msg' => 'Product Variant Creating Issue Encountered']);
                            exit();
                        }
                    } else {
                        $this_product_variant = array(
                            'product_id' => $product['product_id'], 
                            'price' => $variant_price[$key], 
                            'price' => $variant_price[$key], 
                            'discount_price' => $variant_discount_price[$key],
							'size' => $variant_size[$key],
							'qty' => $variant_qty[$key],
                        );
                        if(!$this->db->where('id', $variant_id[$key])->update('variants', $this_product_variant)){
                            echo json_encode(['status'=>0, 'msg' => 'Product Variant Update Issue Encountered']);
                            exit();
                        }
                    }
                    // echo $key."=>".$option_names[$key]." => ".$value;
                }
            }
            if ($product['warranty'] == 'yes') {
                $warrantyData['period'] = $product['warranty_period'];
                $warrantyData['detail'] = $product['warranty_detail'];
                if ($this->db->get_where('warranty', ['product_id' => $product['product_id']])->row()) {
                    $this->db->where('product_id', $product['product_id'])->update('warranty', $warrantyData);
                } else {
                    $warrantyData['product_id'] = $product['product_id'];
                    $this->db->insert('warranty', $warrantyData);
                }
                unset($product['warranty']);
                unset($product['warranty_period']);
                unset($product['warranty_detail']);
            } else {
                $this->db->where('product_id', $product['product_id'])->delete('warranty');
                unset($product['warranty']);
                unset($product['warranty_period']);
                unset($product['warranty_detail']);
            }

            $update = $this->db->where('product_id', $product['product_id'])->update('products', $product);
            if($update){
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You updated a product with name ".$product['name']." at ".date('Y-m-d H:i:s a');
                $this->ActivityModel->createLog($log);
                echo json_encode(['status'=>1, 'msg'=>'Product Updated Successfully', 'redirect'=>site_url('/seller/product/all')]);
            }else{
                echo json_encode(['status'=>0, 'msg'=>'An Error Occurred While Updating This Product']);
            }
        }else if ($param1 == 'store') {

            // foreach($this->input->post() as $posts){
            //     if(count($posts) == 0 || strlen($posts) == 0){
            //         echo json_encode(['status' => 0, 'msg' => 'All field are required!', 'reload' => 'noreload']);
            //         exit();
            //     }
            // }

            $imagedir = FCPATH.'/public/images/products/';
            $newproduct = $this->input->post();
            // echo json_encode($newproduct); exit();
            $newproduct['owner_id'] = $this->session->userdata('user')->user_id;
            $newproduct['code'] = random_string('numeric', 7);
            $newproduct['status'] = 'pending';
            $newproduct['product_id'] = 'pro'.random_string('numeric', 7);
            $newproduct['created_at'] = date('Y-m-d H:i:s a');

            $variant_size = $this->input->post('variant_size');
            $variant_price = $this->input->post('variant_price');
            $variant_discount_price = $this->input->post('variant_discount_price');
            $variant_qty = $this->input->post('variant_qty');
            

            $product_image_dir = $imagedir.$newproduct['code'];
            // echo $product_image_dir;

            if (!file_exists($product_image_dir)) {
                mkdir($product_image_dir);
            }

            $i = 0;
            // echo json_encode($_FILES); exit();
            $len = count($_FILES['product_image']['tmp_name']);
            $uploaded = false;
            while ($i < $len) {
                $imgn = $i+1;
                $upload = move_uploaded_file($_FILES['product_image']['tmp_name'][$i], $product_image_dir.'/0'.$imgn.'.jpg');
                if (!$upload) {
                    if (file_exists($product_image_dir)) {
                        rmdir($product_image_dir);
                    }
                    echo json_encode(['msg'=>'An error occurred while uploading product image Maybe an invalid image is detected']);
                    die();
                } else {
                    $uploaded = true;
                    $i++;
                }

            }
            if ($variant_size && $variant_price) {
                // echo json_encode($this->input->post('option_values'));
                foreach ($variant_price as $key => $value) {
                    $this_product_variant = array(
                        'product_id' => $newproduct['product_id'], 
                        'price' => $variant_price[$key], 
                        'price' => $variant_price[$key], 
                        'discount_price' => $variant_discount_price[$key],
                        'size' => $variant_size[$key],
                        'qty' => $variant_qty[$key]
                    );
                    if (!$this->db->insert('variants', $this_product_variant)) {
                        echo json_encode(['status'=>0, 'msg' => 'Product Variant Creating Issue Encountered']);
                        exit();
                    } else {
                        unset($newproduct['variant_size']);
                        unset($newproduct['variant_price']);
                        unset($newproduct['variant_discount_price']);
						unset($newproduct['variant_id']);
						unset($newproduct['variant_qty']);
                    }
                    // echo $key."=>".$option_names[$key]." => ".$value;
                }
            }
            // exit();
            $savedtodb = $this->ProductModel->createNewProduct($newproduct);
            if ($upload && $savedtodb) {
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You created a new product with name ".$newproduct['name']." at ".date('Y-m-d H:i:s a');
                $this->ActivityModel->createLog($log);
                echo json_encode(['status'=>1, 'msg'=>'Product Created Successfully', 'redirect'=>site_url('/seller/product/all')]);
            } else {
                $this->db->where(['product_id' => $newproduct['product_id']])->delete('product_options');
                echo json_encode(['status'=>0, 'msg'=>'An Error Occurred While Creating The Product Please Try Again']);
            }

        }else if ($param1 == 'delete') {
            $product = $this->ProductModel->getProductBy('code', $param2);
            if($this->ProductModel->deleteProduct($param2)){
                $log['owner_id'] = $this->session->userdata('user')->user_id;
                $log['action'] = "You deleted a product with id ".$product['name']." at ".date('Y-m-d H:i:s a');
                $this->ActivityModel->createLog($log);
                // redirect(site_url('/seller/product'));
                echo json_encode(['status'=>1, 'msg'=>'Product Deleted Successfully', 'redirect'=>site_url('/seller/product/all')]);
            }else{
                echo json_encode(['status'=>0, 'msg'=>'An Error Occurred While Deleting The Product Please Try Again']);
            }
        } else if ($param1 == 'variant' && $param2 == 'delete') {
			$variant_id = $param3;
			$response = array();
			if ($this->db->where('id', $variant_id)->delete('variants')) {
				if (!$response) {
					$response['status'] = 1;
					$response['msg'] = 'Variant Deleted Successfully';
					$response['redirect'] = 'reload';
				}
			} else {
				if (!$response) {
					$response['status'] = 0;
					$response['msg'] = 'An error occurred while deleting varaint';
					$response['redirect'] = 'noreload';
				}
			}
			echo json_encode($response);
		} else {
            $this->product('all');
        }
	}
	
	public function wallet ($action = 'my_wallet', $param2 = null) {
		if(!$this->isOnline()){$this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/seller/login'));};
        if($this->session->userdata('user')->loggedinas !== 'seller') redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
		$data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'seller'])->result();
		$this->load->model('WalletManager');
		$data['scripts'] = ['main.js', 'forms.js'];
		if ($action == 'my_wallet') {
            $data['page_title'] = ' Seller | Products | My Products';
            $data['wallet'] = $this->WalletManager->getWallet($this->session->userdata('user')->user_id);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/wallet/index', $data);
            $this->load->view('layouts/admin/foot', $data);
		} else if ($action == 'withdraw' && $param2 == null) {
			$data['page_title'] = ' Seller | Products | My Products';
            $data['wallet'] = $this->WalletManager->getWallet($this->session->userdata('user')->user_id);
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/wallet/withdraw', $data);
            $this->load->view('layouts/admin/foot', $data);
		} else if ($action == 'withdrawal') {

		} else if ($action == 'withdraw' && $param2 == 'store') {
			$withdrawalDatas = $this->input->post();
			foreach ($withdrawalDatas as $key => $withdrawalData) {
				if ($withdrawalDatas[$key] == '') {
					echo json_encode(['status' => 0, 'msg' => str_replace(['_', '-'], [' ', ' '], $key).' is required!', 'redirect' => 'noreload']);
					exit();
				}
			}
			// echo json_encode($withdrawalDatas); exit();
			$wallet = $this->WalletManager->getWallet($this->session->userdata('user')->user_id);
			if ($wallet->avail_balance < $withdrawalDatas['amount']) {
				echo json_encode(['status' => 0, 'msg' => 'Insufficient fund', 'redirect' => 'noreload']);
			} else {
				$newBalance = ($wallet->avail_balance - $withdrawalDatas['amount']);
				if ($this->db->where('user_id', $wallet->user_id)->update('wallet', ['avail_balance' => $newBalance])) {
					$withdrawalDatas['user_id'] = $this->session->userdata('user')->user_id;
					$withdrawalDatas['status'] = 'pending';
					if ($this->db->insert('withdrawal', $withdrawalDatas)) {
						echo json_encode(['status' => 1, 'msg' => 'Withdrawal have been placed successfully', 'redirect' => 'reload']);
					} else {
						echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later', 'redirect' => 'noreload']);
					}
				} else {
					echo json_encode(['status' => 0, 'msg' => 'An error occurred! Please try again later', 'redirect' => 'noreload']);
				}
			}
		}
	}

    public function log($param1 = 'all', $param2 = null){
        if(!$this->isOnline()){$this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/seller/login'));};
        if($this->session->userdata('user')->loggedinas !== 'seller') redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));

        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'seller'])->result();
        if($param1 == 'all'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['logs'] = $this->ActivityModel->getLogsBy('owner_id', $this->session->userdata('user')->user_id);
            $data['page_title'] = " | Seller | Activity Log | All Logs";
            $data['pt'] = "My Activity Logs";
            // $data['products'] = $this->ProductModel->getAllProducts();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/activity/all', $data);
            $this->load->view('layouts/admin/foot', $data);
        }

    }

    public function profile($param1 = 'view_profile', $param2 = null){
        if(!$this->isOnline()){redirect(site_url('/seller/login')); }
        if($this->session->userdata('user')->loggedinas !== 'seller') redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'seller'])->result();
        if($param1 == 'view_profile'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Profile | My Profile";
            $data['profile'] = $this->session->userdata('user');
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/profile/view_profile', $data);
            $this->load->view('layouts/admin/foot', $data);
        }

        if($param1 == 'edit_profile'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Profile | My Profile";
            $data['profile'] = $this->session->userdata('user');
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/profile/edit_profile', $data);
            $this->load->view('layouts/admin/foot', $data);
            // exit();
        }

        if($param1 == 'update'){
            $dddd = $this->input->post();

            $tocheck = ($param2 == 'users' || $param2 == 'contacts') ? 'user_id' : 'seller_id';
            if(!$this->db->get_where($param2, [$tocheck=>$this->session->userdata('user')->user_id])->row()){
                $this->db->insert($param2, [$tocheck=>$this->session->userdata('user')->user_id]);
            }
            // echo json_encode($tocheck); die();
            $update = $this->db->where($tocheck, $this->session->userdata('user')->user_id)->update($param2, $dddd);
            if($update){
                $loggedinas = $this->session->userdata('user')->loggedinas;
                $this->session->set_userdata('user', $this->db->get_where('users', ['user_id'=>$this->session->userdata('user')->user_id])->row());
                $this->session->userdata('user')->loggedinas = $loggedinas;
                echo json_encode(['status'=>1, 'msg'=>'Account Updated Successfully', 'redirect'=>'reload']);
            }else{
                echo json_encode(['status'=>0, 'msg'=>'An error occurred! Please try again later']);
            }
        }

        if ($param1 == 'add_bank_detail' && $param2 == null) {
            $bankDetails = $this->input->post();
            foreach ($bankDetails as $key => $bankDetail) {
                if (empty($bankDetail) || strlen($bankDetail) == 0) {
                    echo json_encode(['status' => 0, 'msg' => str_replace(['_'], [' '], $bankDetail).' is required', 'redirect' => 'noreload']);
                    exit();
                }
            }
            $bankDetails['user_id'] = $this->session->userdata('user')->user_id;
            if ($this->db->insert('bank_account_info', $bankDetails)) {
                echo json_encode(['status' => 1, 'msg' => 'Bank Account Added Successfully', 'redirect' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred', 'redirect' => 'noreload']);
            }
        }

        if ($param1 == 'update_bank_detail' && $param2 != null) {
            $bankDetails = $this->input->post();
            foreach ($bankDetails as $key => $bankDetail) {
                if (empty($bankDetail) || strlen($bankDetail) == 0) {
                    echo json_encode(['status' => 0, 'msg' => str_replace(['_'], [' '], $bankDetail).' is required', 'reload' => 'noreload']);
                    exit();
                }
            }
            $bankDetails['user_id'] = $this->session->userdata('user')->user_id;
            if ($this->db->where(['id' => $param2])->update('bank_account_info', $bankDetails)) {
                echo json_encode(['status' => 1, 'msg' => 'Bank Account Updated Successfully', 'reload' => 'reload']);
            } else {
                echo json_encode(['status' => 0, 'msg' => 'An Error Occurred', 'reload' => 'noreload']);
            }
        }
        
        if ($param1 == 'edit_bank_detail' && $param2 != null) {
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Admin | Profile | Edit Bank Account";
            $data['profile'] = $this->session->userdata('user');
            $data['bankDetailData'] = $this->db->get_where('bank_account_info', ['id' => $param2])->row();
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/profile/edit_profile', $data);
            $this->load->view('layouts/admin/foot', $data);
        }
    }


    public function orders($param1 = 'my_orders', $param2 = null, $param3 = null, $param4 = null){
        if(!$this->isOnline()){$this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/seller/login'));};
        if($this->session->userdata('user')->loggedinas !== 'seller') redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));

        $data['scripts'] = ['forms.js', 'main.js'];
        $data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'seller'])->result();

        if($param1 == 'my_orders'){
            $data['orders'] = $this->SellerOrderModel->findManyBy('buyer_id', $this->UserModel->Auth()->user_id)->collections;
            $data['page_title'] = ' Seller | Order | My Orders';
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/orders/my_orders', $data);
            $this->load->view('layouts/admin/foot', $data);
		}

		if($param1 == 'all_orders'){
            $data['orders'] = $this->SellerOrderModel->findManyBy('seller_id', $this->UserModel->Auth()->user_id)->collections;
            $data['page_title'] = ' Seller | Order | All Orders';
            $this->load->view('layouts/admin/head', $data);
            $this->load->view('layouts/admin/top_nav', $data);
            $this->load->view('seller/orders/all_orders', $data);
            $this->load->view('layouts/admin/foot', $data);
        }

        if($param1 === 'update' && $param2 === 'status'){
            // echo json_encode($this->input->post());
            // $_POST['status'] = $param4;
            $status = array();
            $order = $this->SellerOrderModel->findOrFail($param3)->collection;
            $order->status = $this->input->post('status');
            $order->msg = $this->SomeDBFunctions->getOrderStatusMessage($this->input->post('status'));
            // echo json_encode((array)$order);
            if($this->SellerOrderModel->update($param3, (array) $order)){
                $other_orders = $this->SellerOrderModel->findManyBy('order_id', $order->order_id)->collections;
                $ready_order = 0;
                foreach($other_orders as $other_order){
                    if($other_order->status === 'ready'){
                        $ready_order += 1;
                    }
                }
                if($ready_order == count($other_orders)){
                    $main_order = $this->OrderModel->findOrFail($order->order_id)->collection;
                    $main_order->status= 'active';
                    $main_order->msg = $this->SomeDBFunctions->getOrderStatusMessage($main_order->status);
                    if($this->OrderModel->update($order->order_id, (array)$main_order)){
                        $status['status'] = 1;
                        $status['msg'] = 'Order Status Have Been Changed to '.$order->status;
                        $status['redirect'] = 'reload';
                    }else{
                        $status['status'] = 0;
                        $status['msg'] = 'Sorry an error occured';
                    }
                }else{
                    $main_order = $this->OrderModel->findOrFail($order->order_id)->collection;
                    $main_order->status= 'processing';
                    $main_order->msg = $this->SomeDBFunctions->getOrderStatusMessage($main_order->status);
                    $this->OrderModel->update($order->order_id, (array)$main_order);
                    $status['status'] = 1;
                    $status['msg'] = 'Order Status Have Been Changed to '.$order->status;
                    $status['redirect'] = 'reload';
                }
            }
            echo json_encode($status);
        }

    }

    public function login(){
        $data['scripts'] = ['main.js', 'forms.js'];
        $data['page_title'] = ' Seller | Login';
        $this->load->view('layouts/admin/head', $data);
        $this->load->view('layouts/admin/top_nav', $data);
        $this->load->view('seller/login', $data);
        $this->load->view('layouts/admin/foot', $data);
    }

    public function register($step = 1){
        // $data['scripts'] = ['main.js', 'forms.js'];
        $data['page_title'] = ' Seller | Register';
        $data['step'] = $step;
        // $this->load->view('layouts/admin/head', $data);
        // $this->load->view('layouts/admin/top_nav', $data);
        $this->load->view('seller/register', $data);
        // $this->load->view('layouts/admin/foot', $data);
    }


    public function registration($step = 1) {
        if ($step == 1) {
            $newUserData = $this->input->post();
            
            foreach ($newUserData as $key => $userData) {
                if (empty($userData)) {
                    $this->session->set_flashdata('flag', 'warning');
                    $this->session->set_flashdata('msg', $key ." is required!");
                    redirect(site_url('seller/register/1'));
                }
            }
            if ($this->db->get_where('users', ['email' => $newUserData['email']])->row()) {
                $this->session->set_flashdata('flag', 'warning');
                $this->session->set_flashdata('msg', 'User already exist!');
                redirect(site_url('seller/register/1'));
            } else {
                $newUserData['user_id'] = 'CM_MERCHANT_'.random_string('numeric', 10);
                $newUserData['token'] = random_string('alnum', 32);
                $newUserData['active'] = 0;
                $newUserData['image'] = site_url('/public/images/users/p.png');
                $newUserData['password'] = md5($newUserData['password']);
                $newUserData['created_at'] = date('Y-m-d H:i:s a');
                $newUserData['acct_type'] = $newUserData['acct_type'].',buyer';
                $newUserData['step'] = '2';
                if ($this->db->insert('users', $newUserData)) {
                    $this->session->set_userdata('user_id', $newUserData['user_id']);
                    $this->session->set_flashdata('flag', 'success');
                    $this->session->set_flashdata('msg', 'Your are 3 steps away from being a seller on CMACBETH! Fill the next form to continue');
                    redirect(site_url('seller/register/2'));
                } else {
                    $this->session->set_flashdata('flag', 'danger');
                    $this->session->set_flashdata('msg', 'An Error Occurred! Please try again later.');
                    redirect(site_url('seller/register/1'));
                }
            }
            redirect(site_url('seller/register/2'));
        } else if ($step == 2) {
            $userContactData = $this->input->post();
            foreach ($userContactData as $key => $userData) {
                if (empty($userData)) {
                    $this->session->set_flashdata('flag', 'warning');
                    $this->session->set_flashdata('msg', $key ." is required!");
                    redirect(site_url('seller/register/1'));
                }
            }
            $userContactData['user_id'] = $this->session->userdata('user_id');
            if ($this->db->get_where('contacts', ['user_id' => $newUserData['user_id']])->row()) {
                if ($this->db->where('user_id', $userContactData['user_id'])->update('contacts', $userContactData)) {
                    $this->db->where('user_id', $this->session->userdata('user_id'))->update('users', ['step' => 3]);
                    $this->session->set_flashdata('flag', 'success');
                    $this->session->set_flashdata('msg', "You are 2 steps away from completing our registration! Fill the next form");
                    redirect(site_url('seller/register/3'));
                }
            } else {
                if ($this->db->insert('contacts', $userContactData)) {
                    $this->db->where('user_id', $this->session->userdata('user_id'))->update('users', ['step' => 3]);
                    $this->session->set_flashdata('flag', 'success');
                    $this->session->set_flashdata('msg', "You are 2 steps away from becoming a merchant! Fill the next form");
                    redirect(site_url('seller/register/3'));
                } else {
                    $this->session->set_flashdata('flag', 'danger');
                    $this->session->set_flashdata('msg', 'An Error Occurred! Please try again later.');
                    redirect(site_url('seller/register/2'));
                }
            }
            
            // var_dump($userContactData); exit();
            // redirect(site_url('seller/register/3'));
        } else if ($step == 3) {
            $userBankInfo = $this->input->post();
            foreach ($userBankInfo as $key => $userData) {
                if (empty($userData)) {
                    $this->session->set_flashdata('flag', 'warning');
                    $this->session->set_flashdata('msg', $key ." is required!");
                    redirect(site_url('seller/register/3'));
                }
            }
            $userBankInfo['user_id'] = $this->session->userdata('user_id');
            if ($this->db->get_where('bank_account_info', ['user_id' => $userBankInfo['user_id'], 'bank_name' => $userBankInfo['bank_account_number']])) {
                $this->db->where('user_id', $this->session->userdata('user_id'))->update('users', ['step' => 4]);
                $this->session->set_flashdata('flag', 'success');
                $this->session->set_flashdata('msg', "You are a little bit step away from completing your registration");
                redirect(site_url('seller/register/4'));
            }
            if ($this->db->insert('bank_account_info', $userBankInfo)) {
                $this->db->where('user_id', $this->session->userdata('user_id'))->update('users', ['step' => 3]);
                $this->session->set_flashdata('flag', 'success');
                $this->session->set_flashdata('msg', "You are a little bit step away from completing your registration");
                redirect(site_url('seller/register/4'));
            } else {
                $this->session->set_flashdata('flag', 'danger');
                $this->session->set_flashdata('msg', 'An Error Occurred! Please try again later.');
                redirect(site_url('seller/register/3'));
            }
        } else if ($step == 5) {
            $credentialData = $this->input->post();
            foreach ($credentialData as $key => $userData) {
                if (empty($userData)) {
                    $this->session->set_flashdata('flag', 'warning');
                    $this->session->set_flashdata('msg', $key ." is required!");
                    redirect(site_url('seller/register/4'));
                }
            }
            // $credential_name = $_FILES['credential']['name'];
            // $credential_tmp_name = $_FILES['credential']['tmp_name'];
            $uploadDir = APPPATH.'/../public/images/users/credentials';
            if (is_dir($uploadDir)) {
                if (move_uploaded_file($_FILES["credential"]["tmp_name"], $uploadDir.'/'.$_FILES["credential"]["name"])) {
                    $credentialData['credential_value'] = site_url('/public/images/credentials/'.$_FILES["credential"]["name"]);
                    $credentialData['user_id'] = $this->session->userdata('user_id');
                    if ($this->db->insert('credentials', $credentialData)) {
                        $this->db->where('user_id', $this->session->userdata('user_id'))->update('users', ['step' => 0]);
                        $this->session->set_flashdata('flag', 'success');
                        $this->session->set_flashdata('msg', "Registration Completed! You will be notified when you account have been verified!");
                        $this->session->unset_userdata('user_id');
                        redirect(site_url('seller/register/4'));
                    } else {
                        $this->session->set_flashdata('flag', 'danger');
                        $this->session->set_flashdata('msg', "An error occurred! Please try again");
                        redirect(site_url('seller/register/4'));
                    }
                }
            } else {
                $this->session->set_flashdata('flag', 'warning');
                $this->session->set_flashdata('msg', "There is a problem with the file you uploaded");
                redirect(site_url('seller/register/4'));
            }
            // var_dump($_FILES['credential']);
            // var_dump($this->input->post());
            // redirect(site_url('seller/login'));
        } else if ($step == 4) {
            $sellingData = $this->input->post();
            foreach ($sellingData as $key => $userData) {
                if (empty($userData)) {
                    $this->session->set_flashdata('flag', 'warning');
                    $this->session->set_flashdata('msg', $key ." is required!");
                    redirect(site_url('seller/register/4'));
                }
            }
            $uploadDir = APPPATH.'/../public/images/brands/';
            if (is_dir($uploadDir)) {
                if (move_uploaded_file($_FILES["logo"]["tmp_name"], $uploadDir.'/'.$_FILES["logo"]["name"])) {
                    $sellingData['logo'] = site_url('/public/images/brands/'.$_FILES["logo"]["name"]);
                    $sellingData['seller_id'] = $this->session->userdata('user_id');
                    if ($this->db->insert('sellers', $sellingData)) {
                        $this->db->where('user_id', $this->session->userdata('user_id'))->update('users', ['step' => 5]);
                        $this->session->set_flashdata('flag', 'success');
                        $this->session->set_flashdata('msg', "You are one step away from completing your registration");
                        redirect(site_url('seller/register/5'));
                    } else {
                        $this->session->set_flashdata('flag', 'danger');
                        $this->session->set_flashdata('msg', "An error occurred! Please try again");
                        redirect(site_url('seller/register/4'));
                    }
                }
            } else {
                $this->session->set_flashdata('flag', 'warning');
                $this->session->set_flashdata('msg', "There is a problem with the file you uploaded");
                redirect(site_url('seller/register/4'));
            }
        }
    }


}
