<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyer extends CI_Controller {


    public function __construct(){
        parent::__construct();
    }

    public function index() {
        if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/buyer/login')); }
		if(!$this->isBuyer()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
		$this->revamp();
        $data['page_title'] = " Buyer | Home";
		$this->load->view('layouts/general/head.php', $data);
		$this->load->view('buyer/index', $data);	
		$this->load->view('layouts/general/foot.php', $data);
    }

    public function home(){
        $this->index();
    }

    public function isOnline(){
        if(!$this->session->userdata('user')) return false; else return true;;
    }

    public function cart($param1 = 'my_cart'){

        if($param1 == 'my_cart'){
            $data['scripts'] = ['main.js', 'forms.js'];
			$data['page_title'] = " | Buyer | Cart | My Cart";
			$this->revamp();
            $data['profile'] = $this->session->userdata('user');
            $this->sync_db_cart_to_cart();
            // if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/buyer/login')); }
            // if(!$this->isBuyer()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
            
            $this->load->view('layouts/general/head.php', $data);
            $this->load->view('buyer/cart/my_cart', $data);	
            $this->load->view('layouts/general/foot.php', $data);
        }
        
    }

    public function addtocart() {
        
        $product_id = $this->input->post();
        foreach ($product_id as $key => $value) {
            if (strlen($value) == 0 || empty($value)) {
                echo json_encode(['status' => 0, 'msg' => $key .' is required!', 'redirect' => 'noreload']);
            }
        }
        $productData = $this->db->get_where('products', ['status' => 'approved', 'product_id' => $product_id['product_id']])->row();
        foreach ($this->cart->contents() as $key => $cart_item) {
            $item = $this->cart->get_item($cart_item['rowid']);
            // var_dump($itemOptions);
            if ($item['options']['product_id'] == $product_id['product_id']) {
                if (($item['qty'] + $product_id['qty']) > 10) {
                    $new_cartcontent['qty'] = 10;
                } else {
                    $new_cartcontent['qty'] = $item['qty'] + $product_id['qty'];
                }
                $new_cartcontent['rowid'] = $item['rowid'];
                $new_cartcontent['options']['seller_id'] = $item['options']['seller_id'];
                $new_cartcontent['options']['product_id'] = $item['options']['product_id'];
                $new_cartcontent['options']['other_options'] = "";
                $new_cartcontent['options']['sorted'] = false;
                
                if ($this->cart->update($new_cartcontent)) {
                    $catupated = true;
                } else {
                    $catupated = false;
                }
                if ($catupated) {
                    $cart_item_list = $this->load->view('layouts/buyer/my_cart.php', null, true);
                    echo json_encode(['status' => 1, 'msg' => $productData->name.' have been added to cart!', 'redirect' => 'reload', 'cart_item_count' => count($this->cart->contents()), 'cart_item_list' => $cart_item_list]);
                    exit();
                }
            }
        }
        
        if ($productData) {
            $cart_item = (array) $productData;
            // echo json_encode($cart_item); exit();
            $data['id'] = 'PSSCART'.random_string('numeric', 5);
            $data['name'] = bin2hex($cart_item['name']);
            $data['options']['seller_id'] = $cart_item['owner_id'];
            $data['options']['product_id'] = $cart_item['product_id'];
            // $data['options']['other_options'] = $cart_item['oto'];
            $data['options']['means'] = $product_id['purchase_means'];
            $data['options']['sorted'] = false;
            $data['qty'] = $product_id['qty'];
			//$data['price'] = (int)str_replace(',', '', $cart_item['price']);
            if ((int) $cart_item['discount_price'] > 0) {
                $data['price'] = (int)str_replace(',', '', $cart_item['discount_price']);
            } else {
                $data['price'] = (int)str_replace(',', '', $cart_item['price']);
            }
            // echo json_encode(['status' => 0]+$data); exit();
            $rowid = $this->cart->insert($data);
            if ($rowid) {
                if ($this->sync_cart_to_db()) {
                    echo json_encode(
                        [
                            'status'=>1, 
                            'msg'=>hex2bin($data['name'])." is added to cart successfully", 
                            'redirect'=>'reload', 
                            'cart_len' => count($this->cart->contents())
                        ]
                    );
                } else {
                    $this->cart->remove($rowid);
                    echo json_encode(
                        [
                            'status'=>0, 
                            'msg'=>"Unable to add item to cart", 
                            'redirect'=>'noreload',
                        ]
                    );
                }
            } else {
                echo json_encode(['status'=>0, 'msg'=>"An error was encountered please try again later"]);
            }
        } else {
            echo json_encode(['status' => 0, 'msg' => 'Product not available', 'redirect' => 'noreload']);
        }
    }

    public function deletefromcart($rowid){
        // $rowid = $this->input->post();
        if($this->cart->remove($rowid)){
            if ($this->sync_cart_to_db()) {
                echo json_encode(['status'=>1, 'msg'=>"Product have been removed from cart", 'redirect'=>'reload']);
            } else {
                echo json_encode(['status'=>0, 'msg'=>"An error occurred please try again later"]);
            }
        }else{
            echo json_encode(['status'=>0, 'msg'=>"An error occurred please try again later"]);
        }
    }

    public function updatecart() {
        $datas = $this->input->post();
        $catupated = false;
        foreach ($datas['rowid'] as $key => $data) {
            $new_cartcontent['rowid'] = $data;
            $new_cartcontent['options']['seller_id'] = $datas['owner_id'][$key];
            $new_cartcontent['options']['product_id'] = $datas['product_id'][$key];
            $new_cartcontent['options']['other_options'] = $datas['oto'][$key];
            $new_cartcontent['options']['sorted'] = false;
            $new_cartcontent['qty'] = ($datas['qty'][$key] > 3) ? 3 : $datas['qty'][$key];
            if ($this->cart->update($new_cartcontent)) {
                $catupated = true;
            } else {
                $catupated = false;
            }
        }
        
        if ($catupated) {
            if ($this->sync_cart_to_db()) {
                echo json_encode(['status'=>1, 'msg'=>'Cart Content Updated Successfully', 'redirect'=>'reload']);
            } else {
                echo json_encode(['status'=>0, 'msg'=>'An error occurred! Please try again later']);
            }
        } else {
            echo json_encode(['status'=>0, 'msg'=>'An error occurred! Please try again later']);
        }
    }

    public function profile($param1 = 'view_profile', $param2 = 'users'){
        if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/buyer/login')); }
        if(!$this->isBuyer()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
        $this->revamp();
        $this->sync_db_cart_to_cart();
        $data['menus'] = $this->db->get_where('menus', ['acct_type'=>'buyer'])->result();
        if($param1 == 'view_profile'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Buyer | Profile | My Profile";
            $data['profile'] = $this->session->userdata('user');
            $this->load->view('layouts/general/head.php', $data);
            $this->load->view('buyer/profile/view_profile', $data);
            $this->load->view('layouts/general/foot.php', $data);
        } else if ($param1 == 'edit_profile'){
            $data['scripts'] = ['main.js', 'forms.js'];
            $data['page_title'] = " | Buyer | Profile | Edit Profile";
            $data['profile'] = $this->session->userdata('user');
            $this->load->view('layouts/general/head.php', $data);;
            $this->load->view('buyer/profile/edit_profile', $data);
            $this->load->view('layouts/general/foot.php', $data);
            // exit();
        } else if ($param1 == 'update' && $param2 == 'security') {
            $userData = $this->db->get_where('users', ['user_id' => $this->session->userdata('user')->user_id])->row();
            $oldPassword = $this->input->post('old_password');
            $newPassword = $this->input->post('new_password');
            $confirmPassword = $this->input->post('confirm_password');
            if (password_verify($oldPassword, $userData->password)) {
                if ($newPassword == $confirmPassword) {
                    $newData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                    if ($this->db->where(['user_id' => $userData->user_id])->update('users', $newData)) {
                        echo json_encode(['status' => 1, 'msg' => 'Password Changed Successfully', 'redirect' => 'reload']);
                    } else {
                        echo json_encode(['status' => 0, 'msg' => 'Unable to change password! Please try again later!', 'redirect' => 'noreload']);
                    }
                } else {
                    echo json_encode(['status' => 0, 'msg' => 'Password do not match', 'redirect' => 'noreload']);
                }
            } else {
                echo json_encode(['status' => 0, 'msg' => 'Incorrect Old Password', 'redirect' => 'noreload']);
            }
        } else if ($param1 == 'update'){
            $dddd = $this->input->post();
            
            $tocheck = ($param2 == 'users' || $param2 == 'contacts') ? 'user_id' : 'seller_id';
            if(!$this->db->get_where($param2, [$tocheck=>$this->session->userdata('user')->user_id])->row()) {
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
    }

    public function checkout() {
        if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/buyer/login')); }
		if(!$this->isBuyer()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
		$this->revamp();
		$userData = $this->session->userdata('user');
		// echo json_encode($this->input->post()); exit();
		$this->db->trans_start();				   
        $order = new OrderModel();
		$mycarts = @$this->cart->contents();							  
        $order->order_detail = serialize($this->cart->contents());
		$order->shipping_fee = ($this->input->post('pick_up') == '0') ? $this->input->post('shipping_fee') : 0;
        $order->total_amount = ($this->cart->total() + $order->shipping_fee);
        // $order->payment_type = $this->input->post('payment_type');
		$order->full_name = $this->input->post('full_name');
		$order->phone_number = $this->input->post('phone_number');														  
		$order->status = ($userData->cooperative_id == 'no_cooperative') ? 4 : 2;
        $order->isCooperative = ($userData->cooperative_id != 'no_cooperative') ? $userData->cooperative_id : 0;
		$order->shipping_address = $this->input->post('shipping_address');
        $order->order_id = "PSSORDER".random_string('nozero', 5);
        $order->buyer_id = $this->session->userdata('user')->user_id;
		$order->coupon_price = 0;						 
		
        
        if ($this->input->post('pick_up') == '1') {
            $order->shipping_fee == $order->shipping_fee;
            $order->shipping_address == 'Pick Up';
            $order->total_amount = $order->total_amount - $order->shipping_fee;
            // echo json_encode(['Shipping Is Pick Up']); exit();
        } else {
            // echo json_encode(['Shipping Is Not Pick Up']); exit();
            if (($order->shipping_address == 'Not Set' || strlen($order->shipping_address) == 0) || (strlen($order->shipping_fee) == 0 || $order->shipping_fee == 0)) {
                echo json_encode(['status' => 0, 'msg' => 'Shipping address information is required', 'redirect' => 'noreload']);
                exit();
                  }
		}
		if ($this->input->post('coupon_code') != '') {
			$code = $this->input->post('coupon_code');
			$codeData = $this->db->get_where('coupon_codes', ['coupon_code' => $code])->row();
			$today = date('Y-m-d H:i:s');
			if ($codeData) {
				// echo json_encode(['status' => 1, 'msg' => 'Coupon Code is Available!', 'redirect' => 'noreload']);
				$order->coupon_price = (($codeData->percentage/100)*($order->total_amount - $order->shipping_fee));
				$order->total_amount = ($order->total_amount - $order->shipping_fee) - $order->coupon_price;
				$order->coupon_code = $code;
				$this->db->where(['coupon_code' => $code])->update('coupon_codes', ['notu'=> $codeData->notu + 1]);
			} 
			// else if ($codeData && ($codeData->user_id == '' || $codeData->user_id == null) && ($codeData->expiry_date < $today)) {
			// 	echo json_encode(['status' => 0, 'msg' => 'Coupon Code has Expired!', 'redirect' => 'noreload']);
			// 	exit();
			// } else if ($codeData && ($codeData->user_id != '' && $codeData != null) && ($codeData->expiry_date < $today)) {
			// 	echo json_encode(['status' => 0, 'msg' => 'Coupon code have been used', 'redirect' => 'noreload']);
			// 	exit();
			// } else if ($codeData && ($codeData->user_id != '' && $codeData->user_id != null) && ($codeData->expiry_date > $today)) {
			// 	echo json_encode(['status' => 0, 'msg' => 'Coupon code have been used', 'redirect' => 'noreload']);
			// 	exit();
			// } 
			else {
				echo json_encode(['status' => 0, 'msg' => 'Invalid coupon code', 'redirect' => 'noreload']);
				exit();
			}
		}
        if ($this->input->post('phone_number') == 'Not Set' || $this->input->post('phone_number') == 0) {
            echo json_encode(['status' => 0, 'msg' => 'Phone Number Is Required', 'redirect' => 'noreload']);
            exit();
        } else if ($order->full_name == 'Not Set' || strlen($order->full_name) == 0) {
            echo json_encode(['status' => 0, 'msg' => 'Full Name Is Required!', 'redirect' => 'noreload']);
            exit();
		 } else if ($order->total_amount <= 30000) {
            echo json_encode(['status' => 0, 'msg' => 'Order amount must be more than ₦30,000', 'redirect' => 'noreload']);
            exit();
        }

        // echo json_encode($order); exit();
		$this->load->model('MailSender');
		$mailSent = false;
		$msg = array();
		$to = array();
		$msg['subject'] = "New Order Confirmation";
		if ($order->isCooperative == 'no_cooperative') {
            $msg['message'] = "<p>A new order have been placed with the information below:</p>";
            $msg['message'] .= "<br/>OrderId: ".$order->order_id."<br/>Phone Number: ".$this->input->post('phone_number');
            $msg['message'] .= "<br/>Shipping Address: ".$order->shipping_address;
            $msg['message'] .= "<br/>Full Name: ".$userData->full_name;
            $msg['message'] .= "<br/>Delivered To: ".$this->input->post('full_name');
            $msg['message'] .= "<br/>You are required to confirm the order<br/>";
			$msg['message'] .= "<a href='".site_url('admin/order/view_order/'.$order->order_id)."'>Click here</a> to confirm";
			$mailSent = false;
            $admins = $this->db->get_where('admins', ['acct_type' => 'admin'])->result();
            $tos = array();
			foreach ($admins as $key => $admin) {
				$to['name'] = $admin->email;
                $to['email'] = $admin->email;
                array_push($tos, $to);
            }
            if ($this->MailSender->send_mail($tos, $msg, 'html')) {
                $mailSent = true;
            } else {
                $mailSent = false;
            }
		} else {
            $tos = array();
			$cooperativeData = $this->db->get_where('cooperatives', ['cooperative_id' => $order->isCooperative])->row();
			$to['name'] = $cooperativeData->name;
            $to['email'] = $cooperativeData->email;
            array_push($tos, $to);
            $msg['message'] = "<p>A new order have been placed by one of your members. You are required to confirm the order.</p>";
            $msg['message'] .= "<br/>OrderId: ".$order->order_id."<br/>";
            $msg['message'] .= "Phone Number: ".$this->input->post('phone_number');
            $msg['message'] .= "<br/>Full Name: ".$userData->full_name;
            $msg['message'] .= "<br/>You are required to confirm the order<br/>";
			$msg['message'] .= "<a href='".site_url('cooperative/orders/view_order/'.$order->order_id)."'>Click here</a> to confirm";
			if ($this->MailSender->send_mail($tos, $msg, 'html')) {
				$mailSent = true;
			} else {
				$mailSent = false;
			}
		}
        
          $order->initialize()->save();
        if($mailSent && $this->db->trans_status() == true){
			$this->db->trans_commit();
			$sql1 = "";
			//insert details
			$order_id = $order->db->insert_id();
			foreach ($mycarts AS $mycartd) {
				$ord["product_id"] = $this->db->get_where('products', ['product_id' => $mycartd["options"]["product_id"]])->row()->id;
				$ord["product_name"] = hex2bin($mycartd["name"]);
				$ord["quantity"] =  $mycartd["qty"];
				$ord["price"] = $mycartd["price"];
				$ord["status"]	= 4;
				$ord["seller_id"] = $mycartd["options"]["seller_id"];
                $ord["date_time"] = date("Y-m-d H:i:s");
                $ord['order_id'] = $order_id;
                $ord['order_details_id'] = null;
                $ord['date_time'] = date("Y-m-d H:i:s");
                $this->db->insert('order_details', $ord);
                
            }
		
            $this->cart->destroy();
            $this->db->delete('cart', ['user_id' => $this->session->userdata('user')->user_id]);
            // redirect('buyer/orders/my_orders');
            echo json_encode(['status' => 1, 'msg' => 'Order placed successfully!', 'redirect' => site_url('buyer/orders/my_orders')]);
        } else {
			$this->db->trans_rollback();			   
            echo json_encode(['status' => 0, 'msg' => 'An error occurred! '.$this->db->error(), 'redirect' => 'noreload']);
        }
    }

    public function check_out() {
        if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/buyer/login')); }
		if(!$this->isBuyer()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
		$this->revamp();
        $data['page_title'] = " | Buyer | Checkout";
        $this->load->view('layouts/general/head.php', $data);
        $this->load->view('buyer/check_out', $data);	
        $this->load->view('layouts/general/foot.php', $data);
    }

    public function orders($param1 = 'my_orders', $param2 = null) {
        if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/buyer/login')); }
        if(!$this->isBuyer()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
        $this->revamp();
        $this->load->model('OrderModel', 'orderModel');
        // $data['menus'] = $this->db->get_where('menus', ['acct_type'=>'buyer'])->result();
        $data['scripts'] = ['main.js', 'forms.js'];
        if($param1 == 'my_orders') {
            $data['page_title'] = " | Buyer | My Orders";
            $data['profile'] = $this->session->userdata('user');
            $this->load->view('layouts/general/head.php', $data);
            $this->load->view('buyer/orders/my_orders', $data);	
            $this->load->view('layouts/general/foot.php', $data);
        } else if ($param1 == 'cancel' && $param2 != null) {
            // $msg = $this->SomeDBFunctions->getOrderStatusMessage($this->input->post('status'));
            if ($this->db->where(['id' => $param2])->update('orders', ['status' => 5])) {
                $this->session->set_flashdata('flag', 'success');
                $this->session->set_flashdata('msg', 'Order canceled successfully');
                redirect(site_url('buyer/orders/my_orders'));
            }
        } else if ($param1 == 'view_order' && $param2 != null) {
            $data['page_title'] = " | Buyer | Order | ".$param2;
            $data['profile'] = $this->session->userdata('user');
            $data['order'] = $this->db->get_where('orders', ['order_id' => $param2])->row();
            $this->load->view('layouts/general/head.php', $data);
            $this->load->view('buyer/orders/view_order', $data);	
            $this->load->view('layouts/general/foot.php', $data);
        }
        
    }


    public function get_shipping_fee($loc_id) {
        $locData = $this->db->get_where('shipping_fee', ['loc_id' => $loc_id])->row();
        $small_price = $locData->small_price;
        $medium_price = $locData->medium_price;
        $large_price = $locData->large_price;
        $totalFee = 0;
        $small = 0;
        $medium =0;
        $large = 0;
        
        foreach ($this->cart->contents() as $key => $item) {
            $productData = $this->db->get_where('products', ['product_id' => $item['options']['product_id']])->row();
            if ($productData->size_category == 'small') {
                $small += 1 * $item['qty'];
            } else if ($productData->size_category == 'medium') {
                $medium += 1 * $item['qty'];
            } else if ($productData->size_category == 'large') {
                $large += 1 * $item['qty'];
            }
        }

        if ($small == 1 && $medium == 1 && $large == 1) { // One Of Each Category
            $totalFee += $large_price;
        } else if ($small == 1 && $medium == 1 && $large == 0) { // One Of Small And Medium
            $totalFee += $medium_price;
        } else if ($small == 1 && $medium == 0 && $large == 1) { // One Of Small And Large
            $totalFee += $large_price;
        } else if ($small == 0 && $medium == 1 && $large == 1) {  // One Of Large And Medium
            $totalFee += $large_price;
        } else if ($small > 1 && $medium > 1 && $large > 1) {  // Multiple Of All
            $totalFee += $large_price*1.5;
        } else if (($small == 0 || $small == 1) && $medium > 1 && $large > 1) {  // Multiples Of Medium And Multiple Large
            $totalFee += $large_price*1.5;
        } else if (($small == 0 || $small == 1) && $medium > 1 && $large == 1) { // Multiples Of Medium 1 Large
            $totalFee += $large_price+$medium_price;
        } else if ($small > 1 && $medium == 0 && $large > 1) {  // Multiple Of Small And Large
            $totalFee += $large_price*1.5;
        } else if ($small > 1 && $medium > 1 && $large == 0) { // Multiple Of Small And Medium
            $totalFee += $medium_price*1.5;
        } else if ($small > 1 && ($medium == 0 || $medium == 1) && $large == 1) { // Multiple Small One Large
            $totalFee += ($small_price * 1.5) + $large_price;
        } else if ($medium > 1 && $small == 0 && $large == 0) { // Multiple of Medium
            $totalFee += ($medium_price * 1.5);
        } else if ($small > 1 && $medium == 0 && $large == 0) { // Multiple of Small
            $totalFee += ($small_price * 1.5);
        } else if ($large > 1 && $small == 0 && $medium == 0) { // Multiple of Large
            $totalFee += ($large_price * 1.5);
        } else if ($medium == 1 && $small == 0 && $large == 0) { // One Medium
            $totalFee += ($medium_price);
        } else if ($small == 1 && $medium == 0 && $large == 0) { // One Small
            $totalFee += ($small_price);
        } else if ($large == 1 && $small == 0 && $medium == 0) {  // One Large
            $totalFee += ($large_price);
        } else if ($medium > 1 && ($small == 1 || $small == 0) && $large == 0) { // Multiple Medium One Small/No Small No Large
            $totalFee += ($medium_price);
        } else if ($large > 1 && $medium == 0 && $small == 1) {
            $totalFee += ($large_price * 2);
        }

        echo json_encode(['fee' => $totalFee, 'small' => $small, 'medium' => $medium, 'large' => $large]);
            
    }

    public function login($ref = '') {
        if ($this->session->userdata('user')) {
            redirect(site_url());
        } else {
            if ($this->input->post()) {
                $email = $this->input->post('email');
                $pass = $this->input->post('password');
                $userinfo = $this->db->get_where('users', ['email'=>$email])->row();
                if ($userinfo && password_verify($pass, $userinfo->password)) {
                    if ($userinfo->step == 0) {
                        $userinfo->loggedinas = 'buyer';
                        $this->session->set_userdata('user', $userinfo);
                        // $this->session->userdata('user')->loggedinas = 'buyer';
                        $url = ($this->session->tempdata('rfrom')) ? $this->session->tempdata('rfrom') : site_url();
                        if ($this->session->tempdata('rfrom')) {
                            $this->session->unset_tempdata('rfrom');
                        }
                        // echo json_encode($this->session->userdata('user')); exit();
                        $this->sync_cart_to_db();
                        $this->sync_db_cart_to_cart();
                        echo json_encode(['status' => 1, 'msg' => 'Login Successful', 'redirect' => $url]);
                        // redirect($url);
                    } else if ($userinfo->step == 1) {
                        echo json_encode(['status' => 0, 'msg' => 'Your account is awaiting Your Co-operative admin approval', 'redirect' => 'noreload']);
                    } else if ($userinfo->step == 2) {
                        echo json_encode(['status' => 0, 'msg' => 'Your account is not active, check your mail for confirmation message.', 'redirect' => 'noreload']);
                    } else {
                        if ($userData->step == 3) {
                            echo json_encode(['status' => 0, 'msg' => 'Your account is suspended', 'redirect' => 'noreload']);
                        }
                        if ($userData->step == 4) {
                            echo json_encode(['status' => 0, 'msg' => 'Your account is suspended by your cooperative admin', 'redirect' => 'noreload']);
                        }
                    }
                }else{
                    echo json_encode(['status' => 0, 'msg' => 'Login Credentials Not Correct', 'redirect' => 'noreload']);
                    // redirect(site_url('buyer/login'));
                }
            } else {
                $data['ref'] = $ref;
                $data['scripts'] = ['main.js', 'forms.js'];
                $data['page_title'] = ' Buyer | Login';
                $this->load->view('layouts/general/head.php', $data);
                $this->load->view('buyer/login', $data);
                $this->load->view('layouts/general/foot.php', $data);
            }
        }
    }

    public function sync_db_cart_to_cart() {
        // $carts = $this->db->get('cart')->result();
        if ($this->session->userdata('user')) {
            $userData = $this->session->userdata('user');
            if ($this->cart->contents() > 0) {
                foreach ($this->cart->contents() as $key => $cartData) {
                    $data['id'] = $cartData['id'];
                    $data['name'] = $cartData['name'];
                    $data['options']['seller_id'] = (isset($cartData['options']['seller_id'])) ? $cartData['options']['seller_id'] : '';
                    $data['options']['product_id'] = (isset($cartData['options']['product_id'])) ? $cartData['options']['product_id'] : '';
                    $data['options']['other_options'] = (isset($cartData['options']['other_options'])) ? $cartData['options']['other_options'] : '';
                    $data['options']['means'] = (isset($cartData['options']['means'])) ? $cartData['options']['means'] : '';
                    $data['options']['sorted'] = false;
                    $data['qty'] = $cartData['qty'];
                    $data['price'] = (int)str_replace(',', '', $cartData['price']);
                    // echo json_encode($data);
                    $rowid = $this->cart->insert($data);
                }
            }
            $cart = $this->db->get_where('cart', ['user_id' => $userData->user_id])->row();
            if ($cart) {
                $cartDatas = json_decode($cart->cart_item);
                $this->cart->destroy();
                foreach ($cartDatas as $key => $cartData) {
                    $data['id'] = $cartData->id;
                    $data['name'] = $cartData->name;
                    $data['options']['seller_id'] = (isset($cartData->options->seller_id)) ? $cartData->options->seller_id : '';
                    $data['options']['product_id'] = (isset($cartData->options->product_id)) ? $cartData->options->product_id : '';
                    $data['options']['other_options'] = (isset($cartData->options->other_options)) ? $cartData->options->other_options : '';
                    $data['options']['means'] = (isset($cartData->options->means)) ? $cartData->options->means : '';
                    $data['options']['sorted'] = false;
                    $data['qty'] = $cartData->qty;
                    $data['price'] = (int)str_replace(',', '', $cartData->price);
                    // echo json_encode($data);
                    $rowid = $this->cart->insert($data);
                }
                // $this->sync_cart_to_db();
            }
        }
    }


    public function sync_cart_to_db() {
        if ($this->session->userdata('user') && count($this->cart->contents()) > 0) {// If User Is Online And Cart Is Not Empty
            $userData = $this->session->userdata('user');
            $cart['cart_item'] = json_encode((array)$this->cart->contents());
            if ($this->db->get_where('cart', ['user_id' => $userData->user_id])->row()) {
                if ($this->db->where(['user_id' => $userData->user_id])->update('cart',  $cart)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $cart['user_id'] = $userData->user_id;
                if ($this->db->insert('cart', $cart)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return true;
        }
    }


    public function log_in($token) {
        $userinfo = $this->db->get_where('users', ['token'=>$token])->row();
        if($userinfo){
            $this->session->set_userdata('user', $userinfo);
            $this->session->userdata('user')->loggedinas = 'buyer';
            $url = ($this->session->tempdata('rfrom')) ? $this->session->tempdata('rfrom') : site_url('/'.$this->session->userdata('user')->loggedinas.'/home');
            if($this->session->tempdata('rfrom')){
                $this->session->unset_tempdata('rfrom');
            }
            redirect($url);
        }else{
            redirect(site_url());
        }
    }

    public function register($ref = ''){
        $data['scripts'] = ['main.js', 'forms.js'];
        $data['page_title'] = ' Buyer | Register';
        $data['ref'] = $ref;
        $this->load->view('layouts/general/head.php', $data);
        $this->load->view('buyer/register', $data);
        $this->load->view('layouts/general/foot.php', $data);
    }

    public function logout(){
        $this->session->unset_userdata('user');
        $this->cart->destroy();
        redirect(site_url());
    }

    public function isBuyer(){
        // if($this->session->)
        $acct_types = (array) explode(',', $this->session->userdata('user')->acct_type);
        if(in_array('buyer', $acct_types)){
            return true;
        }else{
            return false;
        }
	}
	
	public function revamp() {
		if ($this->session->userdata('user')) {
			$userId = $this->session->userdata('user')->user_id;
			// var_dump($userId); die('Error');
            $userData = $this->db->get_where('users', ['user_id' => $userId])->row();
            $userData->loggedinas = 'buyer';
			$this->session->set_userdata('user', $userData);
		}
	}
}
