<?php

defined('BASEPATH') or die('Direct Access Not Allowed');


class BannersModel extends CI_Model {

    private $table = 'banners';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function createBanner($data) {
        return $this->db->insert($this->table, $data);
    }

    public function getBanners() {
        return $this->db->get($this->table)->result_array();
    }

    public function getBannerBy($where) {
        return $this->db->get_where($this->table, $where)->row_array();
    }

    public function updateBanner($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function deleteBanner($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
}