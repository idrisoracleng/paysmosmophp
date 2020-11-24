<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	//	Home Page For The Store
	public function index()
	{
		
		$data['categories'] = $this->CategoryModel->getAllCategories();
		$data['products'] = $this->ProductModel->getAllProducts(6);
		$data['page_title'] = " Home : Buy and Pay Smo Smo";
		$this->load->view('layouts/general/head.php', $data);
		$this->load->view("index", $data);
		$this->load->view('layouts/general/foot.php', $data);
		
	}

	public function market() {
		$data['page_title'] = " Market : Buy and Pay Smo Smo";
		$data['categories'] = $this->CategoryModel->getAllCategories();
		$data['products'] = $this->ProductModel->getAllProducts();
		$this->load->view('layouts/general/head.php', $data);
		// $this->load->view('layouts/general/nav.php', $data);
		$this->load->view("index.php", $data);
		$this->load->view('layouts/general/foot.php', $data);
	}


	// // About Page
	public function about() {
		$data['page_title'] = " About : Buy and Pay Smo Smo";
		$this->load->view('layouts/general/head.php', $data);
		// $this->load->view('layouts/general/nav.php', $data);
		$this->load->view('about', $data);
		$this->load->view('layouts/general/foot.php', $data);
	}

	public function t_and_c(){
		$data['page_title'] = " Terms and Condition";
		$this->load->view('layouts/general/head.php', $data);
		// $this->load->view('layouts/general/nav.php', $data);
		$this->load->view('t_and_c', $data);
		$this->load->view('layouts/general/foot.php', $data);
	}

	public function faq(){
		$data['page_title'] = " Frequently Asked Questions";
		$this->load->view('layouts/general/head.php', $data);
		// $this->load->view('layouts/general/nav.php', $data);
		$this->load->view('faq', $data);
		$this->load->view('layouts/general/foot.php', $data);
	}

	public function delivery_remark(){
		$data['page_title'] = "Delivery Remark";
		$this->load->view('layouts/general/head.php', $data);
		// $this->load->view('layouts/general/nav.php', $data);
		$this->load->view('delivery_remark', $data);
		$this->load->view('layouts/general/foot.php');
	}

	public function privacy(){
		$data['page_title'] = " About";
		$this->load->view('layouts/general/head.php', $data);
		// $this->load->view('layouts/general/nav.php', $data);
		$this->load->view('privacy', $data);
		$this->load->view('layouts/general/foot.php', $data);
	}

	public function ask(){
		$data['page_title'] = "Ask Your Questions Here";
		// $this->load->view('layouts/general/head.php', $data);
		$this->load->view('layouts/general/nav.php', $data);
		$this->load->view('ask', $data);
		$this->load->view('layouts/general/foot.php');
	}

	public function p($name) {
		$pname = ucwords(str_replace(['_', '-'], [' ', ' '], $name));
		$data['page_title'] = $pname;
		$data['page'] = $this->db->get_where('pages', ['name' => $pname])->row();
		$this->load->view('layouts/general/head.php', $data);
		// $this->load->view('layouts/general/nav.php', $data);
		$this->load->view('c_p', $data);
		echo $name;
		$this->load->view('layouts/general/foot.php');
	}

	public function new_page(){
		$data['page_title'] = "New Cart";
		$this->load->view('layouts/general/head.php', $data);
		$this->load->view('new_page', $data);
		$this->load->view('layouts/general/foot.php', $data);
	}

	public function new_page1(){
		$data['page_title'] = "New Cart 2";
		$this->load->view('layouts/general/head.php', $data);
		// $this->load->view('layouts/general/nav.php', $data);
		$this->load->view('new_page1', $data);
		$this->load->view('layouts/general/foot.php', $data);
	}

	public function subscription ($param1 = 'news_letter_subscription') {
		if ($param1 == 'news_letter_subscription') {
			$emailData = $this->input->post();
			if ($this->db->get_where('news_letter', $emailData)->row()) {
				echo json_encode(['status' => 0, 'msg' => 'News Letter Subscription Successful', 'redirect' => 'noreload']);
			} else {
				if ($this->db->insert('news_letter', $emailData)) {
					$this->load->Model('MailSender');
					$to['name'] = $emailData['name'];
					$to['email'] = $emailData['email'];
					$msg['subject'] = 'News Letter Subscription';
					$msg['message'] = '<h5>Welcome To Paysmosmo News Letter Subscription</h5>';
					$msg['message'] .= '<p>You are seeing this message because you subscribed to our news letter.</p>';
					$msg['message'] .= '<p>You will receive mails on our new products and promos.</p>';
					$msg['message'] .= '<p>Thanks.</p>';
					if ($this->MailSender->send_mail($to, $msg, 'html')) {
						echo json_encode(['status' => 1, 'msg' => 'News Letter Subscription Successful. You have been added to our mailing list.', 'redirect' => 'noreload']);
					} else {
						$this->db->where($emailData)->delete('news_letter');
						echo json_encode(['status' => 0, 'msg' => 'Unable to add your email to our mailing list.', 'redirect' => 'noreload']);
					}
				} else {
					echo json_encode(['status' => 0, 'msg' => 'Unable to add your email to our mailing list.', 'redirect' => 'noreload']);
				}
			}
		}
	}

}
