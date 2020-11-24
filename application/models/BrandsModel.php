<?php

defined('BASEPATH') or die('Direct Access Not Allowed');


class BrandsModel extends CI_Model {

    private $table = 'brands';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function createBrand($data) {
        return $this->db->insert($this->table, $data);
    }

    public function getBrands() {
        return $this->db->get($this->table)->result_array();
    }

    public function getBrandBy($where) {
        return $this->db->get_where($this->table, $where)->row_array();
    }

    public function updateBrand($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function deleteBrand($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
}