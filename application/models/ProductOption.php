<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ProductOption extends CI_Model {
        
        public function __contruct(){
            parent::__contruct();
            $this->load->database();
        }


        public function getProductOptions($product_id){
            $options = $this->db->get_where('product_options', ['product_id' => $product_id])->result();
            return $options;
        }

        public function createProductOption($options){
            $createProductOptions = $this->db->insert('product_options', $options);
            if($createProductOptions){
                return true;
            }else{
                return false;
            }
        }

        public function updateProductOption($id, $options){
            $updateProductOptions = $this->db->where('id', $id)->update('product_options', $options);
            if($updateProductOptions){
                return true;
            }else{
                return false;
            }
        }
    }