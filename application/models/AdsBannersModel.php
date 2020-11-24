<?php

defined('BASEPATH') or die('Direct Access Not Allowed');


class AdsBannersModel extends CI_Model {

    private $table = 'ads_banner';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function createAdsBanner($data) {
        return $this->db->insert($this->table, $data);
    }

    public function getAdsBanners() {
        return $this->db->get($this->table)->result_array();
    }

    public function getAdsBannerBy($where) {
        return $this->db->get_where($this->table, $where)->row_array();
    }

    public function getAdsBannersBy($where) {
        return $this->db->get_where($this->table, $where)->result_array();
    }

    public function updateAdsBanner($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function deleteAdsBanner($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
}