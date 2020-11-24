<?php
    defined('BASEPATH') OR exit('You are not allowed here');

    class MenuModel extends CI_Model {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function getMenu($acct_type){
            return $this->db->get_where('menus', ['acct_type'=>$acct_type])->result();
        }
    }
