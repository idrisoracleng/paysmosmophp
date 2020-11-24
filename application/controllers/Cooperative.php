<?php

defined('BASEPATH') or die('Direct access not allowed');

class Cooperative extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('CooperativeModel', 'cooperativeModel');
	}

	public function login(){
		if ($this->input->post()) {
			$email = $this->input->post('email', TRUE);
			$pass = $this->input->post('password', TRUE);
			
			$logInInfo = $this->db->get_where('admins', ['email'=>$email, 'acct_type' => 'cooperative'])->row();
			if ($logInInfo && password_verify($pass, $logInInfo->password)) {
				$userData = $this->db->get_where('cooperatives', ['cooperative_id' => $logInInfo->user_id])->row();
				
				$this->session->set_userdata('user', $userData);
				$this->session->userdata('user')->loggedinas = $logInInfo->acct_type;
				$this->session->userdata('user')->acct_type = $logInInfo->acct_type;
				$url = ($this->session->tempdata('rfrom')) ? $this->session->tempdata('rfrom') : site_url('/'.$this->session->userdata('user')->loggedinas.'/index');
				if($this->session->tempdata('rfrom')){
					$this->session->unset_tempdata('rfrom');
				}
				echo json_encode(['status'=>1, 'msg' => 'Login Successful', 'redirect' => $url]);
				
			}else{
				echo json_encode(['status'=>0, 'msg' => 'Login Credentials is Invalid. Please Check your email and password', 'redirect' => 'noreload']);
			}
		} else {
			$data['scripts'] = ['main.js', 'forms.js'];
			$data['page_title'] = " | Cooperative | Login";
			$this->load->view('layouts/admin/head', $data);
			$this->load->view('layouts/admin/top_nav', $data);
			$this->load->view('cooperative/login', $data);
			$this->load->view('layouts/admin/foot', $data);
			// session_destroy();
		}
	}

	public function home() {
		$this->index();
	}

	public function index () {
		if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/cooperative/login'));}
		if(!$this->isCooperativeAdmin()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
		// var_dump($this->session->userdata('user'));
		$data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'cooperative', 'active' => 1])->result();
		$data['page_title'] = " | Cooperative | Home";
		$data['scripts'] = ['main.js', 'forms.js'];
		$this->load->view('layouts/admin/head', $data);
		$this->load->view('layouts/admin/top_nav', $data);
		$this->load->view('cooperative/index', $data);
		$this->load->view('layouts/admin/foot', $data);
	}

	public function members($param1 = 'members_list', $param2 = null, $param3 = null) {
		if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/cooperative/login'));}
		if(!$this->isCooperativeAdmin()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
		$data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'cooperative', 'active' => 1])->result();
		
		$data['scripts'] = ['main.js', 'forms.js'];
		$this->load->model('MailSender');
		if ($param1 == 'members_list' && $param2 == null) {
			$data['page_title'] = " | Cooperative | Members";
			$coopId = $this->session->userdata('user')->cooperative_id;

			$data['members'] = $this->cooperativeModel->getActiveCooperativeMembers($coopId)->result();
			
			$this->load->view('layouts/admin/head', $data);
			$this->load->view('layouts/admin/top_nav', $data);
			$this->load->view('cooperative/members/members_list', $data);
			$this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'declined' && $param2 == null) {
			$data['page_title'] = " | Cooperative | Members";
			$coopId = $this->session->userdata('user')->cooperative_id;

			$data['members'] = $this->cooperativeModel->getDeclinedCooperativeMembers($coopId)->result();
			$this->load->view('layouts/admin/head', $data);
			$this->load->view('layouts/admin/top_nav', $data);
			$this->load->view('cooperative/members/members_list', $data);
			$this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'pending' && $param2 == null) {
			$data['page_title'] = " | Cooperative | Members";
			$coopId = $this->session->userdata('user')->cooperative_id;

			$data['members'] = $this->cooperativeModel->getDeclinedCooperativeMembers($coopId)->result();
			$this->load->view('layouts/admin/head', $data);
			$this->load->view('layouts/admin/top_nav', $data);
			$this->load->view('cooperative/members/members_list', $data);
			$this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'approve' && $param2 != null) {

			$userData = $this->db->get_where('users', ['user_id' => $param2])->row();
			$cooperativeData = $this->cooperativeModel->getCooperative(['cooperative_id' => $userData->cooperative_id])->row();
			$msg['subject'] = "Account Suspension From ".$cooperativeData->name." Cooperative";
			$msg['subject'] = "Account Confirmation";
			$msg['message'] = "<p>You account have been confirmed. Continue to <a href='".site_url('buyer/cart/my_cart')."'>checkout</a></p>";
			// $msg['message'] .= "<a href='".site_url('admin/user/all')."'>Click here</a> to confirm";
			$mailSent = false;
			$to['name'] = $userData->full_name;
			$to['email'] = $userData->email;
			$tos = array();
			array_push($tos, $to);
			
			if ($this->MailSender->send_mail($tos, $msg, 'html')) {
				$mailSent = true;
			} else {
				$mailSent = false;
			}
			if ($mailSent && $this->db->where(['member_id' => $param2])->update('cooperative_member', ['approved' => 1]) && $this->db->where(['user_id' => $param2])->update('users', ['step' => 0, 'active' => 1])) {
				echo json_encode(['status' => 1, 'msg' => 'Member approved successfully', 'redirect' => 'reload']);
			} else {
				echo json_encode(['status' => 0, 'msg' => 'Unable to approve this user as a member of this cooperative! Please try again later ', 'redirect' => 'reload']);
			}

		} else if ($param1 == 'suspend' && $param2 != null) {
			$userData = $this->db->get_where('users', ['user_id' => $param2])->row();
			$cooperativeData = $this->cooperativeModel->getCooperative(['cooperative_id' => $userData->cooperative_id])->row();
			$msg['subject'] = "Account Suspension From ".$cooperativeData->name." Cooperative";
			$msg['message'] = "<p>You account have been suspended by your Cooperative Admin";
			// $msg['message'] .= "<a href='".site_url('admin/user/all')."'>Click here</a> to confirm";
			$mailSent = false;
			$to['name'] = $userData->full_name;
			$to['email'] = $userData->email;
			$tos = array();
			array_push($tos, $to);
			
			if ($this->MailSender->send_mail($tos, $msg, 'html')) {
				$mailSent = true;
			} else {
				$mailSent = false;
			}
			if ($mailSent && $this->db->where(['member_id' => $param2])->update('cooperative_member', ['approved' => 0]) && $this->db->where(['user_id' => $param2])->update('users', ['step' => 4])) {
				echo json_encode(['status' => 1, 'msg' => 'Member suspended successfully', 'redirect' => 'reload']);
			} else {
				echo json_encode(['status' => 0, 'msg' => 'Unable to suspend this user as a member of this cooperative! Please try again later ', 'redirect' => 'reload']);
			}
		} else if ($param1 == 'activate' && $param2 != null) {
			$userData = $this->db->get_where('users', ['user_id' => $param2])->row();
			$cooperativeData = $this->cooperativeModel->getCooperative(['cooperative_id' => $userData->cooperative_id])->row();
			$msg['subject'] = "Account Re-Activation From ".$cooperativeData->name." Cooperative";
			$msg['message'] = "<p>You account have been reactivated by your Cooperative Admin";
			// $msg['message'] .= "<a href='".site_url('admin/user/all')."'>Click here</a> to confirm";
			$mailSent = false;
			$to['name'] = $userData->full_name;
			$to['email'] = $userData->email;
			$tos = array();
			array_push($tos, $to);
			
			if ($this->MailSender->send_mail($tos, $msg, 'html')) {
				$mailSent = true;
			} else {
				$mailSent = false;
			}
			if ($this->db->where(['member_id' => $param2])->update('cooperative_member', ['approved' => 1]) && $this->db->where(['user_id' => $param2])->update('users', ['step' => 0])) {
				echo json_encode(['status' => 1, 'msg' => 'Member activated successfully', 'redirect' => 'reload']);
			} else {
				echo json_encode(['status' => 0, 'msg' => 'Unable to activate this user as a member of this cooperative! Please try again later ', 'redirect' => 'reload']);
			}
		} else if ($param1 == 'decline' && $param2 != null) {
			$userData = $this->db->get_where('users', ['user_id' => $param2])->row();
			$cooperativeData = $this->cooperativeModel->getCooperative(['cooperative_id' => $userData->cooperative_id])->row();
			$msg['subject'] = "Account Declination From ".$cooperativeData->name." Cooperative";
			$msg['message'] = "<p>You account have been declined by your Cooperative Admin";
			// $msg['message'] .= "<a href='".site_url('admin/user/all')."'>Click here</a> to confirm";
			$mailSent = false;
			$to['name'] = $userData->full_name;
			$to['email'] = $userData->email;
			$tos = array();
			array_push($tos, $to);
			
			if ($this->MailSender->send_mail($tos, $msg, 'html')) {
				$mailSent = true;
			} else {
				$mailSent = false;
			}
			if ($this->db->where(['member_id' => $param2])->update('cooperative_member', ['approved' => 0]) && $this->db->where(['user_id' => $param2])->update('users', ['step' => 5])) {
				echo json_encode(['status' => 1, 'msg' => 'Member declined successfully', 'redirect' => 'reload']);
			} else {
				echo json_encode(['status' => 0, 'msg' => 'Unable to decline this user as a member of this cooperative! Please try again later ', 'redirect' => 'reload']);
			}
		}
	}


	public function orders ($param1 = 'order_list', $param2 = null, $param3 = null) {
		if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/cooperative/login'));}
		if(!$this->isCooperativeAdmin()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
		$data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'cooperative', 'active' => 1])->result();
		
		$data['scripts'] = ['main.js', 'forms.js'];

		if ($param1 == 'order_list' && $param2 == null) {
			$coopId = $this->session->userdata('user')->cooperative_id;
			$data['page_title'] = " | Cooperative | Orders";
			$data['orders'] = $this->db->get_where('orders', ['isCooperative' => $coopId])->result();
			$this->load->view('layouts/admin/head', $data);
			$this->load->view('layouts/admin/top_nav', $data);
			$this->load->view('cooperative/orders/order_list', $data);
			$this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'view_order' && $param2 != null) {
			$data['order'] = $this->OrderModel->findOrFail($param2)->collection;
			$data['page_title'] = " | Cooperative | Orders | View Order";
			// $data['orders'] = $this->OrderModel->get()->collections;
			$this->load->view('layouts/admin/head', $data);
			$this->load->view('layouts/admin/top_nav', $data);
			$this->load->view('cooperative/orders/view_order', $data);
			$this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'approve' && $param2 != null) {
			$orderData = $this->db->get_where('orders', ['order_id' => $param2])->row();
			$cooperativeData = $this->db->get_where('cooperatives', ['cooperative_id' => $orderData->isCooperative])->row();
			$this->load->model('MailSender'); // Load MailSender Library
			$mess['subject'] = "New Order Approval";
			$mess['message'] = "<p>Order #".$param2." have been approved by ".$cooperativeData->name." cooperative admin. Start processing the order</p>";
			$mess['message'] .= "<a href='".site_url('admin/order/view_order/'.$param2)."'>Click here</a> to confirm";
			$mailSent = false;
			$tos = array();
			$admins = $this->db->get_where('admins', ['acct_type' => 'admin'])->result();
			foreach ($admins as $key => $admin) {
				$to['name'] = $admin->email;
				$to['email'] = $admin->email;
				array_push($tos, $to);
			}
			if ($this->MailSender->send_mail($to, $mess, 'html')) {
				$mailSent = true;
			} else {
				$mailSent = false;
			}
			$userData = $this->db->get_where('users', ['user_id' => $orderData->buyer_id])->row();
			$msg['subject'] = "New Order Approval";
			$msg['message'] = "<p>Your Order #".$param2." have been approved by ".$cooperativeData->name." cooperative admin</p>";
			$msg['message'] .= "<a href='".site_url('buyer/orders/my_orders	')."'>Click here</a> to confirm";
			$data = array(
				'name' => $userData->full_name,
				'email' => $userData->email,
			);
			// array_push($tos, $data);
			if ($this->MailSender->send_mail($data, $msg, 'html')) {
				$mailSent = true;
			} else {
				$mailSent = false;
			}
			if ($mailSent) {
				if ($this->db->where(['order_id' => $param2])->update('orders', ['status' => 0])) {
					echo json_encode(['status' => 1, 'msg' => 'Order approved successfully!', 'redirect' => 'reload']);
				} else {
					echo json_encode(['status' => 0, 'msg' => 'Unable to approve order! Please try again later', 'redirect' => 'reload']);
				}
			} else {
				echo json_encode(['status' => 0, 'msg' => 'Unable to approve order! Please try again later', 'redirect' => 'reload']);
			}
		} else if ($param1 == 'decline' && $param2 != null) {
			$this->load->model('MailSender'); // Load MailSender Library
			$msg['subject'] = "Order Declined";
			$msg['message'] = "<p>Your order have been declined #".$param2."</p>";
			$msg['message'] .= "<a href='".site_url('buyer/orders/my_order/')."'>Click here</a> to confirm";
			$mailSent = false;
			$tos = array();
			$orderData = $this->db->get_where('orders', ['order_id' => $param2])->row();
			$userData = $this->db->get_where('users', ['user_id' => $orderData->buyer_id])->row();
			// $admins = $this->db->get_where('admins', ['acct_type' => 'admin'])->result();
			$to['name'] = $userData->full_name;
			$to['email'] = $userData->email;
			array_push($tos, $to);
			if ($this->MailSender->send_mail($tos, $msg, 'html')) {
				$mailSent = true;
			} else {
				$mailSent = false;
			}
			if ($mailSent) {
				if ($this->db->where(['order_id' => $param2])->update('orders', ['status' => 6])) {
					echo json_encode(['status' => 1, 'msg' => 'Order declined successfully!', 'redirect' => 'reload']);
				} else {
					echo json_encode(['status' => 0, 'msg' => 'Unable to decline order! Please try again later', 'redirect' => 'reload']);
				}
			} else {
				echo json_encode(['status' => 0, 'msg' => 'Unable to decline order! Please try again later', 'redirect' => 'reload']);
			}
		} else if ($param1 == 'get_payment_schedule') {
			$coopId = $this->session->userdata('user')->cooperative_id;
			$effectiveDate = strtotime("+5 months", strtotime(date("y-m-d")));
			echo $time = date("y/m/d", $effectiveDate);
		}
	}

	public function report($param1 = '', $param2 = '') {
		if(!$this->isOnline()){ $this->session->set_tempdata('rfrom', current_url()); redirect(site_url('/cooperative/login'));}
		if(!$this->isCooperativeAdmin()) redirect(site_url('/'.$this->session->userdata('user')->loggedinas.'/home'));
		$data['menus'] = $this->db->order_by('position', 'ASC')->get_where('menus', ['acct_type'=>'cooperative', 'active' => 1])->result();
		
		$data['scripts'] = ['main.js', 'forms.js'];
		$coopData = $this->session->userdata('user');
		$currentDate = date('Y-m-d H:i:s');
		// var_dump($coopData);

		if ($param1 ==  'order_report') {
			$sql = "SELECT * FROM orders as ord JOIN users as user ON ord.buyer_id = user.user_id WHERE ord.isCooperative = '$coopData->cooperative_id' AND ord.payment_due > '$currentDate'";

			$data['page_title'] = ' Cooperative : Order Report';
			$data['order_reports'] = $this->db->query($sql)->result();
			
			$this->load->view('layouts/admin/head', $data);
			$this->load->view('layouts/admin/top_nav', $data);
			$this->load->view('cooperative/report/order_report', $data);
			$this->load->view('layouts/admin/foot', $data);
		} else if ($param1 == 'download_orders_report') {
			// echo 'Downloading report';
			$date = date('Y-m-d H:i:s');
			$filename = $coopData->name.'_order_report_at_' . $date . '.xls';
			
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=\"$filename\"");

			$sql = "SELECT * FROM orders as ord JOIN users as user ON ord.buyer_id = user.user_id WHERE ord.isCooperative = '$coopData->cooperative_id' AND ord.payment_due > '$currentDate'";

			$order_reports = $this->db->query($sql)->result();

			echo '<table border="1">';
				echo "<tr>";
					echo "<th>Order ID</th>";
					echo "<th>Buyer Info</th>";
					echo "<th>Order Items</th>";
					echo "<th>Monthly Payment</th>";
				echo "</tr>";
				foreach($order_reports as $key => $order_report) {
					$order_details = unserialize($order_report->order_detail); 
					echo "<tr>";
						echo "<td>".$order_report->order_id."</td>";
						echo "<td>";
							echo "<p>Name: ".$order_report->full_name."</p>";
							echo "<p>Email: ".$order_report->email."</p>";
							echo "<p>Phone Number: ".$order_report->phone_number."</p>";
						echo "</td>";
						echo "<td>";
							foreach($order_details as $key => $orderItem) {
								echo "<p>".hex2bin($orderItem['name'])."</p>";
								echo "<p>N ".$this->cart->format_number($orderItem['price'])."</p>";
							}
						echo "</td>";
						echo "<td>";
							echo "<p>".$this->cart->format_number($order_report->total_amount/4)."</p>";
						echo "</td>";
					echo "</tr>";
				}
			echo '</table>';
		}
	}

	// Dont touch again
	public function isOnline(){
		if(!$this->session->userdata('user')) return false; else return true;;
	}

	public function logout(){
		$log['owner_id'] = $this->session->userdata('user')->user_id;
		$log['action'] = "You logged out of the system at ".date('Y-m-d H:i:s a');
		$this->ActivityModel->createLog($log);
		$this->session->unset_userdata('user');
		redirect(site_url('/admin/home'));
	}

	public function isCooperativeAdmin () {;
		if($this->session->userdata('user')->loggedinas == 'cooperative'){
			return true;
		}else{
			return false;
		}
	}

}
