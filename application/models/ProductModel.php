<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function createNewProduct($data){
        // if($data['warranty'] == 'yes'){
        //     $war['period'] = $data['warranty_period'];
        //     $war['detail'] = $data['warranty_detail'];
        //     $war['product_id'] = $data['product_id'];
        //     unset($data['warranty_detail']);
        //     unset($data['warranty_period']);
        //     unset($data['product_image']);
        //     unset($data['vat']);
        //     unset($data['warranty']);
        //     $this->db->insert('warranty', $war);
        // }else if($data['warranty'] == 'no'){
        //     unset($data['vat']);
        //     unset($data['warranty']);
        // }
        return $this->db->insert('products', $data);
    }

    public function updateProduct($id, $data){
        return $this->db->where('code', $id)->update('products', $data);
    }

    public function updateProductViews($id){
        $product = $this->getProductBy('code', $id);
        $data['views'] = (int)$product['views'] + 1;
        return $this->updateProduct($product['code'], $data);
    }

    public function deleteProduct($id){
        $product = $this->getOnlyProduct($id);
        // var_dump($product);
        $images_cleared = false;
        $product_dir = FCPATH.'/public/images/products/'.$product['code'].'/';
        $images = array_diff(scandir($product_dir), ['.', '..']);
        // if(rmdir($product_dir)){
        //     $images_cleared = true;
        // }
        foreach($images as $image){
            // echo $image;
            if(file_exists($product_dir.$image)){
                // echo $product_dir.$image;/
                if(is_file($product_dir.$image)){
                    unlink($product_dir.$image);
                    // echo "Is File";
                }else{
                    rmdir($product_dir.$image);
                    // ec
                }
                $images_cleared = true;
            }else{
                $images_cleared = false;
            }
        }

        // $images_cleared = true;
        if($images_cleared){
            rmdir($product_dir);
            // echo "Iimage is cleared";
            return $this->db->delete('products', ['code' => $product['code']]);
        }else{
            // echo "Not Iimage is cleared";
            return $images_cleared;
        }
        // if(file_exists($subcatimage)) unlink($subcatimage);

	}

	public function approveProduct($id){
		return $this->db->where('code', $id)->update('products', ['status'=>'approved']);
	}

	public function unapproveProduct($id){
		return $this->db->where('code', $id)->update('products', ['status'=>'pending', 'featured' => 0]);
	}

	public function pauseProduct($id){
		return $this->db->where('code', $id)->update('products', ['status'=>'paused', 'featured' => 0]);
	}

    public function getAllProducts($limit = null){
        return $this->db->limit($limit)->join('users', 'products.owner_id = users.user_id', 'left')->where('products.status', 'approved')->order_by('RAND()', 'ASC')->get('products')->result_array();
    }

    public function getAllProductsNoSeller(){
        return $this->db->limit(10)->get('products')->result_array();
    }

    public function getProduct($id){
        return $this->db->where('id', $id)->join('users', 'products.owner_id = users.user_id')->get('products')->row_array();
    }

    public function getProductBy($by, $key){
        return $this->db->where($by, $key)->join('users', 'products.owner_id = users.user_id')->get('products')->row_array();
    }

    public function getOnlyProduct($id){
        return $this->db->where('code', $id)->get('products')->row_array();
    }


    public function getProductsBy($by, $key){
        return $this->db->where($by, $key)->join('users', 'products.owner_id = users.user_id')->get('products')->result_array();
    }

    public function getProductAtRandom(){
        return $this->db->query("SELECT * FROM products WHERE status = 'approved' ORDER BY RAND() LIMIT 1")->row_array();
    }

    public function getProductsAtRandom($limit = 5){
        return $this->db->query("SELECT * FROM products WHERE status = 'approved' ORDER BY RAND() LIMIT $limit")->result_array();
    }


    public function getLatestProducts($limit = 5){
        return $this->db->query("SELECT * FROM products WHERE status = 'approved' ORDER BY id DESC LIMIT $limit")->result_array();
    }

    public function getLatestProductsBy($by, $key, $limit = 5){
        return $this->db->query("SELECT * FROM products WHERE status = 'approved' AND $by = '$key' ORDER BY id DESC LIMIT $limit")->result_array();
    }

    public function getProductRating($product_id){
        $avg_rating = $this->db->where('product_id', $product_id)->select('AVG(rate) as avg_rating')->from('product_rating')->get()->row()->avg_rating;
        return ($avg_rating) ? $avg_rating : 0;
    }

    public function getFeaturedProducts() {
        return $this->db->limit(6)->get_where('products', ['featured' => 1, 'status' => 'approved'])->result_array();
    }

    public function addToFeaturedProducts($product_id) {
        return $this->db->where('product_id', $product_id)->update('products', ['featured' => 1]);
    }

    public function removeFromFeaturedProducts($product_id) {
        return $this->db->where('product_id', $product_id)->update('products', ['featured' => 0]);
    }

}
