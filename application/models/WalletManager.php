<?php
defined('BASEPATH') or die('Direct Access Not Allowed');


class WalletManager extends CI_Model {
	private $table = 'wallet';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getWallet($userId) {
		return $this->db->get_where($this->table, ['user_id' => $userId])->row();
	}
}
