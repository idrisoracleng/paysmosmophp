<?php

defined('BASEPATH') or die('Direct access not allowed!');


class DealsOfTheDayModel extends CI_Model {

    private $table = 'product_deals_of_the_day';
    public function __construct()
    {
        date_default_timezone_set('Africa/Lagos');
        parent::__construct();
        $this->load->database();
    }


    public function createDealOfTheDay($data) {
        return $this->db->insert($this->table, $data);
    }


    public function updateDealOfTheDay($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    
    public function removeDealOfTheDay($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }


    public function getDealsOfTheDay() {
		$date = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM ".$this->table." as deal JOIN products ON products.product_id = deal.product_id WHERE deal.start_time < '".$date."' AND deal.end_time > '$date'";
        // echo $sql;
        return $this->db->query($sql)->result_array();
    }


    public function getDealOfTheDay($id) {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function getDealOfTheDayWith($data) {
        return $this->db->get_where($this->table, $data)->result_array();
    }

    public function getActiveDealsOfTheDay() {
		$date = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM ".$this->table." as deal JOIN products ON products.product_id = deal.product_id WHERE deal.start_time < '".$date."' AND deal.end_time > '$date'";
        // echo $sql;
        return $this->db->query($sql)->result_array();
        // $res = $this->db->query($sql)->result_array();
        // var_dump(count($res));
    }
}
