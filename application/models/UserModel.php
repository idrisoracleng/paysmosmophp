<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    private $table = 'users';

	public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getAllUsers(){
        return $this->db->get($this->table)->result_array();
    }

    public function getUserBy($by, $key){
        return $this->db->where($by, $key)->get($this->table)->row_array();
    }

    public function getUsersBy($by, $key){
        return $this->db->where($by, $key)->get($this->table)->result_array();
    }

    public function getUserAtRandom(){
        return $this->db->query("SELECT * FROM ".$this->table." ORDER BY RAND() LIMIT 1")->row_array();
    }

    public function getUsersAtRandom($limit = 5){
        return $this->db->query("SELECT * FROM ".$this->table." ORDER BY RAND() LIMIT $limit")->result_array();
    }

    public function getUserOrders(){
        $userdata = $this->Auth();
        $orders = $this->OrderModel->findManyBy('buyer_id', $userdata->user_id);
        return $orders;
    }

    public function Auth(){
        if($this->session->userdata('user')){
            return $this->session->userdata('user');
        }else{
            return null;
        }
    }

    public function getSellerRating($product_id){
        $avg_rating = $this->db->where('seller_id', $product_id)->select('AVG(rate) as avg_rating')->from('seller_rating')->get()->row()->avg_rating;
        return ($avg_rating) ? $avg_rating : 0;
    }

    public function getUserStatus($userData) {
        $userData = (array) $userData;
        $this->load->model('CooperativeModel', 'cooperativeModel');
        $cooperativeData = ($userData['cooperative_id'] != 'no_cooperative') ? $this->cooperativeModel->getCooperative(['cooperative_id' => $userData['cooperative_id']])->row() : null;
        if ($userData['step'] == 1) {
            return "Awaiting ".$cooperativeData->name." Cooperative Admin Approval";
        } else if ($userData['step'] == 2) {
            return "Awaiting Admin Final Approval";
        } else if ($userData['step'] == 3) {
            return "Account is suspended";
        } else if ($userData['step'] == 0) {
            return "Account is active";
        } else if ($userData['step'] == 4) {
            return "Account is suspended by ".$cooperativeData->name." cooperative admin";
        } else if ($userData['step'] == 5) {
            return "Account is declined by ".$cooperativeData->name." cooperative admin";
        }
        return 'Unknown Status';
    }
}
