<?php

defined('BASEPATH') or exit('Direct Access not Allowed');

class GiftShop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->load->model('MailSender');
		$to['email'] = 'mwork063@gmail.com';
		$to['name'] = 'Kabir Toyyib';
		$msg['message'] = "<h1>Hello</h1>";
		$msg['subject'] = 'Mail Test';
		$this->MailSender->send_mail($to, $msg, 'html');
	}
}
